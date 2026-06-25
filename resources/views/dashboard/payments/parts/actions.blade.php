<div class="d-flex align-items-center justify-content-center">
    @can('payments_update')
        {{-- Edit --}}
        @if(!$payment->cheque_id || ($payment->cheque && $payment->cheque->status !== 'cleared'))
            <a href="{!! route('dashboard.payments.edit', $payment->id) !!}" class="btn-premium-action btn-premium-action-edit mr-1"
                title="{!! __('general.edit') !!}">
                <i class="fas fa-edit"></i>
            </a>
        @endif

        {{-- Cash Pending Payment --}}
        @if($payment->status === 'pending' && !$payment->cheque_id)
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-success cash-confirm mr-1"
                data-id="{!! $payment->id !!}" data-route="{!! route('dashboard.payments.cash', $payment->id) !!}" data-title="{!! __('general.ask_cash_record') ?? 'هل أنت متأكد من تسييل هذه الدفعة؟' !!}"
                data-text="{!! __('general.cash_warning_text') ?? 'سيتم تغيير حالة الدفعة إلى مقبوضة' !!}" data-confirm-btn="{!! __('general.yes') !!}"
                data-cancel-btn="{!! __('general.no') !!}" data-success-title="{!! __('general.success') !!}"
                data-success-text="{!! __('payments.cash_success_message') ?? __('general.update_success_message') !!}" title="{!! __('cheques.cash_cheque') ?? 'تسييل الدفعة' !!}">
                <i class="fas fa-money-bill-wave"></i>
            </a>
        @endif
    @endcan

    @can('payments_delete')
        {{-- Delete --}}
        @if(!$payment->cheque_id || ($payment->cheque && $payment->cheque->status !== 'cleared'))
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-danger delete-confirm"
                data-id="{!! $payment->id !!}" data-route="{!! route('dashboard.payments.destroy') !!}" data-title="{!! __('general.ask_delete_record') !!}"
                data-text="{!! __('general.delete_warning_text') !!}" data-confirm-btn="{!! __('general.yes') !!}"
                data-cancel-btn="{!! __('general.no') !!}" data-success-title="{!! __('general.deleted') !!}"
                data-success-text="{!! __('general.delete_success_message') !!}" title="{!! __('general.delete') !!}">
                <i class="fas fa-trash-alt"></i>
            </a>
        @endif
    @endcan
</div>


