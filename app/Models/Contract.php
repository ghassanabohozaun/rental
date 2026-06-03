<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToCompany;
use App\Traits\Dashboard\Filterable;
use App\Contracts\MustBelongToCompany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Dashboard\HasCreatedBy;
use App\Traits\Dashboard\CanBeDeleted;
use App\Traits\Dashboard\HasFinancials;
use App\Models\Property;

class Contract extends Model implements MustBelongToCompany
{
    use HasFactory, BelongsToCompany, Filterable, SoftDeletes, HasCreatedBy, CanBeDeleted, HasFinancials;
    protected $fillable = ['company_id', 'property_id', 'customer_id', 'conclusion_date', 'start_date', 'end_date', 'contract_duration_months', 'rent_amount', 'total_rent_amount', 'deposit_amount', 'deposit_type', 'deposit_status', 'payment_cycle', 'status', 'contract_text', 'notes', 'created_by'];

    protected $casts = [
        'conclusion_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'rent_amount' => 'float',
        'deposit_amount' => 'float',
    ];

    protected $appends = ['total_amount', 'paid_amount', 'remaining_amount'];

    public function insuranceCheque()
    {
        return $this->hasOne(Cheque::class)->where('is_deposit', true);
    }
    /**
     * Get human-readable duration (e.g., 1 Year, 6 Months)
     */
    public function getDurationLabelAttribute()
    {
        if (!$this->start_date || !$this->end_date) {
            return '---';
        }

        $months = (int) round($this->start_date->floatDiffInMonths($this->end_date->copy()->addDay()));

        if ($months === 0) {
            $days = $this->start_date->diffInDays($this->end_date->copy()->addDay());
            return $days . ' ' . __('general.days');
        }

        return $months . ' ' . ($months == 1 ? __('general.month') : __('general.months'));
    }

    /**
     * Relationships that prevent deletion if they have records.
     */
    protected $restrictiveRelations = [
        'payments' => 'contracts.cannot_delete_has_payments',
        'cheques' => 'contracts.cannot_delete_has_cheques',
    ];

    /**
     * Get the property associated with the contract.
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the customer associated with the contract.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the payments associated with the contract.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the cheques associated with the contract.
     */
    public function cheques()
    {
        return $this->hasMany(Cheque::class);
    }

    /**
     * Get the details/snapshot for printing.
     */
    public function contractDetail()
    {
        return $this->hasOne(ContractDetail::class);
    }

    /**
     * Get the live first party data based on property relationships.
     */
    public function getLiveFirstPartyDataAttribute()
    {
        $company = optional($this->property)->company;
        
        $primaryOwner = null;
        if ($this->property && $this->property->owners) {
            $primaryOwner = $this->property->owners->where('pivot.is_primary', 1)->first();
            if (!$primaryOwner) {
                $primaryOwner = $this->property->owners->first();
            }
        }
        
        return [
            'name_ar' => $company ? $company->getTranslation('name', 'ar') : '---',
            'owner_name' => $primaryOwner ? $primaryOwner->name : '---',
            'owner_qid' => $primaryOwner ? $primaryOwner->identification_number : '---',
            'owner_phone' => $primaryOwner ? $primaryOwner->phone : '---',
        ];
    }

    /**
     * Get the creator of the contract.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * The "booted" method of the model.
     * Automates Property Status updates based on Contract lifecycle.
     */
    protected static function booted()
    {
        // When a contract is successfully created
        static::created(function ($contract) {
            if ($contract->property_id && $contract->status !== 'cancelled') {
                Property::where('id', $contract->property_id)->update(['property_status_id' => 2]); // Rented
            }
        });

        // When a contract is successfully updated
        static::updated(function ($contract) {
            // 1. Check if the property itself was changed
            if ($contract->wasChanged('property_id')) {
                $oldPropertyId = $contract->getOriginal('property_id');
                $newPropertyId = $contract->property_id;

                if ($oldPropertyId) {
                    Property::where('id', $oldPropertyId)->update(['property_status_id' => 1]); // Available
                }

                if ($newPropertyId && $contract->status !== 'cancelled') {
                    Property::where('id', $newPropertyId)->update(['property_status_id' => 2]); // Rented
                }
            }

            // 2. Check if the contract status changed (e.g., active -> ended)
            if ($contract->wasChanged('status')) {
                if (in_array($contract->status, ['ended', 'cancelled']) && $contract->property_id) {
                    Property::where('id', $contract->property_id)->update(['property_status_id' => 1]); // Available
                } elseif ($contract->status === 'active' && $contract->property_id) {
                    Property::where('id', $contract->property_id)->update(['property_status_id' => 2]); // Rented
                }
            }
        });

        // When a contract is deleted
        static::deleting(function ($contract) {
            // Delete related insurance cheque
            if ($contract->insuranceCheque) {
                $contract->insuranceCheque->delete();
            }

            // Reset property status to Available
            if ($contract->property_id) {
                Property::where('id', $contract->property_id)->update(['property_status_id' => 1]); // Available
            }
        });

        // When a contract is restored
        static::restored(function ($contract) {
            if ($contract->property_id && $contract->status !== 'cancelled') {
                Property::where('id', $contract->property_id)->update(['property_status_id' => 2]); // Rented
            }
        });
    }
}
