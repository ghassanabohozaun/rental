<div class="d-flex align-items-center justify-content-center">
    @can('payments_update')
        {{-- Edit --}}
        <a href="{!! route('dashboard.payments.edit', $payment->id) !!}" class="btn-premium-action btn-premium-action-edit mr-1"
            title="{!! __('general.edit') !!}">
            <i class="fas fa-edit"></i>
        </a>
    @endcan

    @can('payments_delete')
        {{-- Delete --}}
        <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-danger delete-confirm"
            data-id="{!! $payment->id !!}" data-route="{!! route('dashboard.payments.destroy') !!}" data-title="{!! __('general.ask_delete_record') !!}"
            data-text="{!! __('general.delete_warning_text') !!}" data-confirm-btn="{!! __('general.yes') !!}"
            data-cancel-btn="{!! __('general.no') !!}" data-success-title="{!! __('general.deleted') !!}"
            data-success-text="{!! __('general.delete_success_message') !!}" title="{!! __('general.delete') !!}">
            <i class="fas fa-trash-alt"></i>
        </a>
    @endcan
</div>
