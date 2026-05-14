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
     'property_type_id', 'property_status_id', 'area', 'price', 'description', 'property_number',
     'title_deed_number', 'electricity_account_number', 'water_account_number', 'created_by',
     'file_number', 'rental_contract_original', 'building_completion_certificate', 'other_documents'];

    public $translatable = ['name'];

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
}
