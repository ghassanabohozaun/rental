<?php

namespace App\Livewire\Dashboard\Cheques;

use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Contract;
use App\Models\CompanyBankAccount;
use App\Models\Cheque;
use Illuminate\Support\Carbon;

class ImportCheques extends Component
{
    use WithFileUploads;

    public $excelFile;
    public $company_id = null;
    public $contract_id = '';
    public $previewData = [];
    public $selectedCheques = [];
    public $availableToCover = 0;

    public function mount()
    {
        if (user()->company_id != 1) {
            $this->company_id = user()->company_id;
        }
    }

    public function updatedCompanyId()
    {
        $this->contract_id = '';
        $this->dispatch('reinit-plugins');
    }

    public function analyzeFile()
    {
        $this->validate([
            'company_id' => user()->company_id == 1 ? 'required' : 'nullable',
            'contract_id' => 'required',
            'excelFile' => 'required|mimes:xlsx,xls,csv|max:10240', // 10MB
        ], [
            'company_id.required' => __('cheques.select_company_first'),
            'contract_id.required' => __('cheques.select_contract_first'),
            'excelFile.required' => __('cheques.no_file_selected'),
            'excelFile.mimes' => __('cheques.must_be_excel'),
        ]);

        try {
            $contract = Contract::with('cheques')->find($this->contract_id);
            if ($contract) {
                $totalAmount = $contract->total_amount;
                $paidAmount = $contract->paid_amount;
                $totalOtherUnused = $contract->cheques->where('status', 'pending')->where('is_deposit', false)->sum('remaining_amount');
                $this->availableToCover = max(0, (float)($totalAmount - $paidAmount - $totalOtherUnused));
            }

            $data = Excel::toArray(new \stdClass(), $this->excelFile->getRealPath());

            if (empty($data) || empty($data[0])) {
                $this->addError('excelFile', __('cheques.file_empty_or_invalid'));
                return;
            }

            $rows = $data[0];
            $parsedRows = [];

            // Fetch company bank accounts for matching
            $bankAccounts = CompanyBankAccount::get();

            // Fetch existing cheque numbers for duplicate detection
            $allChequeNumbers = [];
            for ($i = 1; $i < count($rows); $i++) {
                if (!empty($rows[$i][1])) {
                    $chequeNumTmp = trim((string)$rows[$i][1]);
                    if (is_numeric($chequeNumTmp) && strlen($chequeNumTmp) < 8) {
                        $chequeNumTmp = str_pad($chequeNumTmp, 8, '0', STR_PAD_LEFT);
                    }
                    $allChequeNumbers[] = $chequeNumTmp;
                }
            }
            
            $existingCheques = \App\Models\Cheque::where('company_id', $this->company_id ?? user()->company_id)
                ->whereIn('cheque_number', $allChequeNumbers)
                ->get(['cheque_number', 'bank_name', 'amount', 'due_date']);

            $existingChequeNumbers = $existingCheques->pluck('cheque_number')->map(fn($num) => (string)$num)->toArray();

            // Skip header row (index 0)
            for ($i = 1; $i < count($rows); $i++) {
                $row = $rows[$i];

                // If empty row, skip
                if (empty($row[0]) && empty($row[1])) continue;

                $chequeNumber = $row[1] ?? null;
                if ($chequeNumber !== null) {
                    $chequeNumber = trim((string)$chequeNumber);
                    if (is_numeric($chequeNumber) && strlen($chequeNumber) < 8) {
                        $chequeNumber = str_pad($chequeNumber, 8, '0', STR_PAD_LEFT);
                    }
                }
                
                $dueDateRaw = $row[2] ?? null; // Column C is index 2: تاريخ استحقاق الشيك (due date)
                $amount = $row[3] ?? null;
                $bankName = $row[4] ?? null;
                $depositBank = $row[5] ?? '';
                $depositAccount = $row[6] ?? '';

                // Try to match bank account and validate it
                $cleanedAccount = '';
                $depositAccountError = null;
                $matchedAccount = null;

                if (!empty($depositAccount)) {
                    $depositAccount = trim((string)$depositAccount);
                    $cleanedAccount = str_replace('-', '', $depositAccount);
                    
                    // Pad with leading zeros if it is numeric and less than 13 characters
                    if (preg_match('/^[0-9]+$/', $cleanedAccount) && strlen($cleanedAccount) < 13) {
                        $cleanedAccount = str_pad($cleanedAccount, 13, '0', STR_PAD_LEFT);
                        $depositAccount = $cleanedAccount;
                    }
                    
                    if (!preg_match('/^[0-9]{13}$/', $cleanedAccount)) {
                        $depositAccountError = __('validation.digits', ['attribute' => __('cheques.deposit_account'), 'digits' => 13]);
                    } else {
                        $matchedAccount = $bankAccounts->where('account_number', $cleanedAccount)->first();
                    }
                }

                // Validate cheque number
                $chequeNumberError = null;
                if (empty($chequeNumber)) {
                    $chequeNumberError = __('validation.required', ['attribute' => __('cheques.cheque_number')]);
                } elseif (!preg_match('/^[0-9]{8}$/', $chequeNumber)) {
                    $chequeNumberError = __('validation.digits', ['attribute' => __('cheques.cheque_number'), 'digits' => 8]);
                }

                // Validate amount
                $amountError = null;
                if ($amount === null || $amount === '') {
                    $amountError = __('validation.required', ['attribute' => __('cheques.amount')]);
                } elseif (!is_numeric($amount) || (float)$amount <= 0) {
                    $amountError = __('cheques.invalid_amount');
                }

                // Parse due date
                $dueDate = null;
                if (!empty($dueDateRaw)) {
                    try {
                        if (is_numeric($dueDateRaw)) {
                            // Excel date serialization
                            $dueDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dueDateRaw)->format('Y-m-d');
                        } else {
                            // Text date parsing (assume d/m/Y)
                            $dueDate = Carbon::createFromFormat('d/m/Y', trim((string)$dueDateRaw))->format('Y-m-d');
                        }
                    } catch (\Exception $e) {
                        try {
                            $dueDate = Carbon::parse(trim((string)$dueDateRaw))->format('Y-m-d');
                        } catch (\Exception $e2) {
                            $dueDate = null;
                        }
                    }
                }

                // Check duplicates (composite duplicate is hard error, number duplicate is soft warning)
                $isDuplicateNumber = in_array((string)$chequeNumber, $existingChequeNumbers);
                $isExactDuplicate = false;
                if ($isDuplicateNumber) {
                    foreach ($existingCheques as $c) {
                        if ((string)$c->cheque_number === (string)$chequeNumber) {
                            // Check amount
                            if (abs((float)$c->amount - (float)$amount) > 0.001) {
                                continue;
                            }
                            
                            // Check due date
                            $cDate = $c->due_date ? $c->due_date->format('Y-m-d') : null;
                            if ($cDate !== $dueDate) {
                                continue;
                            }
                            
                            // Check bank name
                            $cBankAr = mb_strtolower(trim($c->getTranslation('bank_name', 'ar') ?? ''), 'UTF-8');
                            $cBankEn = mb_strtolower(trim($c->getTranslation('bank_name', 'en') ?? ''), 'UTF-8');
                            $searchBank = mb_strtolower(trim((string)$bankName), 'UTF-8');
                            
                            if (empty($searchBank) && empty($cBankAr) && empty($cBankEn)) {
                                $isExactDuplicate = true;
                                break;
                            }
                            
                            if ($cBankAr === $searchBank || $cBankEn === $searchBank) {
                                $isExactDuplicate = true;
                                break;
                            }
                        }
                    }
                }

                $rowErrors = [];
                if ($chequeNumberError) {
                    $rowErrors['cheque_number'] = $chequeNumberError;
                } elseif ($isExactDuplicate) {
                    $rowErrors['cheque_number'] = __('cheques.exact_duplicate_error');
                }
                if ($depositAccountError) {
                    $rowErrors['deposit_account'] = $depositAccountError;
                }
                if ($amountError) {
                    $rowErrors['amount'] = $amountError;
                }
                $hasErrors = !empty($rowErrors);

                $parsedRows[] = [
                    'index' => $i,
                    'cheque_number' => $chequeNumber,
                    'due_date' => $dueDate,
                    'amount' => $amount,
                    'bank_name' => $bankName,
                    'deposit_bank' => $depositBank,
                    'deposit_account' => $depositAccount,
                    'matched_account_id' => $matchedAccount ? $matchedAccount->id : null,
                    'matched_account_name' => $matchedAccount ? $matchedAccount->bank_name : null,
                    'is_duplicate' => $isDuplicateNumber && !$isExactDuplicate,
                    'errors' => $rowErrors,
                    'has_errors' => $hasErrors,
                ];
            }

            $this->previewData = $parsedRows;
            
            // Do not auto-select cheques by default
            $this->selectedCheques = [];

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Cheque Excel Analysis Error: ' . $e->getMessage());
            $this->addError('excelFile', __('cheques.error_reading_file') . $e->getMessage());
        }
    }

    public function saveImportedCheques()
    {
        $this->validate([
            'contract_id' => 'required',
            'selectedCheques' => 'required|array|min:1',
        ], [
            'contract_id.required' => __('cheques.select_contract_first'),
            'selectedCheques.required' => __('cheques.no_cheques_selected'),
            'selectedCheques.min' => __('cheques.no_cheques_selected'),
        ]);

        $contract = Contract::with('cheques')->findOrFail($this->contract_id);
        
        $totalAmount = $contract->total_amount;
        $paidAmount = $contract->paid_amount;
        $totalOtherUnused = $contract->cheques->where('status', 'pending')->where('is_deposit', false)->sum('remaining_amount');
        $availableToCover = max(0, (float)($totalAmount - $paidAmount - $totalOtherUnused));

        $selectedSum = 0;
        foreach ($this->previewData as $row) {
            if (in_array((string)$row['index'], $this->selectedCheques) || in_array($row['index'], $this->selectedCheques)) {
                $selectedSum += (float)$row['amount'];
            }
        }

        if ($selectedSum > $availableToCover) {
            $this->addError('selectedCheques', __('cheques.import_exceeds_available', ['available' => number_format($availableToCover, 2)]));
            return;
        }

        $bankAccounts = CompanyBankAccount::get();
        $savedCount = 0;

        try {
            \Illuminate\Support\Facades\DB::transaction(function () use ($contract, $bankAccounts, &$savedCount) {
                foreach ($this->previewData as $row) {
                    if (in_array((string)$row['index'], $this->selectedCheques) || in_array($row['index'], $this->selectedCheques)) {
                        
                        $notes = '';
                        if (!$row['matched_account_id'] && !empty($row['deposit_account'])) {
                            $notes = __('cheques.deposit_bank_info', ['bank' => $row['deposit_bank'], 'account' => $row['deposit_account']]);
                        }

                        // Resolve bank name translations from database bank accounts if matching
                        $bankNameAr = $row['bank_name'] ?? __('cheques.not_specified', [], 'ar');
                        $bankNameEn = $row['bank_name'] ?? __('cheques.not_specified', [], 'en');

                        if (!empty($row['bank_name'])) {
                            $searchName = trim($row['bank_name']);
                            foreach ($bankAccounts as $acc) {
                                $accAr = $acc->getTranslation('bank_name', 'ar');
                                $accEn = $acc->getTranslation('bank_name', 'en');
                                $cleanAccAr = trim(mb_strtolower($accAr, 'UTF-8'));
                                $cleanAccEn = trim(mb_strtolower($accEn, 'UTF-8'));
                                $cleanSearch = trim(mb_strtolower($searchName, 'UTF-8'));

                                if ($cleanAccAr === $cleanSearch || $cleanAccEn === $cleanSearch) {
                                    $bankNameAr = $accAr;
                                    $bankNameEn = $accEn;
                                    break;
                                }
                            }
                        }

                        Cheque::create([
                            'company_id' => user()->company_id ?? 1,
                            'contract_id' => $contract->id,
                            'customer_id' => $contract->customer_id,
                            'company_bank_account_id' => $row['matched_account_id'],
                            'amount' => $row['amount'],
                            'cheque_number' => $row['cheque_number'],
                            'bank_name' => ['ar' => $bankNameAr, 'en' => $bankNameEn],
                            'cheque_owner_name' => [
                                'ar' => $contract->customer ? $contract->customer->getTranslation('name', 'ar') : __('cheques.not_specified', [], 'ar'),
                                'en' => $contract->customer ? $contract->customer->getTranslation('name', 'en') : __('cheques.not_specified', [], 'en')
                            ],
                            'issue_date' => null,
                            'due_date' => $row['due_date'],
                            'status' => 'pending',
                            'is_deposit' => false,
                            'notes' => ['ar' => $notes, 'en' => $notes],
                            'created_by' => user()->id,
                        ]);

                        $savedCount++;
                    }
                }

                // Calculate file hash and log the import batch
                if ($this->excelFile && file_exists($this->excelFile->getRealPath())) {
                    $fileHash = md5_file($this->excelFile->getRealPath());
                    \App\Models\ImportedFile::create([
                        'company_id' => user()->company_id ?? 1,
                        'file_hash' => $fileHash,
                        'file_name' => $this->excelFile->getClientOriginalName(),
                    ]);
                }
            });

            session()->flash('success', __('cheques.imported_successfully') . " ({$savedCount})");

            // Clear state
            $this->reset(['excelFile', 'previewData', 'selectedCheques', 'contract_id']);
            
            // redirect to cheques index
            return redirect()->route('dashboard.cheques.index');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Cheque Import Save Error: ' . $e->getMessage());
            $this->addError('selectedCheques', __('general.add_error_message') . ' - ' . $e->getMessage());
        }
    }

    public function toggleSelectAll($isChecked)
    {
        if ($isChecked) {
            $this->selectedCheques = collect($this->previewData)
                ->where('has_errors', false)
                ->pluck('index')
                ->map(fn($val) => (string)$val)
                ->toArray();
        } else {
            $this->selectedCheques = [];
        }
    }

    public function render()
    {
        $companies = \App\Models\Company::active()->orderBy('id', 'desc')->get();
        
        $contracts = collect();
        if ($this->company_id) {
            $contracts = Contract::where('company_id', $this->company_id)->with('customer', 'property')->orderBy('id', 'desc')->get();
        } elseif (user()->company_id != 1) {
            $contracts = Contract::where('company_id', user()->company_id)->with('customer', 'property')->orderBy('id', 'desc')->get();
        }
        
        return view('livewire.dashboard.cheques.import-cheques', compact('companies', 'contracts'));
    }
}
