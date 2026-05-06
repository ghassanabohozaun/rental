<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\ContractRepository;
use App\Models\Cheque;
use App\Models\Contract;

class ContractService
{
    protected $repository;

    public function __construct(ContractRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll($request)
    {
        return $this->repository->getAll($request);
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function store(array $data)
    {
        if (!isset($data['company_id'])) {
            $data['company_id'] = user()->company_id;
        }

        // Logic: If deposit amount is 0, force deposit type to cash
        if (isset($data['deposit_amount']) && (float)$data['deposit_amount'] <= 0) {
            $data['deposit_type'] = 'cash';
        }

        $contract = $this->repository->create($data);

        // Automatically update property status to 'Rented'
        if ($contract && $contract->property_id) {
            $contract->property->update(['property_status_id' => 2]);
        }

        // Handle Insurance Cheque Creation
        if ($contract && isset($data['deposit_type']) && $data['deposit_type'] === 'cheque' && isset($data['deposit_amount']) && $data['deposit_amount'] > 0) {
            $this->syncInsuranceCheque($contract, $data);
        }

        return $contract;
    }

    public function update($id, array $data)
    {
        // Logic: If deposit amount is 0, force deposit type to cash
        if (isset($data['deposit_amount']) && (float)$data['deposit_amount'] <= 0) {
            $data['deposit_type'] = 'cash';
        }

        $contract = $this->repository->update($id, $data);
        
        // Synchronize Insurance Cheque
        if ($contract && $data['deposit_type'] === 'cheque' && (float)$data['deposit_amount'] > 0) {
            $this->syncInsuranceCheque($contract, $data);
        } elseif ($contract && $contract->insuranceCheque) {
            // If changed to cash or amount is 0, delete the linked insurance cheque
            $contract->insuranceCheque->delete();
        }

        return $contract;
    }

    protected function syncInsuranceCheque(Contract $contract, array $data)
    {
        // Find existing insurance cheque or create a new one
        $cheque = $contract->insuranceCheque;

        $chequeData = [
            'company_id' => $contract->company_id,
            'contract_id' => $contract->id,
            'customer_id' => $data['customer_id'] ?? $contract->customer_id,
            'amount' => $data['deposit_amount'],
            'cheque_number' => $data['deposit_cheque_number'],
            'bank_name' => $data['deposit_bank_name'],
            'cheque_owner_name' => $data['deposit_cheque_owner_name'],
            'issue_date' => $data['deposit_issue_date'],
            'status' => $data['deposit_status'] ?? 'held',
            'is_deposit' => true,
            'notes' => [
                'ar' => trans('contracts.insurance_cheque_for_contract', ['id' => $contract->id], 'ar'),
                'en' => trans('contracts.insurance_cheque_for_contract', ['id' => $contract->id], 'en'),
            ],
            'created_by' => auth()->id(),
        ];

        if ($cheque) {
            // Update existing but don't overwrite created_by if already set
            unset($chequeData['created_by']);
            $cheque->update($chequeData);
        } else {
            Cheque::create($chequeData);
        }
    }

    public function delete($id)
    {
        $contract = $this->repository->find($id);
        if (!$contract) {
            return false;
        }

        // Check for restrictive relations (e.g., payments)
        $contract->checkRestrictiveRelations();

        return $this->repository->delete($id);
    }

    public function autocomplete($searchValue)
    {
        return $this->repository->autocomplete($searchValue);
    }
    public function getStats()
    {
        return $this->repository->getStats();
    }
}
