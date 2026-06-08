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
                    $allChequeNumbers[] = (string)$rows[$i][1];
                }
            }
            
            $existingCheques = \App\Models\Cheque::where('company_id', $this->company_id ?? user()->company_id)
                ->whereIn('cheque_number', $allChequeNumbers)
                ->pluck('cheque_number')
                ->map(fn($num) => (string)$num)
                ->toArray();

            // Skip header row (index 0)
            for ($i = 1; $i < count($rows); $i++) {
                $row = $rows[$i];

                // If empty row, skip
                if (empty($row[0]) && empty($row[1])) continue;

                $chequeNumber = $row[1] ?? null;
                $issueDateRaw = $row[2] ?? null;
                $amount = $row[3] ?? null;
                $bankName = $row[4] ?? null;
                $depositBank = $row[5] ?? '';
                $depositAccount = $row[6] ?? '';

                $isDuplicate = in_array((string)$chequeNumber, $existingCheques);

                // Try to match bank account
                $matchedAccount = null;
                if (!empty($depositAccount)) {
                    $matchedAccount = $bankAccounts->where('account_number', $depositAccount)->first();
                }

                // Parse date
                $issueDate = null;
                if (!empty($issueDateRaw)) {
                    try {
                        if (is_numeric($issueDateRaw)) {
                            // Excel date serialization
                            $issueDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($issueDateRaw)->format('Y-m-d');
                        } else {
                            // Text date parsing (try assuming d/m/Y)
                            $issueDate = Carbon::createFromFormat('d/m/Y', $issueDateRaw)->format('Y-m-d');
                        }
                    } catch (\Exception $e) {
                        try {
                            $issueDate = Carbon::parse($issueDateRaw)->format('Y-m-d');
                        } catch (\Exception $e2) {
                            $issueDate = null;
                        }
                    }
                }

                $parsedRows[] = [
                    'index' => $i,
                    'cheque_number' => $chequeNumber,
                    'issue_date' => $issueDate,
                    'amount' => $amount,
                    'bank_name' => $bankName,
                    'deposit_bank' => $depositBank,
                    'deposit_account' => $depositAccount,
                    'matched_account_id' => $matchedAccount ? $matchedAccount->id : null,
                    'matched_account_name' => $matchedAccount ? $matchedAccount->bank_name : null,
                    'is_duplicate' => $isDuplicate,
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

        $savedCount = 0;

        foreach ($this->previewData as $row) {
            if (in_array((string)$row['index'], $this->selectedCheques) || in_array($row['index'], $this->selectedCheques)) {
                
                $notes = '';
                if (!$row['matched_account_id'] && !empty($row['deposit_account'])) {
                    $notes = __('cheques.deposit_bank_info', ['bank' => $row['deposit_bank'], 'account' => $row['deposit_account']]);
                }

                Cheque::create([
                    'company_id' => user()->company_id ?? 1,
                    'contract_id' => $contract->id,
                    'customer_id' => $contract->customer_id,
                    'company_bank_account_id' => $row['matched_account_id'],
                    'amount' => $row['amount'],
                    'cheque_number' => $row['cheque_number'],
                    'bank_name' => ['ar' => $row['bank_name'] ?? __('cheques.not_specified', [], 'ar'), 'en' => $row['bank_name'] ?? __('cheques.not_specified', [], 'en')],
                    'cheque_owner_name' => [
                        'ar' => $contract->customer ? $contract->customer->getTranslation('name', 'ar') : __('cheques.not_specified', [], 'ar'),
                        'en' => $contract->customer ? $contract->customer->getTranslation('name', 'en') : __('cheques.not_specified', [], 'en')
                    ],
                    'issue_date' => $row['issue_date'],
                    'due_date' => $row['issue_date'], // usually same as issue date for cheques unless specified
                    'status' => 'pending',
                    'is_deposit' => false,
                    'notes' => ['ar' => $notes, 'en' => $notes],
                    'created_by' => user()->id,
                ]);

                $savedCount++;
            }
        }

        session()->flash('success', __('cheques.imported_successfully') . " ({$savedCount})");

        // Clear state
        $this->reset(['excelFile', 'previewData', 'selectedCheques', 'contract_id']);
        
        // redirect to cheques index
        return redirect()->route('dashboard.cheques.index');
    }

    public function toggleSelectAll($isChecked)
    {
        if ($isChecked) {
            $this->selectedCheques = array_column($this->previewData, 'index');
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
