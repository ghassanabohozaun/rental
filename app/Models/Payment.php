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
use Illuminate\Support\Facades\Lang;

class Payment extends Model implements MustBelongToCompany
{
    use HasFactory, SoftDeletes, BelongsToCompany, Filterable, HasCreatedBy, CanBeDeleted, HasTranslations;

    protected $fillable = [
        'company_id',
        'contract_id',
        'amount',
        'payment_date',
        'method',
        'status',
        'reference_number',
        'cheque_id',
        'notes',
        'created_by'
    ];

    public array $translatable = ['notes'];

    protected $casts = [
        'amount' => 'float',
        'payment_date' => 'date',
    ];

    protected $restrictiveRelations = [
        // Payments usually don't have child relations that restrict deletion,
        // but it's good to have the pattern ready.
    ];

    /**
     * Get the company that owns the payment.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the contract associated with the payment.
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class)->withTrashed();
    }

    /**
     * Get the cheque associated with the payment.
     */
    public function cheque()
    {
        return $this->belongsTo(Cheque::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getMethodLabelAttribute()
    {
        $method = strtolower($this->method ?? '');
        return Lang::has('payments.methods.' . $method)
            ? __('payments.methods.' . $method)
            : ($this->method ?: '---');
    }

    public function getMethodIconAttribute()
    {
        $method = strtolower($this->method ?? '');
        if($method == 'cash') return 'money-bill-wave';
        if($method == 'bank' || $method == 'online') return 'university';
        if($method == 'cheque') return 'money-check-alt';
        return 'wallet';
    }

    public function getMethodColorAttribute()
    {
        $method = strtolower($this->method ?? '');
        if($method == 'cash') return 'success';
        if($method == 'bank' || $method == 'online') return 'info';
        if($method == 'cheque') return 'warning';
        return 'primary';
    }

    public function getStatusLabelAttribute()
    {
        $status = strtolower($this->status ?? '');
        return Lang::has('payments.statuses.' . $status)
            ? __('payments.statuses.' . $status)
            : ($this->status ?: '---');
    }

    public function getStatusColorAttribute()
    {
        $status = strtolower($this->status ?? '');
        if($status == 'paid') return 'success';
        if($status == 'pending') return 'warning';
        if($status == 'failed') return 'danger';
        return 'secondary';
    }
}
