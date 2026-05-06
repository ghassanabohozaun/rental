<?php

return [
    'contracts' => 'العقود',
    'contract' => 'عقد',
    'create_new_contract' => 'إضافة عقد جديد',
    'update_contract' => 'تعديل بيانات العقد',
    'show_all_contracts' => 'عرض جميع العقود',
    
    // Fields
    'property' => 'العقار',
    'available_properties_hint' => 'العقارات المتاحة للتأجير',
    'customer' => 'المستأجر',
    'available_customers_hint' => 'العملاء المتاحون',
    'start_date' => 'تاريخ البدء',
    'end_date' => 'تاريخ الانتهاء',
    'rent_amount' => 'قيمة الإيجار',
    'total_amount' => 'إجمالي العقد',
    'deposit_amount' => 'قيمة التأمين',
    'deposit_type' => 'نوع التأمين',
    'deposit_status' => 'حالة التأمين',
    'payment_cycle' => 'دورة الدفع',
    'status' => 'حالة العقد',
    'contract_text' => 'نص العقد',
    'notes' => 'ملاحظات إضافية',
    
    // Enums - Deposit Type
    'deposit_type_cash' => 'نقداً',
    'deposit_type_cheque' => 'شيك',
    
    // Enums - Deposit Status
    'deposit_status_held' => 'محفوظ',
    'deposit_status_received' => 'محجوز',
    'deposit_status_returned' => 'مسترجع',
    'deposit_status_used' => 'مستخدم',
    
    // Enums - Payment Cycle
    'payment_cycle_monthly' => 'شهرياً',
    'payment_cycle_yearly' => 'سنوياً',
    
    // Enums - Contract Status
    'status_active' => 'ساري',
    'status_ended' => 'منتهي',
    'status_cancelled' => 'ملغي',
    
    // UI Elements
    'financial_details_title' => 'التفاصيل المالية والتواريخ',
    'deposit_details_title' => 'تفاصيل التأمين (المبلغ والحالة)',
    'no_deposit' => 'لا يوجد تأمين',
    'no_contracts_found' => 'لا يوجد عقود حالياً!',
    
    // Placeholders
    'select_property' => 'اختر العقار...',
    'select_customer' => 'اختر المستأجر...',
    'enter_rent_amount' => 'أدخل قيمة الإيجار...',
    'enter_deposit_amount' => 'أدخل قيمة التأمين...',
    'enter_contract_text' => 'اكتب نص العقد هنا...',
    'enter_notes' => 'أدخل أي ملاحظات إضافية...',
    
    // Errors
    'cannot_delete_has_payments' => 'لا يمكن حذف العقد لوجود دفعات مالية مرتبطة به.',
    'cannot_delete_has_cheques' => 'لا يمكن حذف العقد لوجود شيكات مرتبطة به.',
    'contract_details' => 'تفاصيل العقد',
    'basic_details_tab' => 'البيانات الأساسية والمالية',
    'contract_terms_tab' => 'شروط العقد والملاحظات',
    'contract_terms' => 'بنود العقد',
    'select_contract' => 'اختر من العقود...',
    'overlap_error' => 'هذا العقار محجوز ضمن عقد آخر فعال في نفس الفترة الزمنية المحددة.',
    'remaining_amount' => 'المبلغ المتبقي',
    'paid_amount' => 'المبلغ المدفوع',
    
    // Insurance Cheque
    'insurance_cheque_for_contract' => 'شيك تأمين تم إنشاؤه آلياً للعقد رقم #:id',
    'cheque_edit_info' => 'ملاحظة: تعبئة هذه الحقول سيقوم بإنشاء شيك تأمين جديد. إذا كان للعقد شيك تأمين مسبق، يرجى إدارته من قسم الشيكات.',
    'no_contract_text' => 'لا يوجد نص عقد مسجل لهذا العقد.',
    'amount_exceeds_deposit' => 'المبلغ المدخل يتجاوز قيمة التأمين المحددة في العقد',
    'active_contracts' => 'العقود السارية',
    'total_rent_value' => 'إجمالي قيم الإيجار',
    'expiring_soon' => 'عقود تنتهي قريباً',
    'total_revenue' => 'إجمالي الإيرادات',
    'select_contract_to_view_details' => 'اختر العقد لعرض التفاصيل المالية',
];
