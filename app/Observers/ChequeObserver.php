<?php

namespace App\Observers;

use App\Models\Cheque;
use App\Models\Contract;

class ChequeObserver
{
    /**
     * Handle the Cheque "deleting" event.
     * We use "deleting" (before delete) to ensure we have full access to the model's data
     * and to ensure symmetry even if the actual delete is blocked by a restriction later
     * (though ideally they should stay in sync).
     */
    public function deleting(Cheque $cheque): void
    {
        // Debug: Ensure we are catching the event
        // \Illuminate\Support\Facades\Log::info('ChequeObserver: deleting cheque ID ' . $cheque->id);

        if ($cheque->is_deposit && $cheque->contract_id) {
            $contract = Contract::find($cheque->contract_id);
            
            if ($contract) {
                // Symmetrically reset the contract deposit info
                $contract->update([
                    'deposit_type' => 'cash',
                    'deposit_amount' => 0,
                    'deposit_status' => 'held',
                ]);
            }
        }
    }

    /**
     * Handle the Cheque "updated" event.
     * When a rent cheque status changes, we update the status of the related payments automatically.
     */
    public function updated(Cheque $cheque): void
    {
        if ($cheque->wasChanged('status')) {
            $newStatus = strtolower($cheque->status);
            
            // Sync contract deposit_status if it is an insurance cheque
            if ($cheque->is_deposit && $cheque->contract_id) {
                if ($newStatus === 'cleared') {
                    Contract::where('id', $cheque->contract_id)->update(['deposit_status' => 'used']);
                } elseif ($newStatus === 'returned') {
                    Contract::where('id', $cheque->contract_id)->update(['deposit_status' => 'returned']);
                }
            }

            if ($newStatus === 'cleared') {
                $cheque->payments()->update(['status' => 'paid']);
                
                notifyAdmins(
                    'notifications.cheque_cleared_title', 
                    'notifications.cheque_cleared_msg', 
                    ['cheque_no' => $cheque->cheque_number, 'amount' => $cheque->amount], 
                    'financial', 
                    route('dashboard.cheques.index'), 
                    'success', 
                    'fas fa-check-circle'
                );
            } elseif ($newStatus === 'bounced' || $newStatus === 'returned') {
                $cheque->payments()->update(['status' => 'bounced']);
                
                notifyAdmins(
                    'notifications.cheque_bounced_title', 
                    'notifications.cheque_bounced_msg', 
                    ['cheque_no' => $cheque->cheque_number, 'amount' => $cheque->amount], 
                    'financial', 
                    route('dashboard.cheques.index'), 
                    'danger', 
                    'fas fa-times-circle'
                );
            } else {
                $cheque->payments()->update(['status' => 'pending']);
                
                notifyAdmins(
                    'notifications.cheque_reset_title', 
                    'notifications.cheque_reset_msg', 
                    ['cheque_no' => $cheque->cheque_number, 'amount' => $cheque->amount], 
                    'financial', 
                    route('dashboard.cheques.index'), 
                    'warning', 
                    'fas fa-undo'
                );
            }
        }
    }
}
