<div class="card premium-card" style="margin-top: 10px;">
    <div class="premium-mandatory-header py-2">
        <div class="title-wrapper">
            <i class="fas fa-filter text-primary"></i>
            <span class="font-weight-bold">{!! __('reports.search_filters') !!}</span>
        </div>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="fas fa-minus"></i></a></li>
                <li><a data-action="expand"><i class="fas fa-expand"></i></a></li>
            </ul>
        </div>
    </div>

    <div class="card-content collapse show">
        <div class="card-body">
            <div class="row">

                <!-- Company Filter (Super Admin only) -->
                @if (isset($companies) && $companies->count() > 0)
                    <div class="col-md-12 mb-2">
                        <div class="form-group">
                            <label for="filter_company_id" class="premium-label mb-0">
                                {!! __('companies.company') !!}
                            </label>
                            <select class="form-control js-select2" id="filter_company_id" name="company_id">
                                <option value="">{!! __('general.all_companies') !!}</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                <!-- Select Customers / Tenants (Multi Select) -->
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-end mb-1">
                            <label for="customer_id" class="premium-label mb-0">
                                {!! __('reports.select_customer') !!}
                                <span
                                    class="badge badge-light-primary badge-pill ml-1 font-10 font-weight-500">{!! __('general.optional') !!}</span>
                            </label>
                            <div class="d-flex align-items-center gap-3">
                                <a href="javascript:void(0);"
                                    class="text-primary font-small-3 font-weight-bold text-nowrap"
                                    id="select_all_customers" style="white-space: nowrap;">
                                    <i class="fas fa-check-double"></i> {!! __('reports.select_all') !!}
                                </a>
                                <a href="javascript:void(0);"
                                    class="text-danger font-small-3 font-weight-bold text-nowrap ml-2"
                                    id="deselect_all_customers" style="white-space: nowrap;">
                                    <i class="fas fa-times"></i> {!! __('reports.deselect_all') !!}
                                </a>
                            </div>
                        </div>
                        <select class="form-control select2" id="customer_id" name="customer_id[]" multiple="multiple">
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Cheque Status (Multi Select) -->
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-end mb-1">
                            <label for="status" class="premium-label mb-0">
                                {!! __('reports.cheque_status') !!}
                            </label>
                            <div class="d-flex align-items-center gap-2">
                                <a href="javascript:void(0);"
                                    class="text-primary font-small-3 font-weight-bold text-nowrap"
                                    id="select_all_statuses" style="white-space: nowrap;">
                                    <i class="fas fa-check-double"></i> {!! __('reports.select_all') !!}
                                </a>
                                <a href="javascript:void(0);"
                                    class="text-danger font-small-3 font-weight-bold text-nowrap"
                                    id="deselect_all_statuses" style="white-space: nowrap;">
                                    <i class="fas fa-times"></i> {!! __('reports.deselect_all') !!}
                                </a>
                            </div>
                        </div>
                        <select class="form-control select2" id="status" name="status[]" multiple="multiple">
                            @foreach (__('cheques.statuses') as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Cheque Type -->
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-end mb-1">
                            <label for="cheque_type" class="premium-label mb-0">
                                {!! __('reports.cheque_type') !!}
                            </label>
                        </div>
                        <select class="form-control" id="cheque_type" name="cheque_type">
                            <option value="">{!! __('cheques.all_cheques') !!}</option>
                            <option value="rent">{!! __('reports.rent_cheque') !!}</option>
                            <option value="insurance">{!! __('reports.insurance_cheque') !!}</option>
                        </select>
                    </div>
                </div>

                <!-- Company Bank Account -->
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-end mb-1">
                            <label for="company_bank_account_id" class="premium-label mb-0">
                                {!! __('bank_accounts.bank_accounts') !!}
                            </label>
                        </div>
                        <select class="form-control select2" id="company_bank_account_id" name="company_bank_account_id">
                            <option value="">{!! __('general.all') !!}</option>
                            @if(isset($bankAccounts))
                                @foreach ($bankAccounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->bank_name }} - {{ $account->account_number }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <!-- Due Date Range -->
                <div class="col-md-3 mb-2">
                    <div class="form-group">
                        <label for="due_date_from" class="premium-label mb-0">
                            {!! __('reports.due_date_from') !!}
                        </label>
                        <div class="position-relative has-icon-left">
                            <input type="text" class="form-control custom-datepicker" id="due_date_from"
                                name="due_date_from" placeholder="YYYY-MM-DD" autocomplete="off">
                            <div class="form-control-position premium-icon-centered">
                                <i class="fas fa-calendar-alt text-primary fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="form-group">
                        <label for="due_date_to" class="premium-label mb-0">
                            {!! __('reports.due_date_to') !!}
                        </label>
                        <div class="position-relative has-icon-left">
                            <input type="text" class="form-control custom-datepicker" id="due_date_to"
                                name="due_date_to" placeholder="YYYY-MM-DD" autocomplete="off">
                            <div class="form-control-position premium-icon-centered">
                                <i class="fas fa-calendar-alt text-primary fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Amount Range -->
                <div class="col-md-3 mb-2">
                    <div class="form-group">
                        <label for="amount_from" class="premium-label mb-0">
                            {!! __('reports.amount_from') !!}
                        </label>
                        <input type="number" step="0.01" class="form-control" id="amount_from"
                            name="amount_from" placeholder="0.00">
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="form-group">
                        <label for="amount_to" class="premium-label mb-0">
                            {!! __('reports.amount_to') !!}
                        </label>
                        <input type="number" step="0.01" class="form-control" id="amount_to" name="amount_to"
                            placeholder="0.00">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
