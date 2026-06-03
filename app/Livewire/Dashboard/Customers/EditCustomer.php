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

    public $selected_guarantors = [];

    public function updatedCompanyId()
    {
        $this->resetErrorBag('company_id');
        $this->dispatch('reinitSelect2');
    }

    public function updatedTenantType()
    {
        $this->dispatch('reinitSelect2');
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
        $this->selected_guarantors = $customer->guarantors->pluck('id')->toArray();
    }

    protected function rules()
    {
        $current_company_id = user()->company_id == 1 ? $this->company_id : user()->company_id;

        $rules = [
            'name.ar' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'id_number' => ['required', 'string', 'max:255', Rule::unique('customers', 'id_number')->ignore($this->customer_id)->where('company_id', $current_company_id)->whereNull('deleted_at')],
            'address' => 'nullable|string|max:255',
            'nationality_id' => 'required|exists:nationalities,id',
            'tenant_type' => 'required|in:individual,company',
            'notes' => 'nullable|string',

            // Guarantors Validation
            'selected_guarantors' => 'nullable|array',
            'selected_guarantors.*' => 'exists:guarantors,id',
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
        return [];
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
        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('reinitSelect2');
            $errors = $e->validator->errors()->all();
            $this->dispatch('notify', message: count($errors) === 1 ? $errors[0] : __('general.validation_error_message'), type: 'error');
            throw $e;
        }

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

        $customer->guarantors()->sync($this->selected_guarantors ?? []);

        flash()->success(__('general.update_success_message'));
        return redirect()->route('dashboard.customers.index');
    }



    public function render()
    {
        $companies = Company::active()
            ->orWhere('id', $this->company_id)
            ->orderByDesc('id')
            ->get();
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
