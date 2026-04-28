<div class="query-bar-container">
    <div class="query-bar js-query-bar">
        <span class="query-bar-label">
            <i class="la la-filter"></i> {!! __('general.filters') !!}:
        </span>

        <form class="js-filter-form d-flex align-items-center gap-2" data-container="#table_data" data-loader=".table-loader-overlay">
            <!-- Property Search -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="property_search_popover">
                    <i class="la la-building"></i>
                    <span class="chip-text">{!! __('properties.property') !!}</span>
                    <span class="badge badge-primary badge-pill badge-glow ml-1 d-inline-flex align-items-center justify-content-center" style="font-size: 11px; width: 35px; height: 18px; padding: 0;">{!! $properties->total() !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="property_search_popover" style="border-radius: 16px;">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('properties.property') !!}</label>
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

            <!-- Status Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="status_search_popover">
                    <i class="la la-check-circle"></i>
                    <span class="chip-text">{!! __('properties.status') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="status_search_popover" style="border-radius: 16px; min-width: 280px;">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('properties.status') !!}</label>
                        <div class="premium-input-wrapper">
                            <select name="property_status_id" id="filter_status" 
                                class="form-control premium-input shadow-none js-select2 js-autocomplete"
                                data-url="{!! route('dashboard.property_statuses.autocomplete') !!}"
                                data-placeholder="{!! __('general.all') !!}"
                                data-parent="#status_search_popover">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-secondary btn-sm js-clear-select2 px-3 mr-1" data-target="#filter_status">
                            <i class="la la-eraser mr-1"></i> {!! __('general.clear') !!}
                        </button>
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="la la-check-circle mr-1"></i> {!! __('general.apply') !!}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Type Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="type_search_popover">
                    <i class="la la-tags"></i>
                    <span class="chip-text">{!! __('properties.property_type') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="type_search_popover" style="border-radius: 16px; min-width: 280px;">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('properties.property_type') !!}</label>
                        <div class="premium-input-wrapper">
                            <select name="property_type_id" id="filter_type" 
                                class="form-control premium-input shadow-none js-select2 js-autocomplete"
                                data-url="{!! route('dashboard.property_types.autocomplete') !!}"
                                data-placeholder="{!! __('general.all') !!}"
                                data-parent="#type_search_popover">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-secondary btn-sm js-clear-select2 px-3 mr-1" data-target="#filter_type">
                            <i class="la la-eraser mr-1"></i> {!! __('general.clear') !!}
                        </button>
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="la la-check-circle mr-1"></i> {!! __('general.apply') !!}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Location Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="location_search_popover">
                    <i class="la la-map-marker"></i>
                    <span class="chip-text">{!! __('properties.location') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="location_search_popover" style="border-radius: 16px; min-width: 280px;">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('properties.location') !!}</label>
                        <div class="premium-input-wrapper">
                            <input type="text" class="form-control premium-input shadow-none" name="location"
                                placeholder="{!! __('general.search') !!}..." autocomplete="off">
                            <i class="la la-map-marker text-primary"></i>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="la la-check-circle mr-1"></i> {!! __('general.apply') !!}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Price Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="price_search_popover">
                    <i class="la la-money"></i>
                    <span class="chip-text">{!! __('properties.price') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="price_search_popover" style="border-radius: 16px; min-width: 320px;">
                    <div class="row">
                        <div class="col-6">
                            <label class="premium-label mb-2">{!! __('general.min') !!}</label>
                            <div class="premium-input-wrapper">
                                <input type="number" class="form-control premium-input shadow-none" name="price_min"
                                    placeholder="0" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="premium-label mb-2">{!! __('general.max') !!}</label>
                            <div class="premium-input-wrapper">
                                <input type="number" class="form-control premium-input shadow-none" name="price_max"
                                    placeholder="..." autocomplete="off">
                            </div>
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
                    <i class="la la-briefcase"></i>
                    <span class="chip-text">{!! __('companies.company') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="company_search_popover" style="border-radius: 16px; min-width: 280px;">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('companies.company') !!}</label>
                        <div class="premium-input-wrapper">
                            <select name="company_id" id="filter_company_id" 
                                class="form-control premium-input shadow-none js-select2 js-autocomplete"
                                data-url="{!! route('dashboard.companies.autocomplete') !!}"
                                data-placeholder="{!! __('general.all_companies') !!}"
                                data-parent="#company_search_popover">
                                <option></option>
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
