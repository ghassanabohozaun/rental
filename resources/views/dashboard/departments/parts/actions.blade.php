<div class="d-flex justify-content-center align-items-center mb-0">
    <div class="btn-group" role="group">

        <!-- Edit -->

        <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-edit mr-1 edit_department_button"
            department-id="{!! $department->id !!}" department-name-ar="{!! $department->getTranslation('name', 'ar') !!}"
            department-name-en="{!! $department->getTranslation('name', 'en') !!}" 
            department-company-id="{!! $department->company_id !!}"
            department-company-name="{!! optional($department->company)->name !!}"
            title="{!! __('general.edit') !!}">
            <i class="la la-edit"></i>
        </a>


        <!-- Delete -->

        <a href="javascript:void(0)"
            class="btn-premium-action btn-premium-action-danger delete-confirm text-decoration-none"
            data-id="{!! $department->id !!}" data-route="{!! route('dashboard.departments.destroy') !!}" data-title="{!! __('general.ask_delete_record') !!}"
            data-text="{!! __('general.delete_warning_text') !!}" data-confirm-btn="{!! __('general.yes') !!}"
            data-cancel-btn="{!! __('general.no') !!}" data-success-title="{!! __('general.deleted') !!}"
            data-success-text="{!! __('general.delete_success_message') !!}" title="{!! __('general.delete') !!}">
            <i class="la la-trash"></i>
        </a>

    </div>
</div>
