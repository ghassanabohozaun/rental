<div class="query-bar-container">
    <div class="query-bar js-query-bar">
        <span class="query-bar-label">
            <i class="la la-filter"></i> {!! __('general.filters') !!}:
        </span>

        <form class="js-filter-form d-flex align-items-center gap-2" data-container="#table_data"
            data-loader=".table-loader-overlay">
            <!-- user Search -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="user_search_popover">
                    <i class="la la-user-tie text-primary"></i>
                    <span class="chip-text">{!! __('users.users') !!}</span>
                </div>

                <!-- user Search Popover -->
                <div class="ptc-query-panel shadow-lg border-0 radius-16" id="user_search_popover">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('users.users') !!}</label>
                        <div class="premium-input-wrapper">
                            <input type="text" class="form-control premium-input shadow-none" name="keyword"
                                placeholder="{!! __('general.search') !!}..." autocomplete="off">
                            <i class="la la-search text-primary"></i>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="la la-check-circle mr-1"></i> {!! __('general.apply') !!}
                        </button>
                    </div>
                </div>
            </div>

            @if(isset($companies))
            <!-- Company Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="company_search_popover">
                    <i class="la la-briefcase text-primary"></i>
                    <span class="chip-text">{!! __('companies.company') !!}</span>
                </div>

                <!-- Company Filter Popover -->
                <div class="ptc-query-panel shadow-lg border-0 radius-16" id="company_search_popover" style="min-width: 280px;">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('companies.company') !!}</label>
                        <div class="premium-input-wrapper">
                            <select name="company_id" id="filter_company_id"
                                class="form-control premium-input shadow-none js-select2 js-autocomplete"
                                data-url="{!! route('dashboard.companies.autocomplete') !!}"
                                data-placeholder="{!! __('general.all_companies') !!}"
                                data-parent="#company_search_popover">
                                <option></option>
                                <!-- Loaded via Select2 -->
                            </select>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-secondary btn-sm js-clear-select2 px-3 mr-1" data-target="#filter_company_id">
                            <i class="la la-eraser mr-1"></i> {!! __('general.clear') !!}
                        </button>
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="la la-check-circle mr-1"></i> {!! __('general.apply') !!}
                        </button>
                    </div>
                </div>
            </div>
            @endif

            <!-- Reset Button -->
            <div class="filter-chip reset-chip js-reset-btn">
                <i class="la la-refresh"></i>
                <span>{!! __('general.reset') !!}</span>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script src="{!! asset('assets/dashbaord/js/filter-system.js') !!}"></script>
@endpush
