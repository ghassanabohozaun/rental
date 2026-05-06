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

class Customer extends Model implements MustBelongToCompany
{
    use HasFactory, SoftDeletes, BelongsToCompany, Filterable, HasCreatedBy, HasTranslations, CanBeDeleted, \App\Traits\Dashboard\HasAvatar;

    protected $restrictiveRelations = [
        'contracts' => 'customers.cannot_delete_has_contracts',
    ];

    protected $fillable = [
        'company_id', 'name', 'phone', 'email', 'id_number', 
        'address', 'nationality_id', 'tenant_type', 'guarantor_id', 
        'notes', 'status', 'created_by'
    ];

    public array $translatable = ['name'];

    /**
     * Scope a query to only include active customers.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Get the company that owns the customer.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the guarantor associated with the customer.
     */
    public function guarantor()
    {
        return $this->belongsTo(Guarantor::class);
    }

    /**
     * Get the contracts for the customer.
     */
    public function contracts()
    {
        return $this->hasMany(Contract::class, 'customer_id');
    }

    /**
     * Get the nationality of the customer.
     */
    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
}
