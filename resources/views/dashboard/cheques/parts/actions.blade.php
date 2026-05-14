<div class="d-flex align-items-center justify-content-center">

    @can('cheques_update')
        {{-- Edit --}}
        @if (!in_array($cheque->status, ['cleared', 'returned']))
            <a href="{!! route('dashboard.cheques.edit', $cheque->id) !!}" class="btn-premium-action btn-premium-action-edit mr-1"
                title="{!! __('general.edit') !!}">
                <i class="fas fa-edit"></i>
            </a>
        @endif

        @if ($cheque->is_deposit && $cheque->status === 'held')
            {{-- Return Insurance Cheque --}}
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-warning mr-1 btn-return-cheque"
                data-id="{!! $cheque->id !!}" title="{!! __('cheques.return_cheque') !!}">
                <i class="fas fa-undo"></i>
            </a>

            {{-- Cash Insurance Cheque --}}
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-success mr-1 btn-cash-cheque"
                data-id="{!! $cheque->id !!}" title="{!! __('cheques.cash_cheque') !!}">
                <i class="fas fa-money-bill-wave"></i>
            </a>
        @endif
    @endcan

    @can('cheques_delete')
        {{-- Delete --}}
        @if (!in_array($cheque->status, ['cleared', 'returned']))
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-danger delete-confirm"
                data-id="{!! $cheque->id !!}" data-route="{!! route('dashboard.cheques.destroy') !!}" data-title="{!! __('general.ask_delete_record') !!}"
                data-text="{!! __('general.delete_warning_text') !!}" data-confirm-btn="{!! __('general.yes') !!}"
                data-cancel-btn="{!! __('general.no') !!}" data-success-title="{!! __('general.deleted') !!}"
                data-success-text="{!! __('general.delete_success_message') !!}" title="{!! __('general.delete') !!}">
                <i class="fas fa-trash-alt"></i>
            </a>
        @endif
    @endcan
</div>
