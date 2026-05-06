<?php

namespace App\Repositories\Dashboard;

use App\Models\Payment;
use App\Traits\Dashboard\HandleAjaxPagination;

class PaymentRepository
{
    use HandleAjaxPagination;

    protected $model;

    public function __construct(Payment $model)
    {
        $this->model = $model;
    }

    public function getAll($request)
    {
        $query = $this->model
            ->with(['company', 'contract', 'cheque', 'creator'])
            ->filter($request->only(['company_id', 'method', 'status', 'contract_id']), 
                [], 
                ['company_id', 'method', 'status', 'contract_id'])
            ->when($request->customer_id, function($q) use ($request) {
                return $q->whereHas('contract', function($cq) use ($request) {
                    $cq->where('customer_id', $request->customer_id);
                });
            })
            ->when($request->property_id, function($q) use ($request) {
                return $q->whereHas('contract', function($cq) use ($request) {
                    $cq->where('property_id', $request->property_id);
                });
            })
            ->orderByDesc('id');

        return $this->applyAjaxPagination($request, $query);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $payment = $this->find($id);
        if ($payment) {
            $payment->update($data);
        }
        return $payment;
    }

    public function delete($id)
    {
        $payment = $this->find($id);
        if ($payment) {
            return $payment->delete();
        }
        return false;
    }

    public function getTotalAmount()
    {
        return $this->model->sum('amount');
    }

    public function getThisMonthAmount()
    {
        return $this->model->whereMonth('payment_date', now()->month)
            ->whereYear('payment_date', now()->year)
            ->sum('amount');
    }

    public function getAmountByMethod($method)
    {
        if (is_array($method)) {
            return $this->model->whereIn('method', $method)->sum('amount');
        }
        return $this->model->where('method', $method)->sum('amount');
    }
}
