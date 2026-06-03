<?php

namespace App\Livewire\Dashboard\Cheques;

use App\Models\Cheque;
use App\Models\Company;
use App\Models\Contract;
use App\Services\Dashboard\ChequeService;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class CreateCheque extends Component
{
    use WithFileUploads;

    public $contract_id, $customer_id, $company_id;
    public $cheque_number, $amount, $issue_date, $due_date, $notes;
    public $status = '', $is_deposit = 0;
    public $bank_name = ['ar' => '', 'en' => ''], $cheque_owner_name = ['ar' => '', 'en' => ''];

    public $validation_fail_nonce = 0;

    public $financials = [];
    public $projectedRemaining = 0, $availableToCover = 0;
    public $isContractFulfilled = false, $amountExceedsRemaining = false;
    public $paid_pct = 0, $pending_pct = 0, $paid_pct_previous = 0, $current_pct_dynamic = 0;
    public $smart_assistant_message = '', $dateWarning = '';

    public $excelFile;
    public $importedCheques = [];

    protected $listeners = ['refresh' => '$refresh'];

    public function mount($is_deposit = 0, $contract_id = null, $company_id = null)
    {
        $this->is_deposit = $is_deposit;
        $this->resetFinancials(); // Ensure defaults are set

        // Defensive check for params
        if ($company_id) {
            $this->company_id = $company_id;
        }
        if ($contract_id) {
            // Verify contract exists and matches company if provided
            $query = Contract::where('id', $contract_id);
            if ($this->company_id) {
                $query->where('company_id', $this->company_id);
            }
            $contract = $query->first();
            if ($contract) {
                $this->contract_id = $contract->id;
                $this->company_id = $contract->company_id;
                $this->customer_id = $contract->customer_id;
                $this->calculateFinancials();
            }
        }

        if (user()->company_id != 1) {
            $this->company_id = user()->company_id;
        }

        // Final calculation safety
        if ($this->contract_id) {
            $this->calculateFinancials();
        }

        // Default status for insurance cheques
        if ($this->is_deposit == 1) {
            $this->status = 'held';
        }
    }

    public function updatedContractId()
    {
        $this->calculateFinancials();
        $this->dispatch('reinit-plugins');
    }

    public function updatedCompanyId()
    {
        $this->contract_id = null;
        $this->resetFinancials();
        $this->dispatch('reinit-plugins');
    }

    public function updatedAmount()
    {
        $this->calculateFinancials();
    }

    public function updatedIssueDate($value)
    {
        $this->checkDates();
    }

    public function updatedDueDate($value)
    {
        $this->checkDates();
    }

    public function checkDates()
    {
        $this->dateWarning = '';
        if ($this->issue_date && $this->due_date) {
            if (strtotime($this->due_date) < strtotime($this->issue_date)) {
                $this->dateWarning = __('cheques.due_date_before_issue_date');
                return;
            }
        }

        $dateToCheck = $this->due_date ?: $this->issue_date;
        if ($dateToCheck) {
            $dateObj = \Carbon\Carbon::parse($dateToCheck);
            if ($dateObj->copy()->addMonths(6)->isPast()) {
                $this->dateWarning = __('cheques.stale_cheque_warning');
            } elseif ($dateObj->copy()->subYear()->isFuture()) {
                $this->dateWarning = __('cheques.far_future_cheque_warning');
            }
        }
    }

    public function calculateFinancials()
    {
        if (!$this->contract_id) {
            $this->resetFinancials();
            return;
        }

        $contract = Contract::with(['cheques', 'customer', 'property'])->find($this->contract_id);

        if (!$contract) {
            $this->resetFinancials();
            $this->contract_id = null;
            return;
        }

        $this->customer_id = $contract->customer_id;

        $totalAmount = $contract->total_amount;
        $paidAmount = $contract->paid_amount;
        $remaining = $contract->remaining_amount;

        // Financial Health Calculations
        $allCheques = $contract->cheques;
        $pendingOriginal = $allCheques->where('status', 'pending')->sum('amount');
        $pendingTotal = $allCheques->where('status', 'pending')->sum('remaining_amount');

        $insuranceCovered = $allCheques->where('is_deposit', true)->whereIn('status', ['pending', 'held', 'cleared'])->sum('amount');
        
        $this->financials = [
            'total_amount' => $totalAmount,
            'paid_amount' => $paidAmount,
            'remaining' => $remaining,
            'pending_total' => $pendingTotal,
            'pending_original' => $pendingOriginal,
            'deposit_amount' => $contract->deposit_amount,
            'covered_by_cheques' => min($remaining, $pendingTotal),
            'uncovered_debt' => max(0.0, $remaining - $pendingTotal),
            'insurance_covered' => $insuranceCovered,
            'insurance_uncovered' => max(0.0, $contract->deposit_amount - $insuranceCovered),
        ];

        // Projected Remaining
        $contractRemaining = $remaining;

        // Sum of all other pending cheques
        $totalOtherUnused = $allCheques->where('status', 'pending')->sum('remaining_amount');

        // Current cheque unused portion (for create, it's the full amount)
        $currentChequeUnused = max(0, (float) $this->amount);

        if ($this->is_deposit == 1) {
            // For insurance cheques, we check against deposit amount
            $this->projectedRemaining = $contract->deposit_amount - $totalOtherUnused - $currentChequeUnused;
        } else {
            $this->projectedRemaining = $contractRemaining - $totalOtherUnused - $currentChequeUnused;
        }

        // Check if contract is already fully covered by cheques (only for non-deposit)
        if ($this->is_deposit == 0 && $this->projectedRemaining + $currentChequeUnused <= 0) {
            $this->isContractFulfilled = true;
        } else {
            $this->isContractFulfilled = false;
        }

        // Exceeds remaining validation display
        $this->availableToCover = max(0, (float)($totalAmount - $paidAmount - $totalOtherUnused));
        if ($this->is_deposit == 0 && $currentChequeUnused > $this->availableToCover) {
            $this->amountExceedsRemaining = true;
        } else {
            $this->amountExceedsRemaining = false;
        }

        // Progress bar calculations
        if ($this->is_deposit == 1) {
            $total = $contract->deposit_amount ?: 1;
            
            $realizedPrevious = $allCheques->where('is_deposit', true)->whereIn('status', ['cleared', 'held'])->sum('amount');
            $pendingPrevious = $allCheques->where('is_deposit', true)->where('status', 'pending')->sum('amount');

            $this->paid_pct_previous = ($realizedPrevious / $total) * 100;
            $this->pending_pct = ($pendingPrevious / $total) * 100;
            $this->current_pct_dynamic = ($currentChequeUnused / $total) * 100;
            
            $this->paid_pct = $this->paid_pct_previous + $this->current_pct_dynamic;
        } else {
            $total = $totalAmount ?: 1;

            // Realized Paid (Cash/Bank, or Cleared Cheques)
            $realizedPaid = $contract->payments()
                ->whereIn('status', ['paid', 'pending'])
                ->where(function ($query) {
                    $query->whereNull('cheque_id')
                        ->orWhereHas('cheque', function ($q) {
                            $q->where('is_deposit', false)->where('status', 'cleared');
                        });
                })
                ->sum('amount');
            
            // Pending Cheques
            $pendingChequeVal = 0;
            $pendingChequeVal += $contract->payments()
                ->whereIn('status', ['paid', 'pending'])
                ->whereHas('cheque', function ($q) {
                    $q->where('is_deposit', false)->where('status', 'pending');
                })
                ->sum('amount');
            $pendingChequeVal += $allCheques
                ->where('is_deposit', false)
                ->where('status', 'pending')
                ->sum('remaining_amount');

            $this->paid_pct_previous = ($realizedPaid / $total) * 100;
            $this->pending_pct = ($pendingChequeVal / $total) * 100;
            $this->current_pct_dynamic = ($currentChequeUnused / $total) * 100;
            
            $this->paid_pct = $this->paid_pct_previous + $this->current_pct_dynamic;
        }

        $this->updateSmartAssistantMessage();
    }

    public function resetFinancials()
    {
        $this->financials = [
            'total_amount' => 0,
            'paid_amount' => 0,
            'remaining' => 0,
            'pending_total' => 0,
            'pending_original' => 0,
            'deposit_amount' => 0,
            'covered_by_cheques' => 0,
            'uncovered_debt' => 0,
            'insurance_covered' => 0,
            'insurance_uncovered' => 0,
        ];
        $this->projectedRemaining = 0;
        $this->isContractFulfilled = false;
        $this->paid_pct = 0;
        $this->pending_pct = 0;
        $this->paid_pct_previous = 0;
        $this->current_pct_dynamic = 0;
        $this->smart_assistant_message = '';
        $this->amountExceedsRemaining = false;
        $this->availableToCover = 0;
    }

    public function updateSmartAssistantMessage()
    {
        if (!$this->contract_id) {
            $this->smart_assistant_message = __('cheques.smart_assistant.select_contract');
            return;
        }

        $amt = (float)$this->amount;
        if ($amt <= 0) {
            $this->smart_assistant_message = __('cheques.smart_assistant.enter_cheque_value');
            return;
        }

        if ($this->is_deposit == 1) {
            $uncovered = (float)$this->financials['insurance_uncovered'];
            
            if ($amt > $uncovered) {
                $surplus = $amt - $uncovered;
                $this->smart_assistant_message = __('cheques.smart_assistant.deposit_exceeds', ['amount' => number_format($surplus, 0)]);
            } else {
                $newUncovered = $uncovered - $amt;
                if ($newUncovered <= 0) {
                    $this->smart_assistant_message = __('cheques.smart_assistant.deposit_fully_covered');
                } else {
                    $this->smart_assistant_message = __('cheques.smart_assistant.deposit_partially_covered', ['amount' => number_format($newUncovered, 0)]);
                }
            }
        } else {
            $uncovered = (float)$this->financials['uncovered_debt'];
            
            if ($amt > $this->availableToCover + 0.01) {
                $this->smart_assistant_message = __('cheques.smart_assistant.rent_exceeds', ['amount' => number_format($this->availableToCover, 0)]);
            } else {
                $newUncovered = max(0, $uncovered - $amt);
                if ($newUncovered == 0) {
                    $this->smart_assistant_message = __('cheques.smart_assistant.rent_fully_covered');
                } else {
                    $this->smart_assistant_message = __('cheques.smart_assistant.rent_partially_covered', ['amount' => number_format($newUncovered, 0)]);
                }
            }
        }
    }

    public function store()
    {
        Gate::authorize('cheques_create');

        $rules = [
            'contract_id' => 'required|exists:contracts,id',
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|gt:0',
            'cheque_number' => 'required|string|max:255',
            'bank_name.ar' => 'required|string|max:255',
            'bank_name.en' => 'required|string|max:255',
            'cheque_owner_name.ar' => 'required|string|max:255',
            'cheque_owner_name.en' => 'required|string|max:255',
            'issue_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'status' => 'required|string|in:pending,cleared,bounced,held,returned',
            'notes' => 'nullable|string',
        ];

        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        try {
            $validatedData = $this->validate($rules);
            
            $validatedData['is_deposit'] = $this->is_deposit;
            $validatedData['due_date'] = $validatedData['due_date'] ?: null;
            $validatedData['issue_date'] = $validatedData['issue_date'] ?: null;

            // Prevent Duplication
            $this->validateDuplicate($validatedData);

            // Complex Balance Validation
            $this->validateBalance($validatedData['amount']);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->validation_fail_nonce++;
            $this->dispatch('reinit-plugins');
            $errors = $e->validator->errors()->all();
            $this->dispatch('notify', message: count($errors) === 1 ? $errors[0] : __('general.validation_error_message'), type: 'error');
            throw $e;
        }

        $service = app(ChequeService::class);

        try {
            $service->store($validatedData);
            session()->flash('success', __('general.add_success_message'));
            return redirect()->route('dashboard.cheques.index');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Cheque Livewire Store Error: ' . $e->getMessage());
            $this->addError('general', $e->getMessage());
            $this->dispatch('notify', message: $e->getMessage(), type: 'error');
        }
    }

    protected function validateDuplicate($validatedData)
    {
        $companyId = $validatedData['company_id'] ?? $this->company_id;
        $query = Cheque::where('company_id', $companyId)
            ->where('cheque_number', $validatedData['cheque_number'])
            ->where(function ($q) use ($validatedData) {
                $q->where('bank_name->ar', $validatedData['bank_name']['ar'])->orWhere('bank_name->en', $validatedData['bank_name']['en']);
            });

        if ($query->exists()) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'cheque_number' => __('cheques.duplicate_cheque_number'),
            ]);
        }
    }

    protected function validateBalance($amount)
    {
        if ($this->is_deposit == 1) {
            return;
        }

        $contract = Contract::with('cheques')->find($this->contract_id);
        $totalAmount = $contract->total_amount;
        $paidAmount = $contract->paid_amount;

        $otherPendingTotal = $contract->cheques->where('status', 'pending')->sum('remaining_amount');
        $availableToCover = max(0, $totalAmount - $paidAmount - $otherPendingTotal);

        if ($amount > $availableToCover + 0.01) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'amount' => __('cheques.amount_exceeds_contract_remaining') . ' (' . number_format($availableToCover, 2) . ')',
            ]);
        }
    }

    public function render()
    {
        $companies = Company::active()->orderBy('id', 'desc')->get();
        $contracts = collect();
        if ($this->company_id) {
            $contracts = Contract::where('company_id', $this->company_id)->with('customer', 'property')->orderBy('id', 'desc')->get();
        }

        return view('livewire.dashboard.cheques.create-cheque', [
            'companies' => $companies,
            'contracts' => $contracts,
        ]);
    }

    public function importFromExcel()
    {
        $this->validate([
            'excelFile' => 'required|file|mimes:xlsx,xls,csv|max:10240', // max 10MB
        ]);

        try {
            $data = Excel::toArray(new \stdClass(), $this->excelFile->getRealPath());
            
            if (!empty($data) && count($data[0]) > 0) {
                // Assuming data[0] is the first sheet
                $sheet = $data[0];
                
                $parsedCheques = [];
                // Start from row 1 to skip header (index 1 if row 0 is header)
                for ($i = 1; $i < count($sheet); $i++) {
                    $row = $sheet[$i];
                    
                    // According to user's mapping:
                    // B (Index 1): Cheque Number
                    // C (Index 2): Date
                    // D (Index 3): Amount
                    // E (Index 4): Bank Name
                    
                    if (!isset($row[1]) || empty($row[1])) {
                        continue; // Skip rows without a cheque number
                    }

                    // Handle Excel Date format
                    $issueDate = null;
                    if (isset($row[2]) && !empty($row[2])) {
                        if (is_numeric($row[2])) {
                            $issueDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2])->format('Y-m-d');
                        } else {
                            try {
                                $issueDate = \Carbon\Carbon::parse(str_replace('/', '-', $row[2]))->format('Y-m-d');
                            } catch (\Exception $e) {
                                $issueDate = null;
                            }
                        }
                    }

                    $parsedCheques[] = [
                        'cheque_number' => $row[1] ?? '',
                        'issue_date' => $issueDate,
                        'amount' => isset($row[3]) ? floatval($row[3]) : 0,
                        'bank_name' => $row[4] ?? '',
                    ];
                }
                
                $this->importedCheques = $parsedCheques;
                $this->dispatch('notify', message: __('cheques.import_success'), type: 'success');
            } else {
                $this->dispatch('notify', message: __('cheques.no_cheques_in_excel'), type: 'warning');
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Excel Import Error: ' . $e->getMessage());
            $this->dispatch('notify', message: 'Error reading file: ' . $e->getMessage(), type: 'error');
        }
    }

    public function selectExcelCheque($index)
    {
        if (isset($this->importedCheques[$index])) {
            $cheque = $this->importedCheques[$index];
            
            $this->cheque_number = strval($cheque['cheque_number']);
            $this->amount = $cheque['amount'];
            
            // By default assign the same bank name for ar and en
            $this->bank_name = [
                'ar' => $cheque['bank_name'],
                'en' => $cheque['bank_name']
            ];
            
            if ($cheque['issue_date']) {
                $this->issue_date = $cheque['issue_date'];
                // For simplicity, we can also set due_date to the same, or leave it blank
                $this->due_date = $cheque['issue_date'];
            }

            $this->status = 'pending';

            $this->calculateFinancials();
            $this->checkDates();
            
            // Dispatch event to close modal or update UI if needed
            $this->dispatch('excel-cheque-selected');
        }
    }
}
