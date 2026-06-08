<div class="d-flex align-items-center justify-content-center">
    {{-- Show --}}
    @can('properties_read')
    <a href="{!! route('dashboard.properties.show', $property->id) !!}" 
       class="btn-premium-action btn-premium-action-info mr-1" 
       title="{!! __('general.show') !!}">
        <i class="fas fa-eye"></i>
    </a>
    @endcan

    {{-- Edit --}}
    @can('properties_update')
    <a href="{!! route('dashboard.properties.edit', $property->id) !!}" 
       class="btn-premium-action btn-premium-action-edit mr-1" 
       title="{!! __('general.edit') !!}">
        <i class="fas fa-edit"></i>
    </a>
    @endcan

    {{-- Delete --}}
    @can('properties_delete')
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
        <i class="fas fa-trash-alt"></i>
    </a>
    @endcan
</div>


