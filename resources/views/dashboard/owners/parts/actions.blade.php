<div class="d-flex justify-content-center align-items-center mb-0">
    <div class="btn-group" role="group">
        @can('owners_update')
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-edit js-edit-btn"
                title="{!! __('general.edit') !!}" 
                data-url="{!! route('dashboard.owners.update', $owner->id) !!}"
                data-id="{!! $owner->id !!}" 
                data-name_ar="{!! $owner->getTranslation('name', 'ar') !!}"
                data-name_en="{!! $owner->getTranslation('name', 'en') !!}" 
                data-phone="{!! $owner->phone !!}"
                data-identification_number="{!! $owner->identification_number !!}"
                data-type="{!! $owner->type !!}"
                data-status="{!! $owner->status !!}"
                data-email="{!! $owner->email !!}"
                data-address="{!! $owner->address !!}" 
                data-notes="{!! $owner->notes !!}" 
                data-company_id="{!! $owner->company_id !!}" 
                data-company="{!! optional($owner->company)->name !!}"
                data-toggle="modal" data-target="#editModal">
                <i class="fas fa-edit"></i>
            </a>
        @endcan

        @can('owners_delete')
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-danger delete-confirm"
                data-id="{!! $owner->id !!}" data-route="{!! route('dashboard.owners.destroy') !!}"
                data-title="{!! __('general.ask_delete_record') !!}" data-text="{!! __('general.delete_warning_text') !!}"
                data-confirm-btn="{!! __('general.yes') !!}" data-cancel-btn="{!! __('general.no') !!}"
                data-success-title="{!! __('general.deleted') !!}"
                data-success-text="{!! __('general.delete_success_message') !!}" title="{!! __('general.delete') !!}">
                <i class="fas fa-trash-alt"></i>
            </a>
        @endcan
    </div>
</div>


