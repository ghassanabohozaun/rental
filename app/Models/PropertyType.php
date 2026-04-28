<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Traits\Dashboard\Filterable;
use App\Contracts\MustBelongToCompany;
use App\Traits\BelongsToCompany;
use App\Traits\Dashboard\HasCreatedBy;

class PropertyType extends Model implements MustBelongToCompany
{
    use SoftDeletes, HasTranslations, Filterable, BelongsToCompany, HasCreatedBy;

    protected $table = 'property_types';
    protected $fillable = ['company_id', 'name', 'status', 'created_by'];

    public $timestamps = true;

    public array $translatable = ['name'];

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
