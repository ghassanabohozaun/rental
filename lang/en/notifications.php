<?php

return [
    // General / System
    'system_alert' => 'System Alert',
    'test_title' => 'Test Notification',
    'test_message' => 'This is a test notification generated from the terminal.',
    'digest_title' => 'Daily Digest',
    'digest_msg' => 'Good morning! You have :contracts contracts expiring soon, and :cheques due cheques.',

    // Contracts
    'contract_expiring_title' => 'Contract Expiring Soon',
    'contract_expiring_msg' => 'Contract #:contract_no for property ":property" is expiring in :days days.',
    'contract_expired_title' => 'Contract Expired',
    'contract_expired_msg' => 'Contract #:contract_no for property ":property" has expired today.',
    'new_contract_title' => 'New Contract Signed',
    'new_contract_msg' => 'A new contract #:contract_no was created for ":property".',

    // Financial / Cheques
    'cheque_due_title' => 'Cheque Due Soon',
    'cheque_due_msg' => 'Cheque #:cheque_no for amount :amount is due in :days days.',
    'cheque_overdue_title' => 'Cheque Overdue',
    'cheque_overdue_msg' => 'Cheque #:cheque_no for amount :amount is overdue!',

    // Properties
    'property_vacant_title' => 'Property Vacant',
    'property_vacant_msg' => 'Property ":property" is now vacant and available for rent.',

    // UI Elements
    'notifications' => 'Notifications',
    'mark_all_read' => 'Mark All as Read',
    'no_new_notifications' => 'No new notifications right now',
    'view_all' => 'View All Notifications',
    'new' => 'New',
    'just_now' => 'Just now',
    'tab_all' => 'All',
    'tab_financial' => 'Financial',
    'tab_contracts' => 'Contracts',
    'tab_system' => 'System',
    'collect_now' => 'Collect Now',

    // Actions & Confirmations
    'delete_selected' => 'Delete Selected',
    'delete_all' => 'Delete All',
    'view_details' => 'View Details',
    'mark_as_read' => 'Mark as Read',
    'confirm_delete_title' => 'Confirm Deletion',
    'confirm_delete_selected_text' => 'Are you sure you want to delete the selected notifications? This action cannot be undone.',
    'confirm_delete_all_text' => 'Are you sure you want to delete all notifications? This action cannot be undone.',
    'confirm_delete_single_text' => 'Are you sure you want to delete this notification? This action cannot be undone.',
];
