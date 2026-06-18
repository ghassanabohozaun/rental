<?php

namespace App\Observers;

use App\Models\Payment;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     */
    public function created(Payment $payment): void
    {
        // Ignore cheque payments to avoid duplicate notifications
        if ($payment->method === 'cheque') {
            return;
        }

        if ($payment->status === 'paid') {
            notifyAdmins(
                'notifications.payment_collected_title', 
                'notifications.payment_collected_msg', 
                [
                    'amount' => $payment->amount, 
                    'contract' => '#' . $payment->contract_id
                ], 
                'financial', 
                route('dashboard.payments.index'), 
                'success', 
                'fas fa-hand-holding-usd'
            );
        }
    }

    /**
     * Handle the Payment "updated" event.
     */
    public function updated(Payment $payment): void
    {
        // Ignore cheque payments to avoid duplicate notifications
        if ($payment->method === 'cheque') {
            return;
        }

        if ($payment->wasChanged('status')) {
            if ($payment->status === 'paid') {
                notifyAdmins(
                    'notifications.payment_collected_title', 
                    'notifications.payment_collected_msg', 
                    [
                        'amount' => $payment->amount, 
                        'contract' => '#' . $payment->contract_id
                    ], 
                    'financial', 
                    route('dashboard.payments.index'), 
                    'success', 
                    'fas fa-hand-holding-usd'
                );
            } elseif (in_array($payment->status, ['pending', 'unpaid'])) {
                notifyAdmins(
                    'notifications.payment_reset_title', 
                    'notifications.payment_reset_msg', 
                    [
                        'amount' => $payment->amount, 
                        'contract' => '#' . $payment->contract_id
                    ], 
                    'financial', 
                    route('dashboard.payments.index'), 
                    'warning', 
                    'fas fa-undo'
                );
            }
        }
    }

    /**
     * Handle the Payment "deleted" event.
     */
    public function deleted(Payment $payment): void
    {
        // Ignore cheque payments
        if ($payment->method === 'cheque') {
            return;
        }

        notifyAdmins(
            'notifications.payment_deleted_title', 
            'notifications.payment_deleted_msg', 
            [
                'amount' => $payment->amount, 
                'contract' => '#' . $payment->contract_id
            ], 
            'financial', 
            route('dashboard.payments.index'), 
            'danger', 
            'fas fa-trash-alt'
        );
    }
}
