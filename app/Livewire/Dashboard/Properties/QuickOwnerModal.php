<?php

namespace App\Livewire\Dashboard\Properties;

use App\Models\Owner;
use Livewire\Component;

class QuickOwnerModal extends Component
{
    public $quick_name = ['ar' => '', 'en' => ''];
    public $quick_phone, $quick_email, $quick_id_number, $quick_address, $quick_notes, $quick_type;
    public $selected_owner_id = null;
    public $is_existing = false;
    public $quick_percentage = 0;
    public $quick_is_primary = false;

    public $searchTerm = '';
    public $searchResults = [];

    protected $listeners = ['ownerSelected' => 'loadOwnerData'];

    protected function rules()
    {
        return [
            'quick_name.ar' => 'required|string|max:255',
            'quick_name.en' => 'required|string|max:255',
            'quick_id_number' => 'required|string|max:50',
            'quick_phone' => 'required|string|max:20',
            'quick_email' => 'nullable|email|max:255',
            'quick_address' => 'nullable|string|max:255',
            'quick_notes' => 'nullable|string',
            'quick_percentage' => 'nullable|numeric|min:0|max:100',
            'quick_is_primary' => 'boolean',
        ];
    }

    public function validationAttributes()
    {
        return [
            'quick_name.ar' => __('owners.name') . ' (' . __('general.ar') . ')',
            'quick_name.en' => __('owners.name') . ' (' . __('general.en') . ')',
            'quick_id_number' => __('owners.identification_number'),
            'quick_phone' => __('owners.phone'),
            'quick_email' => __('owners.email'),
            'quick_type' => __('owners.type'),
            'quick_percentage' => __('properties.ownership_percentage'),
            'quick_is_primary' => __('properties.is_primary'),
        ];
    }

    #[\Livewire\Attributes\Reactive]
    public $parent_company_id = null;

    public function mount()
    {
        $this->quick_type = 'individual';
    }

    public function updatedSearchTerm($value)
    {
        if (strlen($value) < 1) {
            $this->searchResults = [];
            return;
        }

        // Determine the actual company ID
        $companyId = user()->company_id == 1 ? $this->parent_company_id : user()->company_id;

        if (empty($companyId)) {
            flash()->warning(message: __('properties.please_select_company_first'), options: ['position' => Lang() == 'ar' ? 'top-left' : 'top-right']);
            $this->searchResults = [];
            return;
        }

        $this->searchResults = Owner::active()
            ->where('company_id', $companyId)
            ->where(function ($q) use ($value) {
                $q->where('name', 'like', '%' . $value . '%')
                  ->orWhere('phone', 'like', '%' . $value . '%')
                  ->orWhere('identification_number', 'like', '%' . $value . '%');
            })
            ->limit(30)
            ->get()
            ->toArray();
    }

    public function selectOwner($id)
    {
        $this->loadOwnerData($id);
        $this->searchResults = [];
        $this->searchTerm = '';
    }

    public function loadOwnerData($id)
    {
        if (empty($id)) {
            $this->resetOwnerData();
            return;
        }

        $owner = Owner::find($id);
        if ($owner) {
            $this->selected_owner_id = $owner->id;
            $this->is_existing = true;

            $this->quick_name['ar'] = $owner->getTranslation('name', 'ar', false) ?: '';
            $this->quick_name['en'] = $owner->getTranslation('name', 'en', false) ?: '';
            $this->quick_id_number = $owner->identification_number;
            $this->quick_phone = $owner->phone;
            $this->quick_email = $owner->email;
            $this->quick_address = $owner->address;
            $this->quick_notes = $owner->notes;
            $this->quick_type = $owner->type ?: 'individual';
        }
    }

    public function resetOwnerData()
    {
        $this->selected_owner_id = null;
        $this->is_existing = false;
        $this->searchTerm = '';
        $this->searchResults = [];
        $this->reset(['quick_name', 'quick_phone', 'quick_email', 'quick_id_number', 'quick_address', 'quick_notes', 'quick_type', 'quick_percentage', 'quick_is_primary']);
        $this->quick_type = 'individual';
    }

    public function saveQuickOwner()
    {
        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            flash()->error(message: __('general.validation_error_message'), options: ['position' => Lang() == 'ar' ? 'top-left' : 'top-right']);
            throw $e;
        }

        // Generate a temporary ID for new owners so they can be distinct in the array
        $ownerId = $this->selected_owner_id ?: uniqid('new_');

        $data = [
            'owner_id' => $ownerId,
            'is_new' => empty($this->selected_owner_id),
            'name_ar' => $this->quick_name['ar'] ?? '',
            'name_en' => $this->quick_name['en'] ?? '',
            'phone' => $this->quick_phone,
            'email' => $this->quick_email,
            'identification_number' => $this->quick_id_number,
            'address' => $this->quick_address,
            'notes' => $this->quick_notes,
            'percentage' => $this->quick_percentage,
            'is_primary' => $this->quick_is_primary,
        ];

        $this->dispatch('ownerAdded', $data);
        $this->dispatch('close-modal', 'quick-owner-modal');
        $this->resetOwnerData();
    }

    public function render()
    {
        return view('livewire.dashboard.properties.quick-owner-modal');
    }
}
