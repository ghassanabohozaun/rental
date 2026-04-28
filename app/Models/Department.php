<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Traits\Dashboard\Filterable;
use App\Contracts\MustBelongToCompany;
use App\Traits\BelongsToCompany;
use App\Traits\Dashboard\HasCreatedBy;

class Department extends Model implements MustBelongToCompany
{
    use SoftDeletes, HasTranslations, Filterable, BelongsToCompany, HasCreatedBy;
    protected $table = 'departments';
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

    // relation
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
