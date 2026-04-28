<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Traits\Dashboard\Filterable;
use App\Contracts\MustBelongToCompany;
use App\Traits\BelongsToCompany;
use App\Traits\Dashboard\HasCreatedBy;
use App\Traits\Dashboard\CanBeDeleted;

class PropertyType extends Model implements MustBelongToCompany
{
    use SoftDeletes, HasTranslations, Filterable, BelongsToCompany, HasCreatedBy, CanBeDeleted;

    protected $table = 'property_types';
    protected $fillable = ['company_id', 'name', 'status', 'created_by'];

    public $timestamps = true;

    public array $translatable = ['name'];

    protected $restrictiveRelations = [
        'properties' => 'property_types.cannot_delete_property_type_linked_to_properties'
    ];

    // relations
    public function properties()
    {
        return $this->hasMany(Property::class, 'property_type_id');
    }

    // scopes
    public function scopeActive($query)
    {
        return $query->whereStatus(1);
    }

    public function scopeInactive($query)
    {
        return $query->whereStatus(0);
    }
}
