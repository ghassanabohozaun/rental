<?php
// cspell:disable

namespace App\Livewire\Dashboard\Customers;

use App\Models\Nationality;
use App\Models\Guarantor;
use App\Models\Company;
use App\Services\Dashboard\CustomerService;
use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\Customer;
class CreateCustomer extends Component
{
    // Customer Fields
    public $name = ['ar' => '', 'en' => ''];
    public $phone, $email, $id_number, $address, $nationality_id, $tenant_type, $notes, $company_id;
    public $company_name, $establishment_number, $cr_number, $license_number;

    // Guarantors Repeater
    public $customer_guarantors = [];

    public $active_guarantor_index;
    public $validation_fail_nonce = 0;
    const RELATIONSHIP_OTHER = 10;

    protected $listeners = ['guarantorAdded'];

    public function updatedCompanyId()
    {
        $this->resetErrorBag('company_id');
        $this->dispatch('reinitSelect2');
    }

    public function mount()
    {
        if (user()->company_id != 1) {
            $this->company_id = user()->company_id;
        }
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
            'phone' => '',
            'address' => '',
            'notes' => '',
        ];
        $this->dispatch('reinitSelect2');
    }

    public function updatedTenantType()
    {
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
            $this->customer_guarantors[$key]['is_primary'] = ($key === $index);
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
            'id_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('customers', 'id_number')
                    ->where('company_id', $current_company_id)
                    ->whereNull('deleted_at')
            ],
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

    public function store()
    {
        $this->validation_fail_nonce++;
        $this->validate();

        $customer = Customer::create([
            'company_id' => user()->company_id == 1 ? $this->company_id : user()->company_id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'id_number' => $this->id_number,
            'address' => $this->address,
            'nationality_id' => $this->nationality_id,
            'tenant_type' => $this->tenant_type,
            'company_name' => $this->company_name,
            'establishment_number' => $this->establishment_number,
            'cr_number' => $this->cr_number,
            'license_number' => $this->license_number,
            'notes' => $this->notes,
            'status' => 1,
            'created_by' => auth()->id(),
        ]);

        foreach ($this->customer_guarantors as $data) {
            if (!empty($data['guarantor_id'])) {
                $customer->guarantors()->attach($data['guarantor_id'], [
                    'relationship' => $data['relationship'],
                    'relationship_details' => $data['relationship_details'] ?? null
                ]);
            } else {
                $guarantor = Guarantor::create([
                    'company_id' => $data['company_id'],
                    'name' => ['ar' => $data['name_ar'], 'en' => $data['name_en']],
                    'phone' => $data['phone'],
                    'id_number' => $data['id_number'],
                    'address' => $data['address'],
                    'notes' => $data['notes'],
                    'status' => 1,
                    'created_by' => auth()->id(),
                ]);
                $customer->guarantors()->attach($guarantor->id, [
                    'relationship' => $data['relationship'],
                    'relationship_details' => $data['relationship_details'] ?? null
                ]);
            }
        }

        flash()->success(message: __('general.add_success_message'), options: ['position' => Lang() == 'ar' ? 'top-left' : 'top-right']);
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
        $data['company_id'] = user()->company_id == 1 ? $this->company_id : user()->company_id;

        // Add to the beginning of the array so it appears at the top
        array_unshift($this->customer_guarantors, $data);

        flash()->success(message: __('customers.guarantor_added_to_list'), options: ['position' => Lang() == 'ar' ? 'top-left' : 'top-right']);

        $this->dispatch('reinitSelect2');
    }

    public function openGuarantorModal()
    {
        if (user()->company_id == 1 && empty($this->company_id)) {
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
        $guarantors = Guarantor::with('company')->when(user()->company_id != 1, function($q) {
            return $q->where('company_id', user()->company_id);
        })->get();

        return view('livewire.dashboard.customers.create-customer', [
            'companies' => $companies,
            'nationalities' => $nationalities,
            'guarantors' => $guarantors
        ]);
    }
}
