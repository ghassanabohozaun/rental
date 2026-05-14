@can('property_types_update')
<div class="premium-switch-centered-wrapper">
    <label class="modern-switch">
        <input type="checkbox" class="change_status" id="status_{!! $property_type->id !!}" data-id="{!! $property_type->id !!}"
            {!! $property_type->status == 1 ? 'checked' : '' !!}>
        <span class="modern-slider"></span>
    </label>
</div>
@endcan
