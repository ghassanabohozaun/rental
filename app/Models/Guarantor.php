<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToCompany;
use App\Traits\Dashboard\Filterable;
use App\Traits\Dashboard\HasCreatedBy;
use App\Contracts\MustBelongToCompany;
use Spatie\Translatable\HasTranslations;

class Guarantor extends Model implements MustBelongToCompany
{
    use HasFactory, SoftDeletes, BelongsToCompany, Filterable, HasCreatedBy, HasTranslations;

    protected $fillable = ['company_id', 'name', 'phone', 'id_number', 'address', 'relationship',
    'notes', 'status', 'created_by'];

    public array $translatable = ['name'];

    /**
     * Scope a query to only include active guarantors.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Get the company that owns the guarantor.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
