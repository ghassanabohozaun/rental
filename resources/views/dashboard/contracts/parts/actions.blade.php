<div class="d-flex align-items-center justify-content-center">
    {{-- Show (Full Page for Desktop, Modal for Mobile) --}}
    <a href="{!! route('dashboard.contracts.show', $contract->id) !!}"
        class="btn-premium-action btn-premium-action-info mr-1 d-none d-lg-inline-flex align-items-center justify-content-center"
        title="{!! __('general.show') !!}">
        <i class="fas fa-eye"></i>
    </a>

    {{-- Edit --}}
    <a href="{!! route('dashboard.contracts.edit', $contract->id) !!}" class="btn-premium-action btn-premium-action-edit mr-1"
        title="{!! __('general.edit') !!}">
        <i class="fas fa-edit"></i>
    </a>

    {{-- Add Cheque --}}
    @can('cheques_create')
        <a href="{!! route('dashboard.cheques.create') !!}?contract_id={!! $contract->id !!}&company_id={!! $contract->company_id !!}&is_deposit=0"
            class="btn-premium-action btn-premium-action-warning mr-1" title="{!! __('cheques.add_cheque') !!}">
            <i class="fas fa-money-check"></i>
        </a>
    @endcan

    {{-- Delete --}}
    <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-danger delete-confirm"
        data-id="{!! $contract->id !!}" data-route="{!! route('dashboard.contracts.destroy') !!}" data-title="{!! __('general.ask_delete_record') !!}"
        data-text="{!! __('general.delete_warning_text') !!}" data-confirm-btn="{!! __('general.yes') !!}"
        data-cancel-btn="{!! __('general.no') !!}" data-success-title="{!! __('general.deleted') !!}"
        data-success-text="{!! __('general.delete_success_message') !!}" title="{!! __('general.delete') !!}">
        <i class="fas fa-trash-alt"></i>
    </a>
</div>


