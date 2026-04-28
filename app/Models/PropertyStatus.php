<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Traits\Dashboard\Filterable;
use App\Contracts\MustBelongToCompany;
use App\Traits\BelongsToCompany;
use App\Traits\Dashboard\HasCreatedBy;

class PropertyStatus extends Model implements MustBelongToCompany
{
    use SoftDeletes, HasTranslations, Filterable, BelongsToCompany, HasCreatedBy;

    protected $table = 'property_statuses';
    protected $fillable = ['company_id', 'name', 'color', 'status', 'created_by'];

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
