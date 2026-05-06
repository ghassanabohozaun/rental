<?php

namespace App\Traits\Dashboard;

/**
 * @property float $rent_amount
 * @property float $deposit_amount
 * @property-read float $total_amount
 * @property-read float $paid_amount
 * @method \Illuminate\Database\Eloquent\Relations\HasMany payments()
 */
trait HasFinancials
{
    /**
     * Get the total amount of the contract (Rent only).
     * The deposit is a separate financial hold and shouldn't be added to the rent balance.
     *
     * @return float
     */
    public function getTotalAmountAttribute()
    {
        return round((float) $this->rent_amount, 0);
    }

    /**
     * Get the total paid amount.
     * We include both 'paid' and 'pending' statuses.
     * Pending payments are considered 'committed' to prevent overpaying the contract balance.
     *
     * @return float
     */
    public function getPaidAmountAttribute()
    {
        return round((float) $this->payments()
            ->whereIn('status', ['paid', 'pending'])
            ->sum('amount'), 0);
    }

    /**
     * Get the remaining balance of the contract.
     *
     * @return float
     */
    public function getRemainingAmountAttribute()
    {
        return round((float) max(0, $this->total_amount - $this->paid_amount), 0);
    }
}
