<div class="query-bar-container">
    <div class="query-bar js-query-bar">
        <span class="query-bar-label">
            <i class="fas fa-filter"></i> {!! __('general.filters') !!}:
        </span>

        <form class="js-filter-form d-flex align-items-center gap-2" data-container="#table_data"
            data-loader=".table-loader-overlay">

            <!-- Customer Search -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="customer_search_popover">
                    <i class="fas fa-users text-primary"></i>
                    <span class="chip-text">{!! __('customers.customers') !!}</span>
                </div>

                <!-- Customer Search Popover -->
                <div class="ptc-query-panel shadow-lg border-0 radius-16" id="customer_search_popover">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('customers.customers') !!}</label>
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
            <!-- Company Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="company_search_popover">
                    <i class="fas fa-briefcase text-primary"></i>
                    <span class="chip-text">{!! __('companies.company') !!}</span>
                </div>

                <!-- Company Filter Popover -->
                <div class="ptc-query-panel shadow-lg border-0 radius-16" id="company_search_popover" style="min-width: 280px;">
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

            <!-- Nationality Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="nationality_search_popover">
                    <i class="fas fa-flag text-primary"></i>
                    <span class="chip-text">{!! __('customers.nationality') !!}</span>
                </div>

                <!-- Nationality Filter Popover -->
                <div class="ptc-query-panel shadow-lg border-0 radius-16" id="nationality_search_popover" style="min-width: 280px;">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('customers.nationality') !!}</label>
                        <div class="premium-input-wrapper">
                            <select name="nationality_id" id="filter_nationality_id"
                                class="form-control premium-input shadow-none js-select2"
                                data-placeholder="{!! __('general.select_from_list') !!}"
                                data-parent="#nationality_search_popover">
                                <option value="">{!! __('general.select_from_list') !!}</option>
                                @foreach ($nationalities as $nationality)
                                    <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                                @endforeach
                            </select>
                            <i class="fas fa-flag text-primary"></i>
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
