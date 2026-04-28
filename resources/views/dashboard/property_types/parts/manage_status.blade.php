@can('property_types_update')
<div class="premium-switch-centered-wrapper">
    <div class="custom-control custom-switch custom-control-primary premium-switch-centered">
        <input type="checkbox" class="custom-control-input change_status" id="status_{!! $property_type->id !!}" data-id="{!! $property_type->id !!}"
            {!! $property_type->status == 1 ? 'checked' : '' !!}>
        <label class="custom-control-label" for="status_{!! $property_type->id !!}"></label>
    </div>
</div>
@endcan
