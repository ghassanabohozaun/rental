<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToCompany;
use App\Traits\Dashboard\Filterable;
use App\Contracts\MustBelongToCompany;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Dashboard\HasCreatedBy;
use App\Traits\Dashboard\CanBeDeleted;

class Property extends Model implements MustBelongToCompany
{
    use HasFactory, BelongsToCompany, Filterable, HasTranslations, SoftDeletes, HasCreatedBy, CanBeDeleted;

    protected $restrictiveRelations = [
        'maintenances' => 'properties.cannot_delete_has_maintenances',
        'contracts' => 'properties.cannot_delete_has_contracts',
    ];

    protected $fillable = ['company_id', 'parent_id', 'name', 'location',
     'property_type_id', 'property_status_id', 'area', 'description', 
     'created_by', 'file_number', 'floor', 'zone_number', 'street_number', 'building_number', 
     'rental_contract_original', 'building_completion_certificate', 'other_documents',
     'additional_numbers'];

    public $translatable = ['name'];

    protected $casts = [
        'additional_numbers' => 'array',
    ];

    /**
     * Get the parent property (e.g., Building).
     */
    public function parent()
    {
        return $this->belongsTo(Property::class, 'parent_id');
    }

    /**
     * Get the child units (e.g., Apartments).
     */
    public function units()
    {
        return $this->hasMany(Property::class, 'parent_id');
    }

    /**
     * Get the type of the property.
     */
    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    /**
     * Get the status of the property.
     */
    public function propertyStatus()
    {
        return $this->belongsTo(PropertyStatus::class, 'property_status_id');
    }

    /**
     * Get the owners of the property.
     */
    public function owners()
    {
        return $this->belongsToMany(Owner::class, 'owner_property')
                    ->withPivot('ownership_percentage', 'is_primary')
                    ->withTimestamps();
    }

    /**
     * Get the maintenances for the property.
     */
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'property_id');
    }

    /**
     * Get the contracts for the property.
     */
    public function contracts()
    {
        return $this->hasMany(Contract::class, 'property_id');
    }

    /**
     * Get the attachments for the property.
     */
    public function attachments()
    {
        return $this->hasMany(PropertyAttachment::class, 'property_id');
    }

    /**
     * Accessor for electricity account number(s) from additional_numbers JSON.
     */
    public function getElectricityAccountNumberAttribute()
    {
        if (!empty($this->additional_numbers) && is_array($this->additional_numbers)) {
            $items = collect($this->additional_numbers)
                ->where('type', 'electricity_account')
                ->pluck('value')
                ->filter()
                ->values();
            return $items->isNotEmpty() ? $items->implode(' - ') : null;
        }
        return null;
    }

    /**
     * Accessor for water account number(s) from additional_numbers JSON.
     */
    public function getWaterAccountNumberAttribute()
    {
        if (!empty($this->additional_numbers) && is_array($this->additional_numbers)) {
            $items = collect($this->additional_numbers)
                ->where('type', 'water_account')
                ->pluck('value')
                ->filter()
                ->values();
            return $items->isNotEmpty() ? $items->implode(' - ') : null;
        }
        return null;
    }

    /**
     * Accessor for title deed number(s) from additional_numbers JSON.
     */
    public function getTitleDeedNumberAttribute()
    {
        if (!empty($this->additional_numbers) && is_array($this->additional_numbers)) {
            $items = collect($this->additional_numbers)
                ->where('type', 'title_deed')
                ->pluck('value')
                ->filter()
                ->values();
            return $items->isNotEmpty() ? $items->implode(' - ') : null;
        }
        return null;
    }

    /**
     * Accessor for cadastral/property number(s) from additional_numbers JSON.
     */
    public function getPropertyNumberAttribute()
    {
        if (!empty($this->additional_numbers) && is_array($this->additional_numbers)) {
            $items = collect($this->additional_numbers)
                ->where('type', 'cadastral_number')
                ->pluck('value')
                ->filter()
                ->values();
            return $items->isNotEmpty() ? $items->implode(' - ') : null;
        }
        return null;
    }

    /**
     * Scope a query to search inside additional_numbers JSON field.
     */
    public function scopeWhereAdditionalNumber($query, string $type, string $value)
    {
        $value = trim($value);
        if ($value === '') {
            return $query;
        }

        return $query->where(function ($q) use ($type, $value) {
            $q->where(function ($sub) use ($type, $value) {
                $sub->whereNotNull('properties.additional_numbers')
                    ->whereRaw("JSON_VALID(properties.additional_numbers) AND EXISTS (
                        SELECT 1 FROM JSON_TABLE(
                            properties.additional_numbers,
                            '$[*]' COLUMNS (
                                type VARCHAR(50) PATH '$.type',
                                val VARCHAR(100) PATH '$.value'
                            )
                        ) AS jt
                        WHERE jt.type = ? AND jt.val LIKE ?
                    )", [$type, "%{$value}%"]);
            })->orWhereHas('units', function ($unitQ) use ($type, $value) {
                $unitQ->whereNotNull('additional_numbers')
                    ->whereRaw("JSON_VALID(additional_numbers) AND EXISTS (
                        SELECT 1 FROM JSON_TABLE(
                            additional_numbers,
                            '$[*]' COLUMNS (
                                type VARCHAR(50) PATH '$.type',
                                val VARCHAR(100) PATH '$.value'
                            )
                        ) AS jt
                        WHERE jt.type = ? AND jt.val LIKE ?
                    )", [$type, "%{$value}%"]);
            });
        });
    }
}
