@if ($monthlyReport->file)
    <a class="btn btn-link btn-fw" href="{!! asset('uploads/monthlyReports/' . $monthlyReport->file) !!}" target="_blank">{!! __('general.download') !!}</a>
@else
    <div class="badge badge-sm badge-opacity-danger">{!! __('general.no_file_found') !!}</div>
@endif
