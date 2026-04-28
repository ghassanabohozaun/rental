<div class="d-flex justify-content-center align-items-center mb-0">
    <div class="btn-group" role="group">

        <!-- Edit -->

        <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-edit mr-1 edit_property_status_button"
            property_status-id="{!! $property_status->id !!}" property_status-name-ar="{!! $property_status->getTranslation('name', 'ar') !!}"
            property_status-name-en="{!! $property_status->getTranslation('name', 'en') !!}" 
            property_status-color="{!! $property_status->color !!}"
            property_status-company-id="{!! $property_status->company_id !!}"
            property_status-company-name="{!! optional($property_status->company)->name !!}"
            title="{!! __('general.edit') !!}">
            <i class="la la-edit"></i>
        </a>


        <!-- Delete -->

        <a href="javascript:void(0)"
            class="btn-premium-action btn-premium-action-danger delete-confirm text-decoration-none"
            data-id="{!! $property_status->id !!}" data-route="{!! route('dashboard.property_statuses.destroy') !!}" data-title="{!! __('general.ask_delete_record') !!}"
            data-text="{!! __('general.delete_warning_text') !!}" data-confirm-btn="{!! __('general.yes') !!}"
            data-cancel-btn="{!! __('general.no') !!}" data-success-title="{!! __('general.deleted') !!}"
            data-success-text="{!! __('general.delete_success_message') !!}" title="{!! __('general.delete') !!}">
            <i class="la la-trash"></i>
        </a>

    </div>
</div>
