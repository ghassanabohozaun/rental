<div class="badge badge-pill badge-glow premium-status-badge property_type_status_{!! $property_type->id !!} {!! $property_type->status == 1 ? 'badge-success' : 'badge-danger' !!}">
    {!! $property_type->status == 1 ? __('general.enable') : __('general.disabled') !!}
</div>
