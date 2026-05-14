<div class="query-bar-container">
    <div class="query-bar js-query-bar">
        <span class="query-bar-label">
            <i class="fas fa-filter"></i> {!! __('general.filters') !!}:
        </span>

        <form class="js-filter-form d-flex align-items-center gap-2" data-container="#table_data"
            data-loader=".table-loader-overlay">

            <!-- Hidden Is Deposit Filter for Tab functionality -->
            <input type="hidden" name="is_deposit" id="filter_is_deposit" value="{{ request('is_deposit', 0) }}">

            <!-- 1. Cheque Search -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="cheque_search_popover">
                    <i class="fas fa-money-check text-primary"></i>
                    <span class="chip-text">{!! __('cheques.cheque') !!}</span>
                </div>

                <!-- Cheque Search Popover -->
                <div class="ptc-query-panel shadow-lg border-0 radius-16" id="cheque_search_popover">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('cheques.cheques') !!}</label>
                        <div class="premium-input-wrapper">
                            <input type="text" class="form-control premium-input shadow-none" name="keyword"
                                placeholder="{!! __('general.search') !!}..." autocomplete="off">
                            <i class="fas fa-search text-primary"></i>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> {!! __('general.apply') !!}
                        </button>
                    </div>
                </div>
            </div>

            @if(isset($companies) && $companies->count() > 0)
            <!-- 2. Company Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="company_search_popover">
                    <i class="fas fa-briefcase text-primary"></i>
                    <span class="chip-text">{!! __('companies.company') !!}</span>
                </div>

                <!-- Company Filter Popover -->
                <div class="ptc-query-panel shadow-lg border-0 radius-16 min-w-280" id="company_search_popover">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('companies.company') !!}</label>
                        <div class="premium-input-wrapper">
                            <select name="company_id" id="filter_company_id"
                                class="form-control premium-input shadow-none js-select2"
                                data-placeholder="{!! __('general.all_companies') !!}"
                                data-parent="#company_search_popover">
                                <option value="">{!! __('general.all_companies') !!}</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                            <i class="fas fa-briefcase text-primary"></i>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> {!! __('general.apply') !!}
                        </button>
                    </div>
                </div>
            </div>
            @endif

            <!-- 3. Customer Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="customer_search_popover">
                    <i class="fas fa-user text-primary"></i>
                    <span class="chip-text">{!! __('customers.customer') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0 radius-16 min-w-280" id="customer_search_popover">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('customers.customer') !!}</label>
                        <div class="premium-input-wrapper">
                            <select name="customer_id" id="filter_customer_id" class="form-control premium-input shadow-none js-select2" data-placeholder="{!! __('general.all') !!}" data-parent="#customer_search_popover">
                                <option value="">{!! __('general.all') !!}</option>
                                @if(isset($customers))
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <i class="fas fa-user text-primary"></i>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> {!! __('general.apply') !!}
                        </button>
                    </div>
                </div>
            </div>

            <!-- 4. Property Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="property_search_popover">
                    <i class="fas fa-building text-primary"></i>
                    <span class="chip-text">{!! __('properties.property') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0 radius-16 min-w-280" id="property_search_popover">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('properties.property') !!}</label>
                        <div class="premium-input-wrapper">
                            <select name="property_id" id="filter_property_id" class="form-control premium-input shadow-none js-select2" data-placeholder="{!! __('general.all') !!}" data-parent="#property_search_popover">
                                <option value="">{!! __('general.all') !!}</option>
                                @if(isset($properties))
                                    @foreach($properties as $property)
                                        <option value="{{ $property->id }}">{{ $property->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <i class="fas fa-building text-primary"></i>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> {!! __('general.apply') !!}
                        </button>
                    </div>
                </div>
            </div>

            <!-- 5. Bank Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="bank_search_popover">
                    <i class="fas fa-university text-primary"></i>
                    <span class="chip-text">{!! __('cheques.bank_name') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0 radius-16" id="bank_search_popover">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('cheques.bank_name') !!}</label>
                        <div class="premium-input-wrapper">
                            <input type="text" class="form-control premium-input shadow-none" name="bank_name"
                                placeholder="{!! __('general.search') !!}..." autocomplete="off">
                            <i class="fas fa-university text-primary"></i>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> {!! __('general.apply') !!}
                        </button>
                    </div>
                </div>
            </div>

            <!-- 6. Status Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="status_search_popover">
                    <i class="fas fa-info-circle text-primary"></i>
                    <span class="chip-text">{!! __('cheques.status') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0 radius-16 min-w-200" id="status_search_popover">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('cheques.status') !!}</label>
                        <div class="premium-input-wrapper">
                            <select name="status" id="filter_status" class="form-control premium-input shadow-none js-select2" data-placeholder="{!! __('general.all') !!}" data-parent="#status_search_popover">
                                <option value="">{!! __('general.all') !!}</option>
                                @foreach(__('cheques.statuses') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <i class="fas fa-info-circle text-primary"></i>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> {!! __('general.apply') !!}
                        </button>
                    </div>
                </div>
            </div>

            <!-- 7. Due Date Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="due_date_search_popover">
                    <i class="fas fa-calendar-alt text-primary"></i>
                    <span class="chip-text">{!! __('cheques.due_date') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0 radius-16 min-w-250" id="due_date_search_popover">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('cheques.due_date') !!}</label>
                        <div class="premium-input-wrapper">
                            <input type="text" class="form-control premium-input shadow-none ptc-datepicker" name="due_date" 
                                placeholder="YYYY-MM-DD" autocomplete="off">
                            <i class="fas fa-calendar-alt text-primary"></i>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> {!! __('general.apply') !!}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Reset Button -->
            <div class="filter-chip reset-chip js-reset-btn">
                <i class="fas fa-sync"></i>
                <span>{!! __('general.reset') !!}</span>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script src="{!! asset('assets/dashbaord/js/filter-system.js') !!}"></script>
@endpush


