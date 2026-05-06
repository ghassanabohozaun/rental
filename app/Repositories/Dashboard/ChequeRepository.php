<?php

namespace App\Repositories\Dashboard;

use App\Models\Cheque;
use App\Traits\Dashboard\HandleAjaxPagination;

class ChequeRepository
{
    use HandleAjaxPagination;

    protected $model;

    public function __construct(Cheque $model)
    {
        $this->model = $model;
    }

    public function getAll($request)
    {
        $query = $this->model
            ->with(['company', 'contract', 'customer', 'creator'])
            ->filter($request->only(['keyword', 'company_id', 'status', 'contract_id', 'is_deposit', 'customer_id', 'due_date', 'property_id', 'bank_name']), ['cheque_number', 'bank_name', 'cheque_owner_name'], ['company_id', 'status', 'contract_id', 'is_deposit', 'customer_id', 'due_date'])
            ->when($request->property_id, function ($q) use ($request) {
                $q->whereHas('contract', function ($cq) use ($request) {
                    $cq->where('property_id', $request->property_id);
                });
            })
            ->when($request->bank_name, function ($q) use ($request) {
                $q->where('bank_name->' . app()->getLocale(), 'like', '%' . $request->bank_name . '%');
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
        $cheque = $this->find($id);
        if ($cheque) {
            $cheque->update($data);
        }
        return $cheque;
    }

    public function delete($id)
    {
        $cheque = $this->find($id);
        if ($cheque) {
            return $cheque->delete();
        }
        return false;
    }

    public function autocomplete($searchValue)
    {
        $query = $this->model
            ->query()
            // Only non-deposits OR cleared deposits (cashed)
            ->where(function ($q) {
                $q->where('is_deposit', false)->orWhere(function ($sq) {
                    $sq->where('is_deposit', true)->where('status', 'cleared');
                });
            });

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('cheque_number', 'like', '%' . $searchValue . '%')
                    ->orWhere('bank_name->en', 'like', '%' . $searchValue . '%')
                    ->orWhere('bank_name->ar', 'like', '%' . $searchValue . '%')
                    ->orWhere('cheque_owner_name->en', 'like', '%' . $searchValue . '%')
                    ->orWhere('cheque_owner_name->ar', 'like', '%' . $searchValue . '%');
            });
        }

        // We fetch a bit more because we need to filter by remaining amount in PHP
        $cheques = $query->orderByDesc('id')->limit(50)->get();

        return $cheques
            ->filter(function ($cheque) {
                return $cheque->remaining_amount > 0;
            })
            ->take(10)
            ->map(function ($cheque) {
                return [
                    'id' => $cheque->id,
                    'text' => $cheque->cheque_number . ' - ' . $cheque->bank_name . ' (' . __('contracts.remaining_amount') . ': ' . number_format($cheque->remaining_amount, 2) . ')',
                ];
            })
            ->values();
    }
    public function getStats()
    {
        $baseQuery = $this->model->query();

        $total_amount = $baseQuery->sum('amount');
        $rent_total = $this->model->where('is_deposit', false)->sum('amount');
        $insurance_total = $this->model->where('is_deposit', true)->sum('amount');

        // Sum of all payments related to these cheques
        $cashed_total = \App\Models\Payment::whereIn('cheque_id', $this->model->pluck('id'))->sum('amount');

        return [
            'total_amount' => $total_amount,
            'rent_total' => $rent_total,
            'insurance_total' => $insurance_total,
            'cashed_total' => $cashed_total,
        ];
    }
}
