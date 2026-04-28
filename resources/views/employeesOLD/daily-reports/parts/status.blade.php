<div class="badge badge-sm {!! $dailyReport->status == 'on' ? 'badge-opacity-success' : 'badge-opacity-danger' !!} dailyReport_status_{!! $dailyReport->id !!}">
    {!! $dailyReport->status == 'on' ? __('general.enable') : __('general.disabled') !!}
</div>
