<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToCompany;
use App\Traits\Dashboard\Filterable;
use App\Traits\Dashboard\HasCreatedBy;
use App\Traits\Dashboard\CanBeDeleted;
use App\Contracts\MustBelongToCompany;
use Spatie\Translatable\HasTranslations;

class Owner extends Model implements MustBelongToCompany
{
    use HasFactory, SoftDeletes, BelongsToCompany, Filterable, HasCreatedBy, HasTranslations, CanBeDeleted;

    protected $restrictiveRelations = [
        'properties' => 'owners.cannot_delete_has_properties',
    ];

    protected $fillable = [
        'company_id', 
        'type', 
        'identification_number', 
        'name', 
        'phone', 
        'email', 
        'address', 
        'notes', 
        'created_by'
    ];

    public array $translatable = ['name'];

    /**
     * Get the company that owns the owner record.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the properties associated with this owner.
     */
    public function properties()
    {
        return $this->belongsToMany(Property::class, 'owner_property');
    }

    /**
     * Scope a query to only include active owners.
     * Note: Status filtering removed per user request to simplify selection.
     */
    public function scopeActive($query)
    {
        return $query;
    }
}
