<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToCompany;
use App\Traits\Dashboard\Filterable;
use App\Contracts\MustBelongToCompany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Dashboard\HasCreatedBy;
use App\Traits\Dashboard\CanBeDeleted;
use App\Traits\Dashboard\HasFinancials;
use App\Models\Property;

class Contract extends Model implements MustBelongToCompany
{
    use HasFactory, BelongsToCompany, Filterable, SoftDeletes, HasCreatedBy, CanBeDeleted, HasFinancials;
    protected $fillable = ['company_id', 'property_id', 'customer_id', 'conclusion_date', 'start_date', 'end_date', 'contract_duration_months', 'rent_amount', 'total_rent_amount', 'deposit_amount', 'deposit_type', 'deposit_status', 'payment_cycle', 'status', 'contract_text', 'notes', 'created_by'];

    protected $casts = [
        'conclusion_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'rent_amount' => 'float',
        'deposit_amount' => 'float',
    ];

    protected $appends = ['total_amount', 'paid_amount', 'remaining_amount'];

    public function insuranceCheque()
    {
        return $this->hasOne(Cheque::class)->where('is_deposit', true);
    }
    /**
     * Get human-readable duration (e.g., 1 Year, 6 Months)
     */
    public function getDurationLabelAttribute()
    {
        if (!$this->start_date || !$this->end_date) {
            return '---';
        }

        $months = (int) round($this->start_date->floatDiffInMonths($this->end_date->copy()->addDay()));

        if ($months === 0) {
            $days = $this->start_date->diffInDays($this->end_date->copy()->addDay());
            return $days . ' ' . __('general.days');
        }

        return $months . ' ' . ($months == 1 ? __('general.month') : __('general.months'));
    }

    /**
     * Relationships that prevent deletion if they have records.
     */
    protected $restrictiveRelations = [
        'payments' => 'contracts.cannot_delete_has_payments',
        'cheques' => 'contracts.cannot_delete_has_cheques',
    ];

    /**
     * Get the property associated with the contract.
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the customer associated with the contract.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the payments associated with the contract.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the cheques associated with the contract.
     */
    public function cheques()
    {
        return $this->hasMany(Cheque::class);
    }

    /**
     * Get the details/snapshot for printing.
     */
    public function contractDetail()
    {
        return $this->hasOne(ContractDetail::class);
    }

    /**
     * Get the live first party data based on property relationships.
     */
    public function getLiveFirstPartyDataAttribute()
    {
        $company = optional($this->property)->company;
        
        $primaryOwner = null;
        if ($this->property && $this->property->owners) {
            $primaryOwner = $this->property->owners->where('pivot.is_primary', 1)->first();
            if (!$primaryOwner) {
                $primaryOwner = $this->property->owners->first();
            }
        }
        
        return [
            'name_ar' => $company ? $company->getTranslation('name', 'ar') : '---',
            'owner_name' => $primaryOwner ? $primaryOwner->name : '---',
            'owner_qid' => $primaryOwner ? $primaryOwner->identification_number : '---',
            'owner_phone' => $primaryOwner ? $primaryOwner->phone : '---',
        ];
    }

    /**
     * Get the creator of the contract.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the smart tags replacements for the contract.
     */
    public function getSmartTagsReplacements()
    {
        $detail = $this->contractDetail;
        if (!$detail) {
            return [];
        }

        $firstParty = $detail->first_party_data ?? [];
        $secondParty = $detail->second_party_data ?? [];
        $property = $detail->property_data ?? [];
        
        $companyName = $firstParty['name']['ar'] ?? ($firstParty['name'] ?? optional(optional($this->property)->company)->getTranslation('name', 'ar') ?? '');
        
        $liveOwner = optional($this->property)->owners ? $this->property->owners->where('pivot.is_primary', 1)->first() : null;
        if (!$liveOwner && optional($this->property)->owners) {
            $liveOwner = $this->property->owners->first();
        }

        $ownerName = $firstParty['owner_name'] ?? optional($liveOwner)->name ?? '';
        $ownerQid = $firstParty['owner_qid'] ?? optional($liveOwner)->identification_number ?? '';
        $ownerPhone = $firstParty['owner_phone'] ?? optional($liveOwner)->phone ?? '';

        $liveTenant = optional($this->customer);
        $tenantNationality = optional($liveTenant->nationality)->name ?? '';
        
        $liveProperty = optional($this->property);

        return [
            '${contract_number}' => $this->id,
            '${conclusion_date}' => $this->conclusion_date ? $this->conclusion_date->format('d/m/Y') : '',
            '${start_date}' => $this->start_date ? $this->start_date->format('d/m/Y') : '',
            '${end_date}' => $this->end_date ? $this->end_date->format('d/m/Y') : '',
            '${contract_duration}' => $this->duration_label,
            '${grace_period}' => $detail->grace_period ?? 'لا يوجد',
            '${deposit_amount}' => intval($this->deposit_amount) . ' ' . currency_name_ar(),
            '${deposit_amount_ar}' => tafqeet(intval($this->deposit_amount), currency_name_ar(), __('general.dirham')),
            '${rent_amount}' => intval($this->rent_amount) . ' ' . currency_name_ar(),
            '${rent_amount_ar}' => tafqeet(intval($this->rent_amount), currency_name_ar(), __('general.dirham')),
            '${first_party_name}' => $companyName,
            '${first_party_owner_name}' => $ownerName,
            '${first_party_owner_qid}' => $ownerQid,
            '${first_party_owner_phone}' => $ownerPhone,
            '${second_party_name}' => $secondParty['name']['ar'] ?? ($secondParty['name'] ?? optional($liveTenant)->name ?? ''),
            '${second_party_id}' => $secondParty['id_number'] ?? optional($liveTenant)->id_number ?? '',
            '${second_party_nationality}' => $tenantNationality,
            '${second_party_phone}' => $secondParty['phone'] ?? optional($liveTenant)->phone ?? '',
            '${second_party_company_name}' => $secondParty['company_name'] ?? optional($liveTenant)->company_name ?? '',
            '${second_party_cr_number}' => $secondParty['cr_number'] ?? optional($liveTenant)->cr_number ?? '',
            '${second_party_license_number}' => $secondParty['license_number'] ?? optional($liveTenant)->license_number ?? '',
            '${second_party_establishment_number}' => $secondParty['establishment_number'] ?? optional($liveTenant)->establishment_number ?? '',
            '${property_zone}' => $property['zone_number'] ?? '',
            '${property_street}' => $property['street_number'] ?? '',
            '${property_building}' => $property['building_number'] ?? '',
            '${property_deed}' => $property['title_deed_number'] ?? '',
            '${property_name_ar}' => $property['name_ar'] ?? $liveProperty->getTranslation('name', 'ar') ?? '',
            '${property_name_en}' => $property['name_en'] ?? $liveProperty->getTranslation('name', 'en') ?? '',
            '${property_type}' => $property['type'] ?? optional($liveProperty->propertyType)->name ?? '',
            '${property_floor}' => $property['floor'] ?? $liveProperty->floor ?? '',
            '${property_description}' => $property['description'] ?? $liveProperty->description ?? '',
            '${electricity_account_number}' => $property['electricity_account_number'] ?? $liveProperty->electricity_account_number ?? '',
            '${water_account_number}' => $property['water_account_number'] ?? $liveProperty->water_account_number ?? '',
            '${unit_rent_amount}' => (is_array($detail->utilities_data) && count($detail->utilities_data) > 0) ? ($detail->utilities_data[0]['unit_rent_amount'] ?? $this->rent_amount) : $this->rent_amount,
            '${unit_deposit_amount}' => (is_array($detail->utilities_data) && count($detail->utilities_data) > 0) ? ($detail->utilities_data[0]['unit_deposit_amount'] ?? $this->deposit_amount) : $this->deposit_amount,
        ];
    }

    /**
     * Replace smart tags in a given text.
     */
    public function replaceSmartTags($text)
    {
        if (empty($text)) {
            return '';
        }
        $replacements = $this->getSmartTagsReplacements();
        if (empty($replacements)) {
            return $text;
        }
        return str_replace(array_keys($replacements), array_values($replacements), $text);
    }

    /**
     * The "booted" method of the model.
     * Automates Property Status updates based on Contract lifecycle.
     */
    protected static function booted()
    {
        // When a contract is successfully created
        static::created(function ($contract) {
            if ($contract->property_id && $contract->status !== 'cancelled') {
                Property::where('id', $contract->property_id)->update(['property_status_id' => 2]); // Rented
            }
        });

        // When a contract is successfully updated
        static::updated(function ($contract) {
            // 1. Check if the property itself was changed
            if ($contract->wasChanged('property_id')) {
                $oldPropertyId = $contract->getOriginal('property_id');
                $newPropertyId = $contract->property_id;

                if ($oldPropertyId) {
                    Property::where('id', $oldPropertyId)->update(['property_status_id' => 1]); // Available
                }

                if ($newPropertyId && $contract->status !== 'cancelled') {
                    Property::where('id', $newPropertyId)->update(['property_status_id' => 2]); // Rented
                }
            }

            // 2. Check if the contract status changed (e.g., active -> ended)
            if ($contract->wasChanged('status')) {
                if (in_array($contract->status, ['ended', 'cancelled']) && $contract->property_id) {
                    Property::where('id', $contract->property_id)->update(['property_status_id' => 1]); // Available
                } elseif ($contract->status === 'active' && $contract->property_id) {
                    Property::where('id', $contract->property_id)->update(['property_status_id' => 2]); // Rented
                }
            }
        });

        // When a contract is deleted
        static::deleting(function ($contract) {
            // Delete related insurance cheque
            if ($contract->insuranceCheque) {
                $contract->insuranceCheque->delete();
            }

            // Reset property status to Available
            if ($contract->property_id) {
                Property::where('id', $contract->property_id)->update(['property_status_id' => 1]); // Available
            }
        });

        // When a contract is restored
        static::restored(function ($contract) {
            if ($contract->property_id && $contract->status !== 'cancelled') {
                Property::where('id', $contract->property_id)->update(['property_status_id' => 2]); // Rented
            }
        });
    }
}
