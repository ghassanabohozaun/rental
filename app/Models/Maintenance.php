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

class Maintenance extends Model implements MustBelongToCompany
{
    use HasFactory, BelongsToCompany, Filterable, HasTranslations, SoftDeletes, HasCreatedBy, CanBeDeleted;

    protected $fillable = [
        'company_id',
        'property_id',
        'description',
        'date',
        'status',
        'cost',
        'created_by'
    ];

    public $translatable = ['description'];

    /**
     * Get the property associated with the maintenance.
     */
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
