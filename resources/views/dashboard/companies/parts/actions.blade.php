<div class="d-flex justify-content-center align-items-center mb-0">
    <div class="btn-group" role="group">

        <!-- Edit -->
        @can('companies_update')
        <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-edit mr-1"
            onclick="openEditCompanyModal({
                id: '{!! $company->id !!}',
                name_ar: '{!! $company->getTranslation('name', 'ar') !!}',
                name_en: '{!! $company->getTranslation('name', 'en') !!}',
                email: '{!! $company->email !!}',
                phone: '{!! $company->phone !!}',
                address: '{!! $company->address !!}',
                subscription_plan: '{!! $company->subscription_plan !!}',
                status: '{!! $company->status !!}',
                logo_url: '{!! $company->logo_url !!}'
            })"
            title="{!! __('general.edit') !!}">
            <i class="la la-edit"></i>
        </a>
        @endcan

        <!-- Delete -->
        @can('companies_delete')
        <a href="javascript:void(0)"
            class="btn-premium-action btn-premium-action-danger delete-confirm text-decoration-none"
            data-id="{!! $company->id !!}" data-route="{!! route('dashboard.companies.destroy', $company->id) !!}" 
            data-title="{!! __('general.ask_delete_record') !!}"
            data-text="{!! __('general.delete_warning_text') !!}" data-confirm-btn="{!! __('general.yes') !!}"
            data-cancel-btn="{!! __('general.no') !!}" data-success-title="{!! __('general.deleted') !!}"
            data-success-text="{!! __('general.delete_success_message') !!}" title="{!! __('general.delete') !!}">
            <i class="la la-trash"></i>
        </a>
        @endcan

    </div>
</div>
