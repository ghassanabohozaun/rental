<div class="badge badge-pill border-0 shadow-none px-2 py-1 font-weight-bold property_type_status_{!! $property_type->id !!} {!! $property_type->status == 1 ? 'badge-light-success' : 'badge-light-danger' !!}">
    {!! $property_type->status == 1 ? __('general.enable') : __('general.disabled') !!}
</div>


