<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\ChequeRepository;
use App\Models\Cheque;
use App\Models\Contract;
use App\Models\Payment;
use App\Services\Dashboard\PaymentService;

class ChequeService
{
    protected $repository;

    public function __construct(ChequeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll($request)
    {
        return $this->repository->getAll($request);
    }

    public function getOne($id)
    {
        return $this->repository->find($id);
    }

    public function store(array $data)
    {
        if (!isset($data['created_by'])) {
            $data['created_by'] = auth()->id();
        }
        
        if (!isset($data['company_id']) && user()->company_id != 1) {
            $data['company_id'] = user()->company_id;
        }

        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        if (isset($data['company_id']) && $data['company_id'] === '') {
            $data['company_id'] = null;
        }

        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function autocomplete($searchValue)
    {
        return $this->repository->autocomplete($searchValue);
    }

    public function returnCheque($id)
    {
        $cheque = $this->repository->find($id);
        if ($cheque->is_deposit && $cheque->status === 'held') {
            $updatedCheque = $this->repository->update($id, ['status' => 'returned']);
            
            // Update contract deposit_status if exists
            if ($cheque->contract_id) {
                Contract::where('id', $cheque->contract_id)->update(['deposit_status' => 'returned']);
            }
            
            return $updatedCheque;
        }
        throw new \Exception('Invalid operation or cheque is not a held deposit.');
    }

    public function cashCheque($id)
    {
        $cheque = $this->repository->find($id);
        if ($cheque->is_deposit && $cheque->status === 'held') {
            // Update cheque status to cleared
            $cheque = $this->repository->update($id, ['status' => 'cleared']);
            
            // Update contract deposit_status if exists
            if ($cheque->contract_id) {
                Contract::where('id', $cheque->contract_id)->update(['deposit_status' => 'used']);
            }
            
            // Create a payment record as it is now cashed (revenue)
            $paymentService = app(PaymentService::class);
            $paymentService->store([
                'company_id' => $cheque->company_id,
                'contract_id' => $cheque->contract_id,
                'customer_id' => $cheque->customer_id,
                'amount' => $cheque->amount,
                'payment_date' => now()->format('Y-m-d'),
                'payment_method' => 'cheque',
                'cheque_id' => $cheque->id,
                'status' => 'paid',
                'notes' => [
                    'ar' => __('cheques.cashed_deposit_notes', [], 'ar'),
                    'en' => __('cheques.cashed_deposit_notes', [], 'en'),
                ],
                'created_by' => auth()->id(),
            ]);

            return $cheque;
        }
        throw new \Exception('Invalid operation or cheque is not a held deposit.');
    }
    public function getStats()
    {
        return $this->repository->getStats();
    }
}
