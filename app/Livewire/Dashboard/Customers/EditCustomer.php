<?php
// cspell:disable

namespace App\Livewire\Dashboard\Customers;

use App\Models\Nationality;
use App\Models\Guarantor;
use App\Models\Company;
use App\Models\Customer;
use App\Services\Dashboard\CustomerService;
use Livewire\Component;
use Illuminate\Validation\Rule;

class EditCustomer extends Component
{
    // Customer Fields
    public $customer_id;
    public $name = ['ar' => '', 'en' => ''];
    public $phone, $email, $id_number, $address, $nationality_id, $tenant_type, $notes, $company_id;
    public $company_name, $establishment_number, $cr_number, $license_number;

    // Guarantors Repeater
    public $customer_guarantors = [];

    protected $listeners = ['guarantorAdded'];
    public $validation_fail_nonce = 0;
    const RELATIONSHIP_OTHER = 10;

    public function updatedCompanyId()
    {
        $this->resetErrorBag('company_id');
        $this->dispatch('reinitSelect2');
    }

    public function updatedTenantType()
    {
        $this->dispatch('reinitSelect2');
    }

    public function addGuarantor()
    {
        $this->customer_guarantors[] = [
            'guarantor_id' => '',
            'company_id' => '',
            'name_ar' => '',
            'name_en' => '',
            'id_number' => '',
            'relationship' => '',
            'relationship_details' => '',
        ];
        $this->dispatch('reinitSelect2');
    }

    public function updatedCustomerGuarantors($value, $key)
    {
        // Logic disabled: We now rely solely on the Modal for data entry.
    }

    public function removeGuarantor($index)
    {
        unset($this->customer_guarantors[$index]);
        $this->customer_guarantors = array_values($this->customer_guarantors);
    }

    public function setPrimary($index)
    {
        foreach ($this->customer_guarantors as $key => $guarantor) {
            $this->customer_guarantors[$key]['is_primary'] = $key === $index;
        }
    }

    public function mount($id, CustomerService $service)
    {
        $this->customer_id = $id;
        $customer = $service->getOne($id);

        $this->name = [
            'ar' => $customer->getTranslation('name', 'ar'),
            'en' => $customer->getTranslation('name', 'en'),
        ];
        $this->phone = $customer->phone;
        $this->email = $customer->email;
        $this->id_number = $customer->id_number;
        $this->address = $customer->address;
        $this->nationality_id = $customer->nationality_id;
        $this->tenant_type = $customer->tenant_type;
        $this->notes = $customer->notes;
        $this->company_id = $customer->company_id;
        $this->company_name = $customer->company_name;
        $this->establishment_number = $customer->establishment_number;
        $this->cr_number = $customer->cr_number;
        $this->license_number = $customer->license_number;

        // Load Guarantors
        $this->customer_guarantors = $customer->guarantors
            ->map(function ($g) {
                return [
                    'guarantor_id' => $g->id,
                    'company_id' => $g->company_id,
                    'name_ar' => $g->getTranslation('name', 'ar'),
                    'name_en' => $g->getTranslation('name', 'en'),
                    'id_number' => $g->id_number,
                    'phone' => $g->phone,
                    'address' => $g->address,
                    'relationship' => $g->pivot->relationship,
                    'relationship_details' => $g->pivot->relationship_details,
                    'notes' => $g->notes,
                ];
            })
            ->toArray();

        if (empty($this->customer_guarantors)) {
            $this->customer_guarantors = [];
        }
    }

    protected function rules()
    {
        $current_company_id = user()->company_id == 1 ? $this->company_id : user()->company_id;

        $rules = [
            'name.ar' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'id_number' => ['required', 'string', 'max:255', Rule::unique('customers', 'id_number')->ignore($this->customer_id)->where('company_id', $current_company_id)->whereNull('deleted_at')],
            'address' => 'required|string|max:255',
            'nationality_id' => 'required|exists:nationalities,id',
            'tenant_type' => 'required|in:individual,company',
            'notes' => 'nullable|string',

            // Guarantors Validation
            'customer_guarantors' => 'required|array|min:1',
            'customer_guarantors.*.name_ar' => 'required|string',
            'customer_guarantors.*.name_en' => 'required|string',
            'customer_guarantors.*.id_number' => 'required|string',
            'customer_guarantors.*.relationship' => 'required|string',
            'customer_guarantors.*.relationship_details' => 'required_if:customer_guarantors.*.relationship,' . self::RELATIONSHIP_OTHER . '|nullable|string|max:255',
        ];

        // Conditional Company Rules
        if ($this->tenant_type == 'company') {
            $rules['company_name'] = 'required|string|max:255';
            $rules['establishment_number'] = 'required|string|max:255';
            $rules['cr_number'] = 'required|string|max:255';
            $rules['license_number'] = 'required|string|max:255';
        } else {
            $rules['company_name'] = 'nullable|string|max:255';
            $rules['establishment_number'] = 'nullable|string|max:255';
            $rules['cr_number'] = 'nullable|string|max:255';
            $rules['license_number'] = 'nullable|string|max:255';
        }

        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'customer_guarantors.*.guarantor_id.distinct' => __('customers.duplicate_guarantor_error'),
            'customer_guarantors.min' => __('customers.at_least_one_guarantor'),
            'customer_guarantors.required' => __('customers.at_least_one_guarantor'),
            'customer_guarantors.*.relationship_details.required_if' => __('validation.required_if', [
                'attribute' => __('guarantors.relationship_details'),
                'other' => __('guarantors.relationship'),
                'value' => __('guarantors.relationships.' . self::RELATIONSHIP_OTHER),
            ]),
        ];
    }

    public function validationAttributes()
    {
        return [
            'quick_name.ar' => __('guarantors.name') . ' (' . __('general.ar') . ')',
            'quick_name.en' => __('guarantors.name') . ' (' . __('general.en') . ')',
            'quick_company_id' => __('companies.company'),
            'quick_id_number' => __('guarantors.id_number'),
            'quick_phone' => __('guarantors.phone'),
            'quick_relationship' => __('guarantors.relationship'),
        ];
    }

    public function update()
    {
        $this->validation_fail_nonce++;
        $this->validate();

        $customer = Customer::findOrFail($this->customer_id);
        $data = [
            'company_id' => user()->company_id == 1 ? $this->company_id : user()->company_id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'id_number' => $this->id_number,
            'address' => $this->address,
            'nationality_id' => $this->nationality_id,
            'tenant_type' => $this->tenant_type,
            'notes' => $this->notes,
        ];

        if ($this->tenant_type == 'company') {
            $data['company_name'] = $this->company_name;
            $data['establishment_number'] = $this->establishment_number;
            $data['cr_number'] = $this->cr_number;
            $data['license_number'] = $this->license_number;
        } else {
            $data['company_name'] = null;
            $data['establishment_number'] = null;
            $data['cr_number'] = null;
            $data['license_number'] = null;
        }

        $customer->update($data);

        $guarantorSyncData = [];
        foreach ($this->customer_guarantors as $data) {
            if (!empty($data['guarantor_id'])) {
                $guarantor = Guarantor::find($data['guarantor_id']);
                if ($guarantor) {
                    $guarantorSyncData[$guarantor->id] = [
                        'relationship' => $data['relationship'] ?? null,
                        'relationship_details' => $data['relationship_details'] ?? null
                    ];
                }
            } else {
                $guarantor = Guarantor::create([
                    'company_id' => $data['company_id'],
                    'name' => ['ar' => $data['name_ar'], 'en' => $data['name_en']],
                    'phone' => $data['phone'] ?? null,
                    'id_number' => $data['id_number'],
                    'address' => $data['address'] ?? null,
                    'notes' => $data['notes'] ?? null,
                    'status' => 1,
                    'created_by' => auth()->id(),
                ]);
                $guarantorSyncData[$guarantor->id] = [
                    'relationship' => $data['relationship'] ?? null,
                    'relationship_details' => $data['relationship_details'] ?? null
                ];
            }
        }
        $customer->guarantors()->sync($guarantorSyncData);

        flash()->success(message: __('general.update_success_message'), options: ['position' => Lang() == 'ar' ? 'top-left' : 'top-right']);
        return redirect()->route('dashboard.customers.index');
    }

    public function guarantorAdded($data)
    {
        // Check if guarantor already exists in the list by ID Number
        $existingIds = array_column($this->customer_guarantors, 'id_number');
        if (in_array($data['id_number'], $existingIds)) {
            flash()->warning(message: __('guarantors.guarantor_already_exists'), options: ['position' => Lang() == 'ar' ? 'top-left' : 'top-right']);
            return;
        }

        // Inject the correct company_id
        if (user()->company_id == 1) {
            $data['company_id'] = $this->customer_id ? Customer::find($this->customer_id)->company_id : $this->company_id;
        } else {
            $data['company_id'] = user()->company_id;
        }

        // Add to the beginning of the array so it appears at the top
        array_unshift($this->customer_guarantors, $data);

        flash()->success(message: __('customers.guarantor_added_to_list'), options: ['position' => Lang() == 'ar' ? 'top-left' : 'top-right']);

        $this->dispatch('reinitSelect2');
    }

    public function openGuarantorModal()
    {
        // If Super Admin, check if company is selected (either from existing customer or header select)
        $companyId = $this->customer_id ? Customer::find($this->customer_id)->company_id : $this->company_id;
        if (user()->company_id == 1 && empty($companyId)) {
            $this->validation_fail_nonce++;
            $this->addError('company_id', __('guarantors.please_select_company_first'));
            flash()->warning(message: __('guarantors.please_select_company_first'), options: ['position' => Lang() == 'ar' ? 'top-left' : 'top-right']);
            return;
        }

        $this->dispatch('open-modal', 'quick-guarantor-modal');
    }

    public function render()
    {
        $companies = Company::orderByDesc('id')->get();
        $nationalities = Nationality::all();
        $guarantors = Guarantor::with('company')
            ->when(user()->company_id != 1, function ($q) {
                return $q->where('company_id', user()->company_id);
            })
            ->get();

        return view('livewire.dashboard.customers.edit-customer', [
            'companies' => $companies,
            'nationalities' => $nationalities,
            'guarantors' => $guarantors,
        ]);
    }
}
