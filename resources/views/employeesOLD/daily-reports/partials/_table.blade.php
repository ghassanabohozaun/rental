<div class="card card-rounded">
    <div class="card-body">
        <div>
            <h4 class="card-title card-title-dash">{!! __('dailyReports.show_all_daily_reports') !!}</h4>
        </div>

        <div class="table-responsive mt-4">
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th style="width:15%"> {!! __('dailyReports.date') !!} </th>
                        <th style="width:20%"> {!! __('dailyReports.details') !!} </th>
                        <th style="width:20%"> {!! __('dailyReports.file') !!} </th>
                        <th style="width:10%">{!! __('dailyReports.status') !!}</th>
                        <th style="width:10%">{!! __('dailyReports.manage_status') !!}</th>
                        <th style="width:15%"> {!! __('dailyReports.created_at') !!} </th>

                        <th style="width:10%">{!! __('general.actions') !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dailyReports as $dailyReport)
                        <tr>
                            <td>{!! $dailyReport->date !!}</td>
                            <td>@include('employees.daily-reports.parts.details')</td>
                            <td>@include('employees.daily-reports.parts.file')</td>
                            <td>@include('employees.daily-reports.parts.status')</td>
                            <td class="text-center">
                                @include('employees.daily-reports.parts.manage_status')
                            </td>
                            <td>{!! $dailyReport->created_at !!}</td>
                            <td>@include('employees.daily-reports.parts.actions')</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                {!! __('dailyReports.no_daily_reports_found') !!}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        <div class="pagination-container mt-3">
            {!! $dailyReports->links() !!}
        </div>
    </div>
</div>
