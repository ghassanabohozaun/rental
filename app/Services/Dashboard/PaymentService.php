<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\PaymentRepository;

class PaymentService
{
    protected $repository;

    public function __construct(PaymentRepository $repository)
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

    public function getTotalAmount()
    {
        return $this->repository->getTotalAmount();
    }

    public function getThisMonthAmount()
    {
        return $this->repository->getThisMonthAmount();
    }

    public function getAmountByMethod($method)
    {
        return $this->repository->getAmountByMethod($method);
    }
}
