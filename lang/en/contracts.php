<?php

return [
    'contracts' => 'Contracts',
    'contract' => 'Contract',
    'create_new_contract' => 'Create New Contract',
    'update_contract' => 'Update Contract',
    'show_all_contracts' => 'Show All Contracts',
    
    // Fields
    'property' => 'Property',
    'available_properties_hint' => 'Available properties for rent',
    'customer' => 'Customer',
    'available_customers_hint' => 'Available Customers',
    'start_date' => 'Start Date',
    'end_date' => 'End Date',
    'rent_amount' => 'Rent Amount',
    'total_amount' => 'Total Contract Amount',
    'deposit_amount' => 'Deposit Amount',
    'deposit_type' => 'Deposit Type',
    'deposit_status' => 'Deposit Status',
    'payment_cycle' => 'Payment Cycle',
    'status' => 'Status',
    'contract_text' => 'Contract Text',
    'notes' => 'Additional Notes',
    
    // Enums - Deposit Type
    'deposit_type_cash' => 'Cash',
    'deposit_type_cheque' => 'Cheque',
    
    // Enums - Deposit Status
    'deposit_status_held' => 'Held',
    'deposit_status_returned' => 'Returned',
    'deposit_status_used' => 'Used',
    
    // Enums - Payment Cycle
    'payment_cycle_monthly' => 'Monthly',
    'payment_cycle_yearly' => 'Yearly',
    
    // Enums - Contract Status
    'status_active' => 'Active',
    'status_ended' => 'Ended',
    'status_cancelled' => 'Cancelled',
    
    // UI Elements
    'financial_details_title' => 'Financial Details & Dates',
    'deposit_details_title' => 'Deposit Details (Amount & Status)',
    'no_deposit' => 'No Deposit',
    'no_contracts_found' => 'No contracts found!',
    
    // Placeholders
    'select_property' => 'Select Property...',
    'select_customer' => 'Select Customer...',
    'enter_rent_amount' => 'Enter rent amount...',
    'enter_deposit_amount' => 'Enter deposit amount...',
    'enter_contract_text' => 'Enter contract text here...',
    'enter_notes' => 'Enter any additional notes...',
    
    // Errors
    'cannot_delete_has_payments' => 'Cannot delete contract because it has associated payments.',
    'cannot_delete_has_cheques' => 'Cannot delete contract because it has associated cheques.',
    'contract_details' => 'Contract Details',
    'basic_details_tab' => 'Basic & Financial Details',
    'contract_terms_tab' => 'Contract Terms & Notes',
    'contract_terms' => 'Contract Terms',
    'select_contract' => 'Select from contracts...',
    'overlap_error' => 'This property is already booked under another active contract during the specified time period.',
    'remaining_amount' => 'Remaining Amount',
    'paid_amount' => 'Paid Amount',
    
    // Insurance Cheque
    'insurance_cheque_for_contract' => 'Insurance cheque auto-generated for contract #:id',
    'cheque_edit_info' => 'Note: Filling these fields will create a NEW insurance cheque. If the contract already has an insurance cheque, please manage it from the Cheques section.',
    'amount_exceeds_deposit' => 'The amount exceeds the deposit amount specified in the contract',
    'active_contracts' => 'Active Contracts',
    'total_rent_value' => 'Total Rent Value',
    'expiring_soon' => 'Expiring Soon',
    'total_revenue' => 'Total Revenue',
];
