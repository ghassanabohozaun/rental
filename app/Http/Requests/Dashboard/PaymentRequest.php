<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\Cheque;

class PaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'contract_id' => 'required|exists:contracts,id',
            'amount' => 'required|numeric|gt:0',
            'payment_date' => 'required|date',
            'method' => 'required|in:cash,bank,cheque,online',
            'status' => 'required|in:paid,pending,bounced',
            'reference_number' => 'nullable|string|max:255',
            'cheque_id' => 'nullable|required_if:method,cheque|exists:cheques,id',
            'notes' => 'nullable|string',
        ];

        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        return $rules;
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $contract = Contract::find($this->contract_id);
            if (!$contract) return;

            $amount = (float) $this->amount;
            
            // 1. Calculate the 'Committed' amount (All existing rent payments + Unused portions of other rent cheques)
            // Get all other rent payments except this one
            $otherPaymentsSum = $contract->payments()
                ->whereIn('status', ['paid', 'pending'])
                ->where(function($query) {
                    $query->whereNull('cheque_id')
                          ->orWhereHas('cheque', function($q) {
                              $q->where('is_deposit', false);
                          });
                })
                ->when($this->route('payment'), function ($query) {
                    $query->where('id', '!=', $this->route('payment'));
                })
                ->sum('amount');

            // Get all unused portions of rent cheques
            // We MUST exclude deposit/insurance cheques here as they don't affect the rent balance
            $unusedChequesSum = Cheque::where('contract_id', $this->contract_id)
                ->where('is_deposit', false)
                ->when($this->cheque_id, function ($query) {
                    $query->where('id', '!=', $this->cheque_id);
                })
                ->get()
                ->sum(function($c) {
                    return $c->remaining_amount;
                });

            $totalCommitted = $otherPaymentsSum + $unusedChequesSum;
            $availableBalance = max(0, $contract->total_amount - $totalCommitted);

            // Using round to avoid floating point precision issues
            if (round($amount, 2) > round($availableBalance, 2)) {
                $validator->errors()->add('amount', __('payments.amount_exceeds_remaining') . ' (' . __('contracts.remaining_amount') . ': ' . number_format($availableBalance, 2) . ')');
            }

            // 2. Cheque Validity Check (Tank Approach)
            if ($this->method === 'cheque' && $this->cheque_id) {
                $cheque = Cheque::find($this->cheque_id);
                if ($cheque) {
                    // Calculate remaining capacity of this specific cheque
                    $otherPaymentsOnThisCheque = $cheque->payments()
                        ->whereIn('status', ['paid', 'pending'])
                        ->when($this->route('payment'), function ($query) {
                            $query->where('payments.id', '!=', $this->route('payment'));
                        })
                        ->sum('amount');
                    
                    $chequeAvailable = (float) $cheque->amount - $otherPaymentsOnThisCheque;

                    if (round($amount, 2) > round($chequeAvailable, 2)) {
                        $validator->errors()->add('amount', __('payments.amount_exceeds_cheque') . ' (' . __('payments.cheque_remaining_amount') . ': ' . number_format($chequeAvailable, 2) . ')');
                    }
                }
            }
        });
    }
}
