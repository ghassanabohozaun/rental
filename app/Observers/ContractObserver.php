<?php

namespace App\Observers;

use App\Models\Contract;
use App\Models\Property;

class ContractObserver
{
    /**
     * Helper method to update a property and all its child units.
     */
    protected function setPropertyStatus($propertyId, $statusId): void
    {
        if ($propertyId) {
            Property::where('id', $propertyId)
                ->orWhere('parent_id', $propertyId)
                ->update(['property_status_id' => $statusId]);
        }
    }
    /**
     * Handle the Contract "created" event.
     */
    public function created(Contract $contract): void
    {
        if ($contract->property_id && $contract->status !== 'cancelled') {
            $this->setPropertyStatus($contract->property_id, 2); // Rented
        }

        // Notify Admins about new contract
        notifyAdmins(
            'notifications.new_contract_title', 
            'notifications.new_contract_msg', 
            ['contract' => '#' . $contract->id], 
            'contracts', 
            route('dashboard.contracts.show', $contract->id), 
            'success', 
            'fas fa-file-signature'
        );
    }

    /**
     * Handle the Contract "updated" event.
     */
    public function updated(Contract $contract): void
    {
        // 1. Check if the property itself was changed
        if ($contract->wasChanged('property_id')) {
            $oldPropertyId = $contract->getOriginal('property_id');
            $newPropertyId = $contract->property_id;

            if ($oldPropertyId) {
                $this->setPropertyStatus($oldPropertyId, 1); // Available
            }

            if ($newPropertyId && $contract->status !== 'cancelled') {
                $this->setPropertyStatus($newPropertyId, 2); // Rented
            }
        }

        // 2. Check if the contract status changed (e.g., active -> ended or cancelled)
        if ($contract->wasChanged('status')) {
            if (in_array($contract->status, ['ended', 'cancelled']) && $contract->property_id) {
                $this->setPropertyStatus($contract->property_id, 1); // Available
                
                // Notify admins about cancellation
                if ($contract->status === 'cancelled') {
                    notifyAdmins(
                        'notifications.contract_cancelled_title', 
                        'notifications.contract_cancelled_msg', 
                        ['contract' => '#' . $contract->id], 
                        'contracts', 
                        route('dashboard.contracts.show', $contract->id), 
                        'danger', 
                        'fas fa-ban'
                    );
                }
            } elseif ($contract->status === 'active' && $contract->property_id) {
                $this->setPropertyStatus($contract->property_id, 2); // Rented
                
                // Notify admins about reactivation
                notifyAdmins(
                    'notifications.contract_reactivated_title', 
                    'notifications.contract_reactivated_msg', 
                    ['contract' => '#' . $contract->id], 
                    'contracts', 
                    route('dashboard.contracts.show', $contract->id), 
                    'info', 
                    'fas fa-sync'
                );
            }
        }
    }

    /**
     * Handle the Contract "deleting" event.
     */
    public function deleting(Contract $contract): void
    {
        // Delete related insurance cheque
        if ($contract->insuranceCheque) {
            $contract->insuranceCheque->delete();
        }

        // Reset property status to Available
        if ($contract->property_id) {
            $this->setPropertyStatus($contract->property_id, 1); // Available
        }
    }

    /**
     * Handle the Contract "restored" event.
     */
    public function restored(Contract $contract): void
    {
        if ($contract->property_id && $contract->status !== 'cancelled') {
            $this->setPropertyStatus($contract->property_id, 2); // Rented
        }
    }
}
