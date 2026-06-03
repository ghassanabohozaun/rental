<?php
// cspell:disable

namespace App\Livewire\Dashboard\Contracts;

use App\Models\Company;
use App\Models\Property;
use App\Models\Customer;
use App\Models\Contract;
use App\Models\ContractClauseTemplate;
use App\Services\Dashboard\ContractService;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\App;

class EditContract extends Component
{
    public Contract $contract;

    // Basic Fields
    public $company_id, $property_id, $customer_id;
    public $conclusion_date, $start_date, $end_date;
    public $contract_duration_months = 0, $total_rent_amount = 0;
    public $rent_amount, $deposit_amount = 0;
    public $deposit_type = 'cash', $deposit_status = 'held';
    public $payment_cycle = 'monthly', $status = 'active';
    public $contract_text = '', $notes = '';

    // Cheque Fields
    public $deposit_cheque_number, $deposit_issue_date;
    public $deposit_bank_name = ['ar' => '', 'en' => ''];
    public $deposit_cheque_owner_name = ['ar' => '', 'en' => ''];

    // Contract Details (Snapshot & Clauses)
    public $first_party_data = [];
    public $second_party_data = [];
    public $property_data = [];
    public $utilities_data = [];
    public $grace_period = '';

    public function getIsDepositLockedProperty()
    {
        return in_array($this->deposit_status, ['used', 'returned']);
    }

    public $contract_clauses = [];

    // UI Helpers
    public $validation_fail_nonce = 0;

    public function mount(Contract $contract)
    {
        $this->contract = $contract;

        // Basic Fields
        $this->company_id = $contract->company_id;
        $this->property_id = $contract->property_id;
        $this->customer_id = $contract->customer_id;
        $this->conclusion_date = $contract->conclusion_date ? $contract->conclusion_date->format('Y-m-d') : null;
        $this->start_date = $contract->start_date ? $contract->start_date->format('Y-m-d') : null;
        $this->end_date = $contract->end_date ? $contract->end_date->format('Y-m-d') : null;
        $this->rent_amount = $contract->rent_amount;
        $this->deposit_amount = $contract->deposit_amount;
        $this->deposit_type = $contract->deposit_type;
        $this->deposit_status = $contract->deposit_status;
        $this->payment_cycle = $contract->payment_cycle;
        $this->status = $contract->status;
        $this->contract_text = $contract->contract_text;
        $this->notes = $contract->notes;

        $this->calculateDurationAndTotalRent();

        // Cheque details
        if ($contract->deposit_type === 'cheque' && $contract->insuranceCheque) {
            $this->deposit_cheque_number = $contract->insuranceCheque->cheque_number;
            $this->deposit_bank_name = $contract->insuranceCheque->getTranslations('bank_name') ?: ['ar' => '', 'en' => ''];
            $this->deposit_cheque_owner_name = $contract->insuranceCheque->getTranslations('cheque_owner_name') ?: ['ar' => '', 'en' => ''];
            $this->deposit_issue_date = $contract->insuranceCheque->issue_date ? $contract->insuranceCheque->issue_date->format('Y-m-d') : null;
        }

        // Details Snapshot
        $detail = $contract->contractDetail;
        if ($detail) {
            $this->grace_period = $detail->grace_period ?? '';
            $this->first_party_data = is_array($detail->first_party_data) ? $detail->first_party_data : [];
            $this->second_party_data = is_array($detail->second_party_data) ? $detail->second_party_data : [];
            
            // Backfill missing tenant data from live customer (e.g. older contracts without nationality)
            if (empty($this->second_party_data['nationality']) && $this->customer_id) {
                $liveTenant = \App\Models\Customer::with('nationality')->find($this->customer_id);
                if ($liveTenant) {
                    if (empty($this->second_party_data['name']['ar'])) {
                        $this->second_party_data['name']['ar'] = $liveTenant->getTranslation('name', 'ar') ?? '';
                    }
                    if (empty($this->second_party_data['name']['en'])) {
                        $this->second_party_data['name']['en'] = $liveTenant->getTranslation('name', 'en') ?? '';
                    }
                    if (empty($this->second_party_data['id_number'])) {
                        $this->second_party_data['id_number'] = $liveTenant->id_number ?? '';
                    }
                    if (empty($this->second_party_data['nationality'])) {
                        $this->second_party_data['nationality'] = $liveTenant->nationality ? $liveTenant->nationality->name : '';
                    }
                    if (empty($this->second_party_data['phone'])) {
                        $this->second_party_data['phone'] = $liveTenant->phone ?? '';
                    }
                }
            }
            
            $this->property_data = is_array($detail->property_data) ? $detail->property_data : [];
            $this->utilities_data = is_array($detail->utilities_data) ? $detail->utilities_data : [];
            
            foreach ($this->utilities_data as $index => &$utility) {
                if (empty($utility['unit_deposit_amount'])) {
                    $utility['unit_deposit_amount'] = $this->deposit_amount;
                }
                if (empty($utility['unit_rent_amount'])) {
                    $utility['unit_rent_amount'] = $this->rent_amount;
                }
            }
            
            $clauses = $detail->contract_clauses;
            if (is_array($clauses)) {
                $this->contract_clauses = $clauses;
            } elseif (is_string($clauses) && !empty($clauses)) {
                // Legacy compatibility
                $this->contract_clauses = [['title' => __('contracts.previous_clauses'), 'content' => $clauses]];
            }
        }
    }

    public function updatedCompanyId()
    {
        $this->property_id = null;
        $this->customer_id = null;
        $this->resetErrorBag('company_id');
        $this->dispatch('reinit-select2');
    }

    public function updatedPropertyId($id)
    {
        if ($id) {
            $property = Property::with(['company', 'owners' => function($q) {
                $q->wherePivot('is_primary', 1);
            }])->find($id);

            if ($property) {
                $this->first_party_data['name']['ar'] = $property->company->getTranslation('name', 'ar') ?? '';
                $this->first_party_data['name']['en'] = $property->company->getTranslation('name', 'en') ?? '';
                
                $primaryOwner = $property->owners->first();
                if ($primaryOwner) {
                    $this->first_party_data['owner_name'] = $primaryOwner->name ?? '';
                    $this->first_party_data['owner_qid'] = $primaryOwner->identification_number ?? '';
                    $this->first_party_data['owner_phone'] = $primaryOwner->phone ?? '';
                } else {
                    $this->first_party_data['owner_name'] = '';
                    $this->first_party_data['owner_qid'] = '';
                    $this->first_party_data['owner_phone'] = '';
                }

                $this->property_data['zone_number'] = $property->zone_number ?? '';
                $this->property_data['street_number'] = $property->street_number ?? '';
                $this->property_data['building_number'] = $property->building_number ?? '';
                $this->property_data['title_deed_number'] = $property->title_deed_number ?? '';
                $this->property_data['name_ar'] = $property->getTranslation('name', 'ar') ?? '';
                $this->property_data['name_en'] = $property->getTranslation('name', 'en') ?? '';
                $this->property_data['type'] = optional($property->propertyType)->name ?? '';
                $this->property_data['floor'] = $property->floor ?? '';
                $this->property_data['description'] = $property->description ?? '';



                $this->utilities_data = [
                    [
                        'name' => $property->getTranslation('name', app()->getLocale()) ?? $property->name,
                        'electricity_account_number' => $property->electricity_account_number ?? '',
                        'water_account_number' => $property->water_account_number ?? '',
                        'unit_rent_amount' => $this->rent_amount ?? 0,
                        'unit_deposit_amount' => $this->deposit_amount > 0 ? $this->deposit_amount : 0,
                    ]
                ];
            }
        }
    }

    public function updatedCustomerId($id)
    {
        if ($id) {
            $customer = Customer::with('nationality')->find($id);
            if ($customer) {
                $this->second_party_data['name']['ar'] = $customer->getTranslation('name', 'ar') ?? '';
                $this->second_party_data['name']['en'] = $customer->getTranslation('name', 'en') ?? '';
                $this->second_party_data['id_number'] = $customer->id_number ?? '';
                $this->second_party_data['nationality'] = $customer->nationality ? $customer->nationality->name : '';
                $this->second_party_data['phone'] = $customer->phone ?? '';
                
                $this->second_party_data['tenant_type'] = $customer->tenant_type ?? 'individual';
                $this->second_party_data['company_name'] = $customer->company_name ?? '';
                $this->second_party_data['cr_number'] = $customer->cr_number ?? '';
                $this->second_party_data['license_number'] = $customer->license_number ?? '';
                $this->second_party_data['establishment_number'] = $customer->establishment_number ?? '';
            }
        }
    }

    public function updatedDepositType()
    {
        if ($this->deposit_type === 'cash') {
            $this->deposit_status = 'held';
        }
    }

    public function updatedDepositAmount()
    {
        if ($this->deposit_amount === '' || $this->deposit_amount <= 0) {
            $this->deposit_amount = 0;
            $this->deposit_type = 'cash';
            $this->deposit_status = 'held';
        }

        if (count($this->utilities_data) > 0) {
            $this->utilities_data[0]['unit_deposit_amount'] = $this->deposit_amount;
        }
    }

    public function updatedStartDate()
    {
        $this->calculateDurationAndTotalRent();
    }

    public function updatedEndDate()
    {
        $this->calculateDurationAndTotalRent();
    }

    public function updatedRentAmount()
    {
        if (count($this->utilities_data) > 0) {
            $this->utilities_data[0]['unit_rent_amount'] = $this->rent_amount;
        }
        $this->calculateDurationAndTotalRent();
    }

    private function calculateDurationAndTotalRent()
    {
        if ($this->start_date && $this->end_date) {
            try {
                $start = \Carbon\Carbon::parse($this->start_date);
                $end = \Carbon\Carbon::parse($this->end_date);
                
                if ($start->lessThanOrEqualTo($end)) {
                    $months = (int) round($start->floatDiffInMonths($end->copy()->addDay()));
                    $this->contract_duration_months = $months;
                } else {
                    $this->contract_duration_months = 0;
                }
            } catch (\Exception $e) {
                // If date is invalid or incomplete (during manual typing), don't break
                $this->contract_duration_months = 0;
            }
        } else {
            $this->contract_duration_months = 0;
        }

        $this->total_rent_amount = $this->contract_duration_months * (float) ($this->rent_amount ?: 0);
    }

    // --- Clause Management ---
    public function addClause($title = '', $content = '')
    {
        $this->contract_clauses[] = [
            'title' => $title,
            'content' => $content,
        ];
    }

    public function removeClause($index)
    {
        if (isset($this->contract_clauses[$index])) {
            unset($this->contract_clauses[$index]);
            $this->contract_clauses = array_values($this->contract_clauses); // re-index
        }
    }

    #[On('insert-clause')]
    public function handleInsertClause($id)
    {
        $template = ContractClauseTemplate::find($id);
        if ($template) {
            $this->addClause($template->title, $template->content);
            $this->dispatch('notify', message: __('contracts.clause_inserted_success'), type: 'success');
        }
    }

    // --- Utilities Management ---
    public function removeUtility($index)
    {
        if (isset($this->utilities_data[$index])) {
            unset($this->utilities_data[$index]);
            $this->utilities_data = array_values($this->utilities_data);
        }
    }

    protected function rules()
    {
        $rules = [
            'property_id' => 'required|exists:properties,id',
            'customer_id' => 'required|exists:customers,id',
            'conclusion_date' => 'required|date|before_or_equal:start_date',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'rent_amount' => 'required|numeric|min:0',
            'deposit_amount' => 'nullable|numeric|min:0',
            'deposit_type' => 'required|string|in:cash,cheque',
            'deposit_status' => 'required|string|in:held,returned,used',
            'payment_cycle' => 'required|string|in:monthly,quarterly,semi_annually,yearly',
            'status' => 'required|string|in:active,ended,cancelled',
            'contract_text' => 'nullable|string',
            'notes' => 'nullable|string',
            
            // Cheque rules
            'deposit_cheque_number' => 'required_if:deposit_type,cheque|nullable|string|max:255',
            'deposit_bank_name.ar' => 'required_if:deposit_type,cheque|nullable|string|max:255',
            'deposit_bank_name.en' => 'required_if:deposit_type,cheque|nullable|string|max:255',
            'deposit_cheque_owner_name.ar' => 'required_if:deposit_type,cheque|nullable|string|max:255',
            'deposit_cheque_owner_name.en' => 'required_if:deposit_type,cheque|nullable|string|max:255',
            'deposit_issue_date' => 'nullable|date',

            // Detail Snapshot Rules
            'grace_period' => 'nullable|string',
            'contract_clauses' => 'nullable|array',
            'contract_clauses.*.title' => 'nullable|string',
            'contract_clauses.*.content' => 'nullable|string',

            'first_party_data' => 'nullable|array',
            'second_party_data' => 'nullable|array',
            'property_data' => 'nullable|array',
            'utilities_data' => 'nullable|array',
        ];

        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        return $rules;
    }

    public function update(ContractService $service)
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->validation_fail_nonce++;
            $errors = $e->validator->errors()->all();
            $this->dispatch('notify', message: count($errors) === 1 ? $errors[0] : __('general.validation_error_message'), type: 'error');
            throw $e;
        }

        // Custom overlap validation ignoring current contract
        if ($this->property_id && $this->start_date && $this->end_date) {
            $overlappingContract = Contract::query()
                ->where('id', '!=', $this->contract->id)
                ->where('property_id', $this->property_id)
                ->where('status', '!=', 'cancelled')
                ->where(function ($query) {
                    $query->where('start_date', '<=', $this->end_date)
                          ->where('end_date', '>=', $this->start_date);
                })
                ->exists();

            if ($overlappingContract) {
                $this->validation_fail_nonce++;
                $this->addError('property_id', __('contracts.overlap_error'));
                $this->dispatch('notify', message: __('contracts.overlap_error'), type: 'error');
                return;
            }
        }

        $data = [
            'company_id' => user()->company_id == 1 ? $this->company_id : user()->company_id,
            'property_id' => $this->property_id,
            'customer_id' => $this->customer_id,
            'conclusion_date' => $this->conclusion_date,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'contract_duration_months' => $this->contract_duration_months,
            'rent_amount' => $this->rent_amount,
            'total_rent_amount' => $this->total_rent_amount,
            'deposit_amount' => $this->deposit_amount,
            'deposit_type' => $this->deposit_type,
            'deposit_status' => $this->deposit_status,
            'payment_cycle' => $this->payment_cycle,
            'status' => $this->status,
            'contract_text' => $this->contract_text,
            'notes' => $this->notes,
            
            // Cheque details
            'deposit_cheque_number' => $this->deposit_cheque_number,
            'deposit_bank_name' => $this->deposit_bank_name,
            'deposit_cheque_owner_name' => $this->deposit_cheque_owner_name,
            'deposit_issue_date' => $this->deposit_issue_date,

            // Reconstruct nested structure for ContractService compatibility
            'contract_detail' => [
                'grace_period' => $this->grace_period,
                'contract_clauses' => $this->contract_clauses,
                'first_party_data' => $this->first_party_data,
                'second_party_data' => $this->second_party_data,
                'property_data' => $this->property_data,
                'utilities_data' => $this->utilities_data,
            ]
        ];

        try {
            $service->update($this->contract->id, $data);
            flash()->success(__('general.update_success_message'));
            return redirect()->route('dashboard.contracts.index');
        } catch (\Exception $e) {
            \Log::error('Contract Update Livewire Error: ' . $e->getMessage());
            $this->dispatch('notify', message: __('general.update_error_message') . ' - ' . $e->getMessage(), type: 'error');
            $this->validation_fail_nonce++;
        }
    }

    public function render()
    {
        $companies = null;
        if (user()->company_id == 1) {
            $companies = Company::active()->orderByDesc('id')->get();
        }

        $property = Property::find($this->property_id);
        $customer = Customer::find($this->customer_id);

        $clause_templates = ContractClauseTemplate::where('company_id', user()->company_id == 1 ? $this->company_id : user()->company_id)
            ->active()
            ->orderBy('order_num', 'asc')
            ->get();

        return view('livewire.dashboard.contracts.edit-contract', [
            'companies' => $companies,
            'property' => $property,
            'customer' => $customer,
            'clause_templates' => $clause_templates,
        ]);
    }
}
