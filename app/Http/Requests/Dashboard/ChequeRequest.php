<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Contract;
use App\Models\Cheque;

class ChequeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'contract_id' => 'required|exists:contracts,id',
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|gt:0',
            'cheque_number' => 'required|string|max:255',
            'bank_name.ar' => 'required|string|max:255',
            'bank_name.en' => 'required|string|max:255',
            'cheque_owner_name.ar' => 'required|string|max:255',
            'cheque_owner_name.en' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'due_date' => 'nullable|date|after_or_equal:issue_date',
            'status' => 'required|in:pending,cleared,bounced,held',
           // 'is_deposit' => 'required|in:0,1',
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

            // 1. Get the current contract remaining balance (Contract Total - All Payments [Cash/Cheques/Bank])
            // Note: contract->remaining_amount already subtracts all 'paid' and 'pending' payments.
            $contractRemaining = $contract->remaining_amount;

            // 2. Calculate the total remaining (unused) balance of OTHER RENT cheques for this contract.
            // We must exclude insurance/deposit cheques as they don't affect the rent balance.
            $otherChequesQuery = Cheque::where('contract_id', $this->contract_id)
                ->where('is_deposit', false);

            // If updating, exclude the current cheque being edited
            if ($this->route('cheque')) {
                $otherChequesQuery->where('id', '!=', $this->route('cheque'));
            }

            $otherCheques = $otherChequesQuery->get();
            $totalOtherUnusedCheques = $otherCheques->sum(function($c) {
                return $c->remaining_amount; // amount - sum(payments linked to this cheque)
            });

            // 3. Final Allowed Balance for this new/edited cheque
            // If it's an insurance cheque, we don't check against the rent balance.
            if ($this->is_deposit == 1) {
                if (round($amount, 2) > round($contract->deposit_amount, 2)) {
                    $validator->errors()->add('amount',
                        __('contracts.amount_exceeds_deposit') . ' (' . __('contracts.deposit_amount') . ': ' . number_format($contract->deposit_amount, 2) . ')'
                    );
                }
                return;
            }

            $finalAllowedBalance = max(0, $contractRemaining - $totalOtherUnusedCheques);

            // 4. Validate
            if (round($amount, 2) > round($finalAllowedBalance, 2)) {
                $validator->errors()->add('amount',
                    __('payments.amount_exceeds_remaining') . ' (' . __('contracts.remaining_amount') . ': ' . number_format($finalAllowedBalance, 2) . ')'
                );
            }
        });
    }
}
