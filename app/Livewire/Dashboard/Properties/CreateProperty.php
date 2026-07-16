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
    public $zone_number, $street_number, $building_number, $property_type_id, $area, $property_status_id, $description;
    public $property_number, $title_deed_number, $electricity_account_number, $water_account_number, $parent_id, $file_number, $company_id, $floor;

    // Property Attachments Repeater
    public $property_attachments = [];

    // Owners Repeater
    public $property_owners = [];

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
                $this->dispatch('notify', message: __('properties.duplicate_owner_error'), type: 'warning');
                return;
            }
        }

        // If the new owner is primary, set all others to non-primary
        if ($data['is_primary'] ?? false) {
            foreach ($this->property_owners as $key => $owner) {
                $this->property_owners[$key]['is_primary'] = false;
            }
        }

        $currentTotal = collect($this->property_owners)->sum('percentage');
        $remaining = max(0, 100 - $currentTotal);
        
        $newPercentage = $data['percentage'] ?? (count($this->property_owners) === 0 ? 100 : 0);
        $newPercentage = is_numeric($newPercentage) ? (float)$newPercentage : 0;
        
        if ($newPercentage > $remaining) {
            $newPercentage = $remaining;
            $this->dispatch('notify', message: __('properties.percentage_must_be_100'), type: 'warning');
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
            'percentage' => $newPercentage,
            'shares' => round($newPercentage * 24),
            'is_primary' => !empty($data['is_primary']) ? true : (count($this->property_owners) === 0)
        ]);

        $this->dispatch('notify', message: __('properties.owner_row_added'), type: 'success');
    }

    public function updated($name, $value)
    {
        if (str_starts_with($name, 'property_owners.')) {
            $parts = explode('.', $name);
            if (count($parts) === 3) {
                $index = $parts[1];
                $field = $parts[2];

                if ($field === 'percentage') {
                    $val = is_numeric($value) ? (float)$value : 0;
                    if ($val < 0) $val = 0;
                    if ($val > 100) $val = 100;

                    $otherTotal = 0;
                    foreach ($this->property_owners as $k => $owner) {
                        if ($k != $index) $otherTotal += (float)($owner['percentage'] ?? 0);
                    }
                    
                    $maxAllowed = max(0, 100 - $otherTotal);
                    if ($val > $maxAllowed) {
                        $val = $maxAllowed;
                        $this->dispatch('notify', message: __('properties.percentage_must_be_100'), type: 'warning');
                    }

                    $this->property_owners[$index]['percentage'] = $val;
                    $this->property_owners[$index]['shares'] = round($val * 24);
                } elseif ($field === 'shares') {
                    $val = is_numeric($value) ? (float)$value : 0;
                    if ($val < 0) $val = 0;
                    if ($val > 2400) $val = 2400;

                    $otherTotalShares = 0;
                    foreach ($this->property_owners as $k => $owner) {
                        if ($k != $index) $otherTotalShares += (float)($owner['shares'] ?? 0);
                    }
                    
                    $maxAllowedShares = max(0, 2400 - $otherTotalShares);
                    if ($val > $maxAllowedShares) {
                        $val = $maxAllowedShares;
                        $this->dispatch('notify', message: __('properties.percentage_must_be_100'), type: 'warning');
                    }

                    $this->property_owners[$index]['shares'] = $val;
                    $this->property_owners[$index]['percentage'] = round($val / 24, 2);
                }
            }
        }
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
            $this->dispatch('notify', message: __('properties.please_select_company_first'), type: 'warning');
            $this->dispatch('rowAdded'); // Re-init Select2
            return;
        }

        $currentTotal = collect($this->property_owners)->sum('percentage');
        $remaining = max(0, 100 - $currentTotal);

        $this->dispatch('set-quick-percentage', percentage: $remaining);
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

    public function addAttachment()
    {
        $this->property_attachments[] = ['name' => '', 'file' => null];
    }

    public function removeAttachment($index)
    {
        unset($this->property_attachments[$index]);
        $this->property_attachments = array_values($this->property_attachments);
    }

    protected function rules()
    {
        $current_company_id = user()->company_id == 1 ? $this->company_id : user()->company_id;

        return [
            'name.ar' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'zone_number' => 'nullable|string|max:255',
            'street_number' => 'nullable|string|max:255',
            'building_number' => 'nullable|string|max:255',
            'property_type_id' => 'required|exists:property_types,id',
            'area' => 'nullable|string|max:255',

            'property_status_id' => 'required|exists:property_statuses,id',
            'description' => 'nullable|string',
            'property_number' => 'nullable|string|max:255',
            'title_deed_number' => 'nullable|string|max:255',
            'electricity_account_number' => 'nullable|string|max:255',
            'water_account_number' => 'nullable|string|max:255',
            'file_number' => ['nullable', 'string', 'max:255', Rule::unique('properties', 'file_number')->where('company_id', $current_company_id)],
            'floor' => 'nullable|string|max:255',
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

            // Attachments Repeater
            'property_attachments' => 'nullable|array',
            'property_attachments.*.name' => 'required|string|max:255',
            'property_attachments.*.file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
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
            $this->dispatch('rowAdded'); // Re-init Select2 after DOM refresh
            $errors = $e->validator->errors()->all();
            $this->dispatch('notify', message: count($errors) === 1 ? $errors[0] : __('general.validation_error_message'), type: 'error');
            throw $e;
        }

        // Calculate total percentage
        $totalPercentage = collect($this->property_owners)->sum('percentage');
        if ($totalPercentage != 100) {
            $this->dispatch('rowAdded'); // Re-init Select2
            $this->addError('property_owners_total', __('properties.percentage_must_be_100'));
            $this->dispatch('notify', message: __('properties.percentage_must_be_100'), type: 'error');
            return;
        }

        // Ensure at least one primary
        $hasPrimary = collect($this->property_owners)->contains('is_primary', true);
        if (!$hasPrimary) {
            $this->dispatch('rowAdded'); // Re-init Select2
            $this->addError('property_owners_primary', __('properties.must_select_primary_owner'));
            return;
        }

        $data = [
            'name' => $this->name,
            'zone_number' => $this->zone_number,
            'street_number' => $this->street_number,
            'building_number' => $this->building_number,
            'property_type_id' => $this->property_type_id,
            'area' => $this->area,

            'property_status_id' => $this->property_status_id,
            'description' => $this->description,
            'property_number' => $this->property_number,
            'title_deed_number' => $this->title_deed_number,
            'electricity_account_number' => $this->electricity_account_number,
            'water_account_number' => $this->water_account_number,
            'file_number' => $this->file_number,
            'floor' => $this->floor,
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

        // Handle Repeater Attachments
        foreach ($this->property_attachments as $attachment) {
            if (!empty($attachment['file']) && !empty($attachment['name'])) {
                $path = $attachment['file']->store('/', 'properties');
                $property->attachments()->create([
                    'name' => $attachment['name'],
                    'file' => $path,
                ]);
            }
        }

        flash()->success(__('general.add_success_message'));
        return redirect(route('dashboard.properties.index'));
    }

    public function resetFile($field)
    {
        $this->$field = null;
    }

    public function render()
    {
        $company_id = user()->company_id == 1 ? $this->company_id : user()->company_id;
        
        $property_types = PropertyType::whereNull('company_id')
            ->when($company_id, function ($query) use ($company_id) {
                $query->orWhere('company_id', $company_id);
            })
            ->orderByDesc('id')
            ->get()
            ->unique('name');
            
        $property_statuses = PropertyStatus::whereNull('company_id')
            ->when($company_id, function ($query) use ($company_id) {
                $query->orWhere('company_id', $company_id);
            })
            ->orderByDesc('id')
            ->get()
            ->unique('name');
        $companies = Company::active()->orderByDesc('id')->get();
        $parent_properties = Property::whereNull('parent_id')->orderByDesc('id')->get();

        return view('livewire.dashboard.properties.create-property', [
            'property_types' => $property_types,
            'property_statuses' => $property_statuses,
            'companies' => $companies,
            'parent_properties' => $parent_properties,
        ]);
    }
}
