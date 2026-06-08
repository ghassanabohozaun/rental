<div class="d-flex align-items-center justify-content-center">
    {{-- Edit --}}
    @can('contract_clauses_update')
    <a href="{!! route('dashboard.contract_clause_templates.edit', $template->id) !!}" class="btn-premium-action btn-premium-action-edit mr-1"
        title="{!! __('general.edit') !!}">
        <i class="fas fa-edit"></i>
    </a>
    @endcan

    {{-- Delete --}}
    @can('contract_clauses_delete')
    <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-danger delete-confirm"
        data-id="{!! $template->id !!}" data-route="{!! route('dashboard.contract_clause_templates.destroy', $template->id) !!}" data-title="{!! __('general.ask_delete_record') !!}"
        data-text="{!! __('general.delete_warning_text') !!}" data-confirm-btn="{!! __('general.yes') !!}"
        data-cancel-btn="{!! __('general.no') !!}" data-success-title="{!! __('general.deleted') !!}"
        data-success-text="{!! __('general.delete_success_message') !!}" title="{!! __('general.delete') !!}">
        <i class="fas fa-trash-alt"></i>
    </a>
    @endcan
</div>
