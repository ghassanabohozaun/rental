<div class="d-flex justify-content-center align-items-center mb-0">
    <div class="btn-group" role="group">
        @can('customers_read')
            <a href="{{ route('dashboard.customers.show', $customer->id) }}" class="btn-premium-action btn-premium-action-info"
                title="{{ __('general.show') }}">
                <i class="fas fa-eye"></i>
            </a>
        @endcan

        @can('customers_update')
            <a href="{{ route('dashboard.customers.edit', $customer->id) }}" class="btn-premium-action btn-premium-action-edit"
                title="{{ __('general.edit') }}">
                <i class="fas fa-edit"></i>
            </a>
        @endcan

        @can('customers_delete')
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-danger delete-confirm"
                data-id="{{ $customer->id }}" data-route="{{ route('dashboard.customers.destroy') }}"
                data-title="{{ __('general.ask_delete_record') }}" data-text="{{ __('general.delete_warning_text') }}"
                data-confirm-btn="{{ __('general.yes') }}" data-cancel-btn="{{ __('general.no') }}"
                data-success-title="{{ __('general.deleted') }}"
                data-success-text="{{ __('general.delete_success_message') }}" title="{{ __('general.delete') }}">
                <i class="fas fa-trash-alt"></i>
            </a>
        @endcan
    </div>
</div>


