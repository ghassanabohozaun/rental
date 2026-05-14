<?php

namespace App\Livewire\Dashboard\Customers;

use App\Models\Company;
use Livewire\Component;

class QuickGuarantorModal extends Component
{
    public $quick_name = ['ar' => '', 'en' => ''];
    public $quick_phone, $quick_id_number, $quick_address, $quick_relationship, $quick_relationship_details, $quick_notes, $quick_company_id;
    public $companies = [];
    public $selected_guarantor_id = null;
    public $is_existing = false;
    const RELATIONSHIP_OTHER = 10;
    
    public $searchTerm = '';
    public $searchResults = [];

    protected $listeners = ['guarantorSelected' => 'loadGuarantorData'];

    protected function rules()
    {
        return [
            'quick_name.ar' => 'required|string|max:255',
            'quick_name.en' => 'required|string|max:255',
            'quick_id_number' => 'required|string|max:50',
            'quick_phone' => 'nullable|string|max:20',
            'quick_relationship' => 'required|string|max:100', // Made required for pivot
            'quick_relationship_details' => 'required_if:quick_relationship,' . self::RELATIONSHIP_OTHER . '|nullable|string|max:255',
            'quick_address' => 'nullable|string|max:255',
            'quick_notes' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'quick_relationship_details.required_if' => __('validation.required_if', [
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
            'quick_id_number' => __('guarantors.id_number'),
            'quick_phone' => __('guarantors.phone'),
            'quick_relationship' => __('guarantors.relationship'),
            'quick_relationship_details' => __('guarantors.relationship_details'),
        ];
    }

    #[\Livewire\Attributes\Reactive]
    public $parent_company_id = null;

    public function updatedSearchTerm($value)
    {
        if (strlen($value) < 1) {
            $this->searchResults = [];
            return;
        }

        // Determine the actual company ID
        $companyId = user()->company_id == 1 ? $this->parent_company_id : user()->company_id;

        if (empty($companyId)) {
            flash()->warning(message: __('guarantors.please_select_company_first'), options: ['position' => Lang() == 'ar' ? 'top-left' : 'top-right']);
            $this->searchResults = [];
            return;
        }

        $this->searchResults = \App\Models\Guarantor::active()
            ->where('company_id', $companyId)
            ->where(function ($q) use ($value) {
                $q->where('name', 'like', '%' . $value . '%')
                  ->orWhere('phone', 'like', '%' . $value . '%')
                  ->orWhere('id_number', 'like', '%' . $value . '%');
            })
            ->limit(30)
            ->get()
            ->toArray();
    }

    public function selectGuarantor($id)
    {
        $this->loadGuarantorData($id);
        $this->searchResults = [];
        $this->searchTerm = '';
    }

    public function loadGuarantorData($id)
    {
        if (empty($id)) {
            $this->resetGuarantorData();
            return;
        }

        $guarantor = \App\Models\Guarantor::find($id);
        if ($guarantor) {
            $this->selected_guarantor_id = $guarantor->id;
            $this->is_existing = true;
            
            $this->quick_name['ar'] = $guarantor->getTranslation('name', 'ar', false) ?: '';
            $this->quick_name['en'] = $guarantor->getTranslation('name', 'en', false) ?: '';
            $this->quick_id_number = $guarantor->id_number;
            $this->quick_phone = $guarantor->phone;
            $this->quick_address = $guarantor->address;
            $this->quick_notes = $guarantor->notes;
            
            // We do NOT set quick_relationship because it belongs to the pivot
            $this->quick_relationship = '';
            $this->quick_relationship_details = '';
        }
    }

    public function resetGuarantorData()
    {
        $this->selected_guarantor_id = null;
        $this->is_existing = false;
        $this->searchTerm = '';
        $this->searchResults = [];
        $this->reset(['quick_name', 'quick_phone', 'quick_id_number', 'quick_address', 'quick_relationship', 'quick_relationship_details', 'quick_notes']);
    }

    public function saveQuickGuarantor()
    {
        $this->validate();

        $data = [
            'guarantor_id' => $this->selected_guarantor_id,
            'company_id' => null,
            'name_ar' => $this->quick_name['ar'],
            'name_en' => $this->quick_name['en'],
            'phone' => $this->quick_phone,
            'id_number' => $this->quick_id_number,
            'address' => $this->quick_address,
            'relationship' => $this->quick_relationship,
            'relationship_details' => $this->quick_relationship_details,
            'notes' => $this->quick_notes,
        ];

        $this->dispatch('guarantorAdded', $data);
        $this->dispatch('close-modal', 'quick-guarantor-modal');
        $this->resetGuarantorData();
    }

    public function render()
    {
        return view('livewire.dashboard.customers.quick-guarantor-modal');
    }
}
