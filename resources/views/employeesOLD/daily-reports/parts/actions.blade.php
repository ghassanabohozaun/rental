<div>

    {{-- edit --}}
    <a href="javascript:void(0)" class="btn btn-outline-secondary  btn-fw text-dark edit_employees_daily_report_btn"
        title="{!! __('general.edit') !!}" daily-report-id="{!! $dailyReport->id !!}"
        daily-report-date="{!! $dailyReport->date !!}" daily-report-time="{!! $dailyReport->time !!}"
        daily-report-details="{{ $dailyReport->details }}">
        <i class="fa fa-edit"></i>
    </a>




    {{-- delete --}}
    <a href="javascript:void(0)" class="btn btn-outline-danger btn-fw text-dark  delete-confirm  !!} "
        data-id="{!! $dailyReport->id !!}" data-route="{!! route('employees.daily.reports.destroy') !!}" data-title="{!! __('general.ask_delete_record') !!}"
        data-text="{!! __('general.delete_warning_text') !!}" data-confirm-btn="{!! __('general.yes') !!}"
        data-cancel-btn="{!! __('general.no') !!}" data-success-title="{!! __('general.deleted') !!}"
        data-success-text="{!! __('general.delete_success_message') !!}">
        <i class="fa fa-trash"></i>
    </a>
</div>
