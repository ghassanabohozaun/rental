<div class="card card-rounded">
    <div class="card-body">
        <div>
            <h4 class="card-title card-title-dash">{!! __('monthlyReports.show_all_monthly_reports') !!}</h4>
        </div>

        <div class="table-responsive mt-4">
            <table class="table table-hover" id="myTable">
                <thead class="bg-light">
                    <tr>
                        <!-- Mobile # with Plus Icon -->
                        <th class="text-center d-lg-none" style="width:5%"> # </th>
                        <!-- Desktop # with Number -->
                        <th class="text-center d-none d-lg-table-cell" style="width:5%"> # </th>

                        <th style="width:25%"> {!! __('monthlyReports.month') !!} </th>
                        <th class="text-center d-none d-lg-table-cell" style="width:15%"> {!! __('monthlyReports.file') !!} </th>
                        <th class="text-center d-none d-lg-table-cell" style="width:15%">{!! __('monthlyReports.status') !!}</th>
                        <th class="text-center d-none d-lg-table-cell" style="width:15%"> {!! __('general.details') !!} </th>
                        <th class="text-center" style="width:15%">{!! __('general.actions') !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($monthlyReports as $monthlyReport)
                        @php
                            $statusHtml = view('employees.monthly-reports.parts.status', [
                                'monthlyReport' => $monthlyReport,
                            ])->render();
                        @endphp
                        <tr id="row-{!! $monthlyReport->id !!}" class="align-middle">
                            <!-- Mobile Plus Trigger -->
                            <td class="text-center d-lg-none">

                                <span class="details-control pointer text-primary" style="cursor: pointer;"
                                    data-employee-name="{!! auth()->user()->EmployeeShortName() !!}"
                                    data-month-year="{!! $monthlyReport->month !!} / {!! $monthlyReport->year !!}"
                                    data-details="{!! $monthlyReport->details !!}" data-status-html='{!! $statusHtml !!}'
                                    data-file-url="{!! $monthlyReport->file ? asset('uploads/monthlyReports/' . $monthlyReport->file) : '' !!}" data-has-refuse="{!! $monthlyReport->status == 'initial_refuse' || $monthlyReport->status == 'final_refuse' ? '1' : '0' !!}"
                                    data-refuse-reason="{!! $monthlyReport->refuse_reason !!}">
                                    <i class="fa fa-plus-circle fa-lg"></i>
                                </span>
                            </td>

                            <!-- Desktop Iteration Number -->
                            <td class="text-center font-weight-bold d-none d-lg-table-cell">{!! $loop->iteration !!}
                            </td>

                            <td>
                                <div class="d-flex flex-column">
                                    <span class="badge badge-pill badge-opacity-info text-dark border-0 px-2 px-md-3">
                                        {!! $monthlyReport->month !!} / {!! $monthlyReport->year !!}
                                    </span>
                                </div>
                            </td>
                            <td class="text-center d-none d-lg-table-cell">@include('employees.monthly-reports.parts.file')</td>
                            <td class="text-center d-none d-lg-table-cell">@include('employees.monthly-reports.parts.status')</td>
                            <td class="text-center d-none d-lg-table-cell align-middle">
                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="button" class="btn btn-sm btn-icon btn-outline-info details-control"
                                        title="{!! __('general.details') !!}" data-employee-name="{!! auth()->user()->EmployeeShortName() !!}"
                                        data-month-year="{!! $monthlyReport->month !!} / {!! $monthlyReport->year !!}"
                                        data-details="{!! $monthlyReport->details !!}" data-status-html='{!! $statusHtml !!}'
                                        data-file-url="{!! $monthlyReport->file ? asset('uploads/monthlyReports/' . $monthlyReport->file) : '' !!}" data-has-refuse="{!! $monthlyReport->status == 'initial_refuse' || $monthlyReport->status == 'final_refuse' ? '1' : '0' !!}"
                                        data-refuse-reason="{!! $monthlyReport->refuse_reason !!}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center align-items-center" style="gap: 10px;">
                                    @include('employees.monthly-reports.parts.actions')
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fa fa-folder-open-o fa-3x text-silver mb-3"></i>
                                <p class="text-muted">{!! __('monthlyReports.no_monthly_reports_found') !!}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-container mt-3">
            {!! $monthlyReports->links() !!}
        </div>
    </div>
</div>
