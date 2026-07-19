<div class="badge badge-pill border-0 shadow-none px-2 py-1 font-weight-bold property_status_status_{!! $property_status->id !!} {!! $property_status->status == 1 ? 'badge-light-success' : 'badge-light-danger' !!}">
    {!! $property_status->status == 1 ? __('general.enable') : __('general.disabled') !!}
</div>


