<?php

namespace App\Models;

use App\Contracts\MustBelongToCompany;
use App\Models\Payment;
use App\Traits\BelongsToCompany;
use App\Traits\Dashboard\CanBeDeleted;
use App\Traits\Dashboard\Filterable;
use App\Traits\Dashboard\HasCreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\Lang;

class Cheque extends Model implements MustBelongToCompany
{
    use HasFactory, SoftDeletes, BelongsToCompany, Filterable, HasCreatedBy, HasTranslations, CanBeDeleted;

    protected $fillable = [
        'company_id',
        'contract_id',
        'customer_id',
        'amount',
        'cheque_number',
        'bank_name',
        'cheque_owner_name',
        'issue_date',
        'due_date',
        'status',
        'is_deposit',
        'notes',
        'created_by'
    ];

    public array $translatable = ['bank_name', 'cheque_owner_name', 'notes'];

    protected $casts = [
        'amount' => 'float',
        'issue_date' => 'date',
        'due_date' => 'date',
        'is_deposit' => 'boolean',
    ];

    protected $appends = [
        'used_amount',
        'remaining_amount',
    ];

    protected $restrictiveRelations = [
        'payments' => 'cheques.cannot_delete_has_payments',
    ];

    /**
     * Get the company that owns the cheque.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the contract associated with the cheque.
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class)->withTrashed();
    }

    /**
     * Get the customer associated with the cheque.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the payments associated with the cheque.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the total amount used from this cheque by related payments.
     * Only considers payments that are paid or pending (committed).
     */
    public function getUsedAmountAttribute()
    {
        return round((float) $this->payments()
            ->whereIn('status', ['paid', 'pending'])
            ->sum('amount'), 0);
    }

    /**
     * Get the remaining balance of this cheque.
     */
    public function getRemainingAmountAttribute()
    {
        return round((float) max(0, $this->amount - $this->used_amount), 0);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getStatusLabelAttribute()
    {
        $status = strtolower($this->status ?? '');
        return Lang::has('cheques.statuses.' . $status)
            ? __('cheques.statuses.' . $status)
            : ($this->status ?: '---');
    }

    public function getStatusColorAttribute()
    {
        $status = strtolower($this->status ?? '');
        if($status == 'pending') return 'warning';
        if($status == 'cleared') return 'success';
        if($status == 'returned' || $status == 'bounced') return 'danger';
        return 'info';
    }
}
