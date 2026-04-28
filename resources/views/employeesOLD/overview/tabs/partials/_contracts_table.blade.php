<div class="table-responsive">
    <table class="table table-hover mb-0">
        <thead class="bg-light">
            <tr>
                <!-- Mobile # with Plus Icon -->
                <th class="text-center d-lg-none" style="width:5%"> # </th>
                <!-- Desktop # with Number -->
                <th class="text-center d-none d-lg-table-cell" style="width:5%"> # </th>

                <th>{!! __('employees.contract_duration') !!}</th>
                <th class="d-none d-lg-table-cell">{!! __('employees.contract_start_date') !!}</th>
                <th class="d-none d-lg-table-cell">{!! __('employees.contract_expire_date') !!}</th>
                <th class="d-none d-lg-table-cell">{!! __('employees.monthly_salary') !!}</th>
                <th class="text-center">{!! __('employees.status') !!}</th>
                <th class="text-center d-none d-lg-table-cell">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contracts as $index => $contract)
            <tr>
                <!-- Mobile Plus Trigger -->
                <td class="text-center d-lg-none">
                    <span class="pointer text-primary view-contract-details-btn" style="cursor: pointer;"
                            data-duration="{!! $contract->contract_duration !!}"
                            data-salary="{!! $contract->monthly_salary !!} {!! employee()->user()->currency !!}"
                            data-start="{!! $contract->contract_start_date !!}"
                            data-expiry="{!! $contract->contract_expiry_date !!}"
                            data-status="{!! $index == 0 ? __('employees.active') : __('employees.expired') !!}"
                            data-status-color="{!! $index == 0 ? 'text-success' : 'text-secondary' !!}">
                        <i class="fa fa-plus-circle fa-lg"></i>
                    </span>
                </td>

                <!-- Desktop Iteration -->
                <td class="text-center d-none d-lg-table-cell font-weight-bold">{!! $loop->iteration !!}</td>

                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div class="btn-icon btn-sm bg-label-primary rounded-pill d-none d-md-flex">
                            <i class="mdi mdi-file-document-outline"></i>
                        </div>
                        <span class="fw-bold">{!! $contract->contract_duration ?? '---' !!}</span>
                    </div>
                </td>
                <td class="d-none d-lg-table-cell">{!! $contract->contract_start_date ?? '---' !!}</td>
                <td class="d-none d-lg-table-cell">{!! $contract->contract_expiry_date ?? '---' !!}</td>
                <td class="d-none d-lg-table-cell fw-bold text-primary">{!! $contract->monthly_salary ?? '0' !!} {!! employee()->user()->currency !!}</td>
                <td class="text-center">
                    @if($index == 0)
                        <span class="badge bg-label-success rounded-pill px-3">{!! __('employees.active') !!}</span>
                    @else
                        <span class="badge bg-label-secondary rounded-pill px-3">{!! __('employees.expired') !!}</span>
                    @endif
                </td>
                <td class="text-center d-none d-lg-table-cell">
                    <button class="btn btn-sm btn-icon btn-outline-primary rounded-circle view-contract-details-btn" 
                            data-duration="{!! $contract->contract_duration !!}"
                            data-salary="{!! $contract->monthly_salary !!} {!! employee()->user()->currency !!}"
                            data-start="{!! $contract->contract_start_date !!}"
                            data-expiry="{!! $contract->contract_expiry_date !!}"
                            data-status="{!! $index == 0 ? __('employees.active') : __('employees.expired') !!}"
                            data-status-color="{!! $index == 0 ? 'text-success' : 'text-secondary' !!}">
                        <i class="mdi mdi-eye"></i>
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-4 text-muted">
                    <i class="mdi mdi-information-outline me-1"></i>
                    {!! __('employees.no_contract_info_yet') !!}
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
