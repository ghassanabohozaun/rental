<div class="d-flex justify-content-center align-items-center mb-0">
    <div class="btn-group" role="group">
        @can('customers_update')
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-edit js-edit-btn"
                title="{!! __('general.edit') !!}" 
                data-url="{!! route('dashboard.customers.update', $customer->id) !!}"
                data-id="{!! $customer->id !!}" 
                data-name_ar="{!! $customer->getTranslation('name', 'ar') !!}"
                data-name_en="{!! $customer->getTranslation('name', 'en') !!}" 
                data-phone="{!! $customer->phone !!}"
                data-email="{!! $customer->email !!}"
                data-id_number="{!! $customer->id_number !!}"
                data-address="{!! $customer->address !!}"
                data-nationality="{!! $customer->nationality !!}"
                data-tenant_type="{!! $customer->tenant_type !!}"
                data-guarantor_id="{!! $customer->guarantor_id !!}"
                data-guarantor="{!! optional($customer->guarantor)->name !!}"
                data-notes="{!! $customer->notes !!}" 
                data-company_id="{!! $customer->company_id !!}" 
                data-company="{!! optional($customer->company)->name !!}"
                data-toggle="modal" data-target="#editModal">
                <i class="la la-edit"></i>
            </a>
        @endcan

        @can('customers_delete')
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-danger delete-confirm"
                data-id="{!! $customer->id !!}" data-route="{!! route('dashboard.customers.destroy') !!}"
                data-title="{!! __('general.ask_delete_record') !!}" data-text="{!! __('general.delete_warning_text') !!}"
                data-confirm-btn="{!! __('general.yes') !!}" data-cancel-btn="{!! __('general.no') !!}"
                data-success-title="{!! __('general.deleted') !!}"
                data-success-text="{!! __('general.delete_success_message') !!}" title="{!! __('general.delete') !!}">
                <i class="la la-trash"></i>
            </a>
        @endcan
    </div>
</div>
