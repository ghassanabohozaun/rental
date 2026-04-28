<div class="d-flex align-items-center justify-content-center">
    {{-- Show --}}
    <a href="javascript:void(0)" 
       class="btn-premium-action btn-premium-action-info mr-1 details-control" 
       title="{!! __('general.show') !!}">
        <i class="la la-eye"></i>
    </a>

    {{-- Edit --}}
    <a href="{!! route('dashboard.properties.edit', $property->id) !!}" 
       class="btn-premium-action btn-premium-action-edit mr-1" 
       title="{!! __('general.edit') !!}">
        <i class="la la-edit"></i>
    </a>

    {{-- Delete --}}
    <a href="javascript:void(0)" 
       class="btn-premium-action btn-premium-action-danger delete-confirm" 
       data-id="{!! $property->id !!}" 
       data-route="{!! route('dashboard.properties.destroy') !!}"
       data-title="{!! __('general.ask_delete_record') !!}" 
       data-text="{!! __('general.delete_warning_text') !!}"
       data-confirm-btn="{!! __('general.yes') !!}" 
       data-cancel-btn="{!! __('general.no') !!}"
       data-success-title="{!! __('general.deleted') !!}" 
       data-success-text="{!! __('general.delete_success_message') !!}"
       title="{!! __('general.delete') !!}">
        <i class="la la-trash"></i>
    </a>
</div>
