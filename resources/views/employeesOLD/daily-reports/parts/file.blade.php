@if ($dailyReport->file)
    <a class="btn btn-link btn-fw" href="{!! asset('uploads/dailyReports/' . $dailyReport->file) !!}" target="_blank">{!! __('general.download') !!}</a>
@else
    <div class="badge badge-sm badge-opacity-danger">{!! __('general.no_file_found') !!}</div>
@endif
