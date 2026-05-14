@can('property_statuses_update')
<div class="premium-switch-centered-wrapper">
    <label class="modern-switch">
        <input type="checkbox" class="change_status" id="status_{!! $property_status->id !!}" data-id="{!! $property_status->id !!}"
            {!! $property_status->status == 1 ? 'checked' : '' !!}>
        <span class="modern-slider"></span>
    </label>
</div>
@endcan
