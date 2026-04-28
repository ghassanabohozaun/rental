<div class="badge badge-pill badge-glow premium-status-badge property_status_status_{!! $property_status->id !!} {!! $property_status->status == 1 ? 'badge-success' : 'badge-danger' !!}">
    {!! $property_status->status == 1 ? __('general.enable') : __('general.disabled') !!}
</div>
