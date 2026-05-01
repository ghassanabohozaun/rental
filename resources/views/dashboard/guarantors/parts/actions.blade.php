<div class="d-flex justify-content-center align-items-center mb-0">
    <div class="btn-group" role="group">
        @can('guarantors_update')
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-edit js-edit-btn"
                title="{!! __('general.edit') !!}" 
                data-url="{!! route('dashboard.guarantors.update', $guarantor->id) !!}"
                data-id="{!! $guarantor->id !!}" 
                data-name_ar="{!! $guarantor->getTranslation('name', 'ar') !!}"
                data-name_en="{!! $guarantor->getTranslation('name', 'en') !!}" 
                data-phone="{!! $guarantor->phone !!}"
                data-id_number="{!! $guarantor->id_number !!}"
                data-address="{!! $guarantor->address !!}" 
                data-relationship="{!! $guarantor->relationship !!}"
                data-notes="{!! $guarantor->notes !!}" 
                data-company_id="{!! $guarantor->company_id !!}" 
                data-company="{!! optional($guarantor->company)->name !!}"
                data-toggle="modal" data-target="#editModal">
                <i class="la la-edit"></i>
            </a>
        @endcan

        @can('guarantors_delete')
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-danger delete-confirm"
                data-id="{!! $guarantor->id !!}" data-route="{!! route('dashboard.guarantors.destroy') !!}"
                data-title="{!! __('general.ask_delete_record') !!}" data-text="{!! __('general.delete_warning_text') !!}"
                data-confirm-btn="{!! __('general.yes') !!}" data-cancel-btn="{!! __('general.no') !!}"
                data-success-title="{!! __('general.deleted') !!}"
                data-success-text="{!! __('general.delete_success_message') !!}" title="{!! __('general.delete') !!}">
                <i class="la la-trash"></i>
            </a>
        @endcan
    </div>
</div>
