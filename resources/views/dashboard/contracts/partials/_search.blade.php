<div class="query-bar-container">
    <div class="query-bar js-query-bar">
        <span class="query-bar-label">
            <i class="fas fa-filter"></i> {!! __('general.filters') !!}:
        </span>

        <form class="js-filter-form d-flex align-items-center gap-2" data-container="#table_data" data-loader=".table-loader-overlay">
            <!-- Property Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="property_search_popover">
                    <i class="fas fa-building text-primary"></i>
                    <span class="chip-text">{!! __('contracts.property') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0 min-w-280" id="property_search_popover">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('contracts.property') !!}</label>
                        <div class="premium-input-wrapper">
                            <select name="property_id" id="filter_property" 
                                class="form-control premium-input shadow-none js-select2"
                                data-placeholder="{!! __('general.all') !!}"
                                data-parent="#property_search_popover">
                                <option value="">{!! __('general.all') !!}</option>
                                @foreach ($properties as $property)
                                    <option value="{{ $property->id }}">{{ $property->name }}</option>
                                @endforeach
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

            <!-- Customer Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="customer_search_popover">
                    <i class="fas fa-user text-primary"></i>
                    <span class="chip-text">{!! __('contracts.customer') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0 min-w-280" id="customer_search_popover">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('contracts.customer') !!}</label>
                        <div class="premium-input-wrapper">
                            <select name="customer_id" id="filter_customer" 
                                class="form-control premium-input shadow-none js-select2"
                                data-placeholder="{!! __('general.all') !!}"
                                data-parent="#customer_search_popover">
                                <option value="">{!! __('general.all') !!}</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
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

            <!-- Status Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="status_search_popover">
                    <i class="fas fa-check-circle text-primary"></i>
                    <span class="chip-text">{!! __('contracts.status') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0 min-w-200" id="status_search_popover">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('contracts.status') !!}</label>
                        <div class="premium-input-wrapper">
                            <select name="status" id="filter_status" class="form-control premium-input shadow-none js-select2" 
                                data-placeholder="{!! __('general.all') !!}"
                                data-parent="#status_search_popover">
                                <option value="">{!! __('general.select_from_list') !!}</option>
                                <option value="active">{!! __('contracts.status_active') !!}</option>
                                <option value="ended">{!! __('contracts.status_ended') !!}</option>
                                <option value="cancelled">{!! __('contracts.status_cancelled') !!}</option>
                            </select>
                            <i class="fas fa-check-circle text-primary"></i>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> {!! __('general.apply') !!}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Payment Cycle Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="cycle_search_popover">
                    <i class="fas fa-sync text-primary"></i>
                    <span class="chip-text">{!! __('contracts.payment_cycle') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0 min-w-200" id="cycle_search_popover">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('contracts.payment_cycle') !!}</label>
                        <div class="premium-input-wrapper">
                            <select name="payment_cycle" id="filter_cycle" class="form-control premium-input shadow-none js-select2" 
                                data-placeholder="{!! __('general.all') !!}"
                                data-parent="#cycle_search_popover">
                                <option value="">{!! __('general.select_from_list') !!}</option>
                                <option value="monthly">{!! __('contracts.payment_cycle_monthly') !!}</option>
                                <option value="yearly">{!! __('contracts.payment_cycle_yearly') !!}</option>
                            </select>
                            <i class="fas fa-sync text-primary"></i>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> {!! __('general.apply') !!}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Rent Range Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="rent_search_popover">
                    <i class="fas fa-money-bill-wave text-primary"></i>
                    <span class="chip-text">{!! __('contracts.rent_amount') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0 min-w-320" id="rent_search_popover">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <label class="premium-label mb-2">{!! __('general.min') !!}</label>
                            <div class="premium-input-wrapper">
                                <input type="number" class="form-control premium-input shadow-none" name="rent_min"
                                    placeholder="0" autocomplete="off">
                                <i class="fas fa-money-bill-wave text-primary"></i>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="premium-label mb-2">{!! __('general.max') !!}</label>
                            <div class="premium-input-wrapper">
                                <input type="number" class="form-control premium-input shadow-none" name="rent_max"
                                    placeholder="..." autocomplete="off">
                                <i class="fas fa-money-bill-wave text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> {!! __('general.apply') !!}
                        </button>
                    </div>
                </div>
            </div>

            @if(isset($companies))
            <!-- Company Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="company_search_popover">
                    <i class="fas fa-briefcase text-primary"></i>
                    <span class="chip-text">{!! __('companies.company') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0 min-w-280" id="company_search_popover">
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


