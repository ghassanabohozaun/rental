<div class="d-flex justify-content-center align-items-center mb-0">
    <div class="btn-group" role="group">
        @can('maintenances_update')
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-edit js-edit-btn"
                title="{!! __('general.edit') !!}" 
                data-url="{!! route('dashboard.maintenances.update', $maintenance->id) !!}"
                data-id="{!! $maintenance->id !!}" 
                data-description_ar="{!! $maintenance->getTranslation('description', 'ar') !!}"
                data-description_en="{!! $maintenance->getTranslation('description', 'en') !!}" 
                data-property_id="{!! $maintenance->property_id !!}"
                data-property_name="{!! optional($maintenance->property)->name !!}"
                data-date="{!! $maintenance->date !!}" 
                data-cost="{!! $maintenance->cost !!}"
                data-status="{!! $maintenance->status !!}" 
                data-company_id="{!! $maintenance->company_id !!}" 
                data-company="{!! optional($maintenance->company)->name !!}"
                data-toggle="modal" data-target="#editModal">
                <i class="la la-edit"></i>
            </a>
        @endcan

        @can('maintenances_delete')
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-danger delete-confirm"
                data-id="{!! $maintenance->id !!}" data-route="{!! route('dashboard.maintenances.destroy') !!}"
                data-title="{!! __('general.ask_delete_record') !!}" data-text="{!! __('general.delete_warning_text') !!}"
                data-confirm-btn="{!! __('general.yes') !!}" data-cancel-btn="{!! __('general.no') !!}"
                data-success-title="{!! __('general.deleted') !!}"
                data-success-text="{!! __('general.delete_success_message') !!}" title="{!! __('general.delete') !!}">
                <i class="la la-trash"></i>
            </a>
        @endcan
    </div>
</div>
