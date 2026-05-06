<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Contract;

class ContractRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'property_id' => 'required|exists:properties,id',
            'customer_id' => 'required|exists:customers,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'rent_amount' => 'required|numeric|min:0',
            'deposit_amount' => 'nullable|numeric|min:0',
            'deposit_type' => 'required|string|in:cash,cheque',
            'deposit_status' => 'required|string|in:held,returned,used',
            'payment_cycle' => 'required|string|in:monthly,yearly',
            'status' => 'required|string|in:active,ended,cancelled',
            'contract_text' => 'nullable|string',
            'notes' => 'nullable|string',
            'deposit_cheque_number' => 'required_if:deposit_type,cheque|nullable|string|max:255',
            'deposit_bank_name.ar' => 'required_if:deposit_type,cheque|nullable|string|max:255',
            'deposit_bank_name.en' => 'required_if:deposit_type,cheque|nullable|string|max:255',
            'deposit_cheque_owner_name.ar' => 'required_if:deposit_type,cheque|nullable|string|max:255',
            'deposit_cheque_owner_name.en' => 'required_if:deposit_type,cheque|nullable|string|max:255',
            'deposit_issue_date' => 'required_if:deposit_type,cheque|nullable|date',
        ];

        // If user is super admin, they must select a company
        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        return $rules;
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $propertyId = $this->input('property_id');
            $startDate = $this->input('start_date');
            $endDate = $this->input('end_date');

            // Robustly extract contract ID from route parameters
            $contractParam = $this->route('contract') ?? $this->route('id');
            $contractId = is_object($contractParam) ? $contractParam->id : $contractParam;

            // Only run the complex validation if the basic fields are present
            if ($propertyId && $startDate && $endDate) {
                // Use Model query to automatically handle SoftDeletes
                $overlappingContract = Contract::query()
                    ->where('property_id', $propertyId)
                    ->where('status', '!=', 'cancelled')
                    ->where(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '<=', $endDate)->where('end_date', '>=', $startDate);
                    })
                    ->when($contractId, function ($query) use ($contractId) {
                        return $query->where('id', '!=', $contractId);
                    })
                    ->exists();

                if ($overlappingContract) {
                    $validator->errors()->add('property_id', __('contracts.overlap_error'));
                }
            }
        });
    }
}
