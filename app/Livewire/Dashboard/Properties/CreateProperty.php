<?php
// cspell:disable

namespace App\Livewire\Dashboard\Properties;

use App\Models\Owner;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\PropertyStatus;
use App\Models\Company;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CreateProperty extends Component
{
    use WithFileUploads;

    // Property Fields
    public $name = ['ar' => '', 'en' => ''];
    public $location, $property_type_id, $area, $price, $property_status_id, $description;
    public $property_number, $title_deed_number, $electricity_account_number, $water_account_number, $parent_id, $file_number, $company_id;

    // Attachments
    public $rental_contract_original, $building_completion_certificate, $other_documents;

    // Owners Repeater
    public $property_owners = [];

    public $validation_fail_nonce = 0;

    public function mount()
    {
        // Initialize with empty array, owners will be added via modal
        // $this->addOwner(); // Removed: user now adds via modal

        if (user()->company_id != 1) {
            $this->company_id = user()->company_id;
        }
    }

    #[On('ownerAdded')]
    public function handleOwnerAdded($data)
    {
        // Check if owner already exists in the list
        if (empty($data['is_new'])) {
            $exists = collect($this->property_owners)->contains(function ($owner) use ($data) {
                return !empty($owner['owner_id']) && $owner['owner_id'] == $data['owner_id'];
            });

            if ($exists) {
                flash()->warning(message: __('properties.duplicate_owner_error'), options: ['position' => Lang() == 'ar' ? 'top-left' : 'top-right']);
                return;
            }
        }

        // If the new owner is primary, set all others to non-primary
        if ($data['is_primary'] ?? false) {
            foreach ($this->property_owners as $key => $owner) {
                $this->property_owners[$key]['is_primary'] = false;
            }
        }

        // Add to the beginning of the array
        array_unshift($this->property_owners, [
            'owner_id' => $data['owner_id'],
            'is_new' => $data['is_new'] ?? false,
            'name_ar' => $data['name_ar'] ?? '',
            'name_en' => $data['name_en'] ?? '',
            'identification_number' => $data['identification_number'] ?? '',
            'phone' => $data['phone'] ?? '',
            'email' => $data['email'] ?? null,
            'address' => $data['address'] ?? null,
            'notes' => $data['notes'] ?? null,
            'percentage' => $data['percentage'] ?? '',
            'is_primary' => $data['is_primary'] ?? (count($this->property_owners) === 0)
        ]);

        flash()->success(message: __('properties.owner_row_added'), options: ['position' => Lang() == 'ar' ? 'top-left' : 'top-right']);
    }

    public function updatedCompanyId()
    {
        $this->resetErrorBag('company_id');
        $this->dispatch('rowAdded');
    }

    public function openOwnerModal()
    {
        if (user()->company_id == 1 && empty($this->company_id)) {
            $this->addError('company_id', __('properties.please_select_company_first'));
            flash()->warning(message: __('properties.please_select_company_first'), options: ['position' => Lang() == 'ar' ? 'top-left' : 'top-right']);
            $this->validation_fail_nonce++;
            $this->dispatch('rowAdded'); // Re-init Select2
            return;
        }

        $this->dispatch('open-modal', 'quick-owner-modal');
    }

    public function removeOwner($index)
    {
        if (isset($this->property_owners[$index])) {
            $wasPrimary = $this->property_owners[$index]['is_primary'] ?? false;
            unset($this->property_owners[$index]);
            $this->property_owners = array_values($this->property_owners);

            // If we deleted the primary owner, make the first one primary
            if ($wasPrimary && count($this->property_owners) > 0) {
                $this->property_owners[0]['is_primary'] = true;
            }
        }
    }

    public function setPrimary($index)
    {
        foreach ($this->property_owners as $key => $owner) {
            $this->property_owners[$key]['is_primary'] = ($key === $index);
        }
    }

    protected function rules()
    {
        $current_company_id = user()->company_id == 1 ? $this->company_id : user()->company_id;

        return [
            'name.ar' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'property_type_id' => 'required|exists:property_types,id',
            'area' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0|max:999999999999',
            'property_status_id' => 'required|exists:property_statuses,id',
            'description' => 'nullable|string',
            'property_number' => 'nullable|string|max:255',
            'title_deed_number' => 'nullable|string|max:255',
            'electricity_account_number' => 'required|string|max:255',
            'water_account_number' => 'required|string|max:255',
            'file_number' => ['nullable', 'string', 'max:255', Rule::unique('properties', 'file_number')->where('company_id', $current_company_id)],
            'parent_id' => 'nullable|exists:properties,id',
            'company_id' => user()->company_id == 1 ? 'required|exists:companies,id' : 'nullable',

            // Owners Validation
            'property_owners' => 'required|array|min:1',
            'property_owners.*.owner_id' => [
                'required',
                'distinct',
                function ($attribute, $value, $fail) {
                    if (strpos($value, 'new_') === 0) {
                        return; // Valid new owner
                    }
                    if (!\App\Models\Owner::where('id', $value)->exists()) {
                        $fail(__('validation.exists', ['attribute' => 'owner_id']));
                    }
                },
            ],
            'property_owners.*.percentage' => 'required|numeric|min:0|max:100',

            // Files
            'rental_contract_original' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'building_completion_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'other_documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'property_owners.*.owner_id.distinct' => __('properties.duplicate_owner_error'),
        ];
    }


    public function store()
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->validation_fail_nonce++;
            $this->dispatch('rowAdded'); // Re-init Select2 after DOM refresh
            $message = __('general.validation_error_message');
            flash()->error(message: $message, options: ['position' => Lang() == 'ar' ? 'top-left' : 'top-right']);
            throw $e;
        }

        // Calculate total percentage
        $totalPercentage = collect($this->property_owners)->sum('percentage');
        if ($totalPercentage != 100) {
            $this->validation_fail_nonce++;
            $this->dispatch('rowAdded'); // Re-init Select2
            $this->addError('property_owners_total', __('properties.percentage_must_be_100'));
            return;
        }

        // Ensure at least one primary
        $hasPrimary = collect($this->property_owners)->contains('is_primary', true);
        if (!$hasPrimary) {
            $this->validation_fail_nonce++;
            $this->dispatch('rowAdded'); // Re-init Select2
            $this->addError('property_owners_primary', __('properties.must_select_primary_owner'));
            return;
        }

        // Logic to save property...
        // (Similar to PropertyController@store but for Livewire)

        $data = [
            'name' => $this->name,
            'location' => $this->location,
            'property_type_id' => $this->property_type_id,
            'area' => $this->area,
            'price' => $this->price,
            'property_status_id' => $this->property_status_id,
            'description' => $this->description,
            'property_number' => $this->property_number,
            'title_deed_number' => $this->title_deed_number,
            'electricity_account_number' => $this->electricity_account_number,
            'water_account_number' => $this->water_account_number,
            'file_number' => $this->file_number,
            'parent_id' => $this->parent_id ?: null,
            'company_id' => user()->company_id == 1 ? $this->company_id : user()->company_id,
        ];

        $property = Property::create($data);

        // Handle Owners
        $syncData = [];
        foreach ($this->property_owners as $ownerData) {
            $ownerId = $ownerData['owner_id'];

            if (!empty($ownerData['is_new'])) {
                $newOwner = \App\Models\Owner::create([
                    'company_id' => user()->company_id == 1 ? $this->company_id : user()->company_id,
                    'name' => ['ar' => $ownerData['name_ar'], 'en' => $ownerData['name_en']],
                    'identification_number' => $ownerData['identification_number'],
                    'phone' => $ownerData['phone'],
                    'email' => $ownerData['email'] ?? null,
                    'address' => $ownerData['address'] ?? null,
                    'notes' => $ownerData['notes'] ?? null,
                    'type' => 'individual',
                    'status' => 'active',
                ]);
                $ownerId = $newOwner->id;
            }

            $syncData[$ownerId] = [
                'ownership_percentage' => $ownerData['percentage'],
                'is_primary' => $ownerData['is_primary']
            ];
        }
        $property->owners()->sync($syncData);

        // Handle Files
        if ($this->rental_contract_original) {
            $property->update(['rental_contract_original' => $this->rental_contract_original->store('contracts', 'properties')]);
        }
        if ($this->building_completion_certificate) {
            $property->update(['building_completion_certificate' => $this->building_completion_certificate->store('certificates', 'properties')]);
        }
        if ($this->other_documents) {
            $property->update(['other_documents' => $this->other_documents->store('docs', 'properties')]);
        }

        return redirect(route('dashboard.properties.index'));
    }

    public function resetFile($field)
    {
        $this->$field = null;
    }

    public function render()
    {

        $property_types = PropertyType::orderByDesc('id')->get();
        $property_statuses = PropertyStatus::orderByDesc('id')->get();
        $companies = Company::orderByDesc('id')->get();
        $parent_properties = Property::whereNull('parent_id')->orderByDesc('id')->get();

        return view('livewire.dashboard.properties.create-property', [
            'property_types' => $property_types,
            'property_statuses' => $property_statuses,
            'companies' => $companies,
            'parent_properties' => $parent_properties,
        ]);
    }
}
