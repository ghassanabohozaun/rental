@can('property_statuses_update')
<div class="premium-switch-centered-wrapper">
    <div class="custom-control custom-switch custom-control-primary premium-switch-centered">
        <input type="checkbox" class="custom-control-input change_status" id="status_{!! $property_status->id !!}" data-id="{!! $property_status->id !!}"
            {!! $property_status->status == 1 ? 'checked' : '' !!}>
        <label class="custom-control-label" for="status_{!! $property_status->id !!}"></label>
    </div>
</div>
@endcan
