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

class Property extends Model implements MustBelongToCompany
{
    use HasFactory, BelongsToCompany, Filterable, HasTranslations, SoftDeletes, HasCreatedBy;

    protected $fillable = ['company_id', 'owner_id', 'name', 'location',
     'property_type_id', 'property_status_id', 'area', 'price', 'description', 'property_number', 'title_deed_number', 'electricity_account_number', 'water_account_number', 'created_by'];

    public $translatable = ['name'];

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
     * Get the owner of the property.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
