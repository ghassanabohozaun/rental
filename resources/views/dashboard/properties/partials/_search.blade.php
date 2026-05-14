<div class="query-bar-container">
    <div class="query-bar js-query-bar">
        <span class="query-bar-label">
            <i class="fas fa-filter"></i> {!! __('general.filters') !!}:
        </span>

        <form class="js-filter-form d-flex align-items-center gap-2" data-container="#table_data" data-loader=".table-loader-overlay">
            
            <!-- 1. Property Search (Keyword) -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="property_search_popover">
                    <i class="fas fa-search text-primary"></i>
                    <span class="chip-text">{!! __('properties.property') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="property_search_popover">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('properties.property') !!}</label>
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

            <!-- 2. Company Filter (If exists) -->
            @if(isset($companies) && $companies->count() > 0)
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="company_search_popover">
                    <i class="fas fa-briefcase text-primary"></i>
                    <span class="chip-text">{!! __('companies.company') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="company_search_popover" style="min-width: 280px;">
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

            <!-- 3. Dependency Filter (Main/Sub) -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="dependency_search_popover">
                    <i class="fas fa-sitemap text-primary"></i>
                    <span class="chip-text">{!! __('properties.parent_property') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="dependency_search_popover" style="min-width: 280px;">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('properties.parent_property') !!}</label>
                        <div class="premium-input-wrapper">
                            <select name="dependency_status" id="filter_dependency" 
                                class="form-control premium-input shadow-none js-select2"
                                data-placeholder="{!! __('general.all') !!}"
                                data-parent="#dependency_search_popover">
                                <option value="">{!! __('general.all') !!}</option>
                                <option value="main">{!! __('properties.standalone_property') !!}</option>
                                <option value="sub">{!! __('properties.sub_property') !!}</option>
                            </select>
                            <i class="fas fa-sitemap text-primary"></i>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> {!! __('general.apply') !!}
                        </button>
                    </div>
                </div>
            </div>

            <!-- 4. Status Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="status_search_popover">
                    <i class="fas fa-check-circle text-primary"></i>
                    <span class="chip-text">{!! __('properties.status') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="status_search_popover" style="min-width: 280px;">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('properties.status') !!}</label>
                        <div class="premium-input-wrapper">
                            <select name="property_status_id" id="filter_status" 
                                class="form-control premium-input shadow-none js-select2"
                                data-placeholder="{!! __('general.all') !!}"
                                data-parent="#status_search_popover">
                                <option value="">{!! __('general.all') !!}</option>
                                @foreach ($property_statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
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

            <!-- 5. Type Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="type_search_popover">
                    <i class="fas fa-tags text-primary"></i>
                    <span class="chip-text">{!! __('properties.property_type') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="type_search_popover" style="min-width: 280px;">
                    <div class="mb-3">
                        <label class="premium-label mb-2">{!! __('properties.property_type') !!}</label>
                        <div class="premium-input-wrapper">
                            <select name="property_type_id" id="filter_type" 
                                class="form-control premium-input shadow-none js-select2"
                                data-placeholder="{!! __('general.all') !!}"
                                data-parent="#type_search_popover">
                                <option value="">{!! __('general.all') !!}</option>
                                @foreach ($property_types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <i class="fas fa-tags text-primary"></i>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> {!! __('general.apply') !!}
                        </button>
                    </div>
                </div>
            </div>

            <!-- 6. Price Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="price_search_popover">
                    <i class="fas fa-money-bill-wave text-primary"></i>
                    <span class="chip-text">{!! __('properties.price') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="price_search_popover" style="min-width: 280px;">
                    <div class="mb-3">
                        <label class="premium-label mb-1 small text-muted">{!! __('general.min') !!}</label>
                        <div class="premium-input-wrapper">
                            <input type="number" class="form-control premium-input shadow-none" name="price_min"
                                placeholder="0" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="premium-label mb-1 small text-muted">{!! __('general.max') !!}</label>
                        <div class="premium-input-wrapper">
                            <input type="number" class="form-control premium-input shadow-none" name="price_max"
                                placeholder="..." autocomplete="off">
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> {!! __('general.apply') !!}
                        </button>
                    </div>
                </div>
            </div>

            <!-- 7. Area Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="area_search_popover">
                    <i class="fas fa-ruler-combined text-primary"></i>
                    <span class="chip-text">{!! __('properties.area') !!}</span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="area_search_popover" style="min-width: 280px;">
                    <div class="mb-3">
                        <label class="premium-label mb-1 small text-muted">{!! __('general.min') !!}</label>
                        <div class="premium-input-wrapper">
                            <input type="number" class="form-control premium-input shadow-none" name="area_min"
                                placeholder="0" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="premium-label mb-1 small text-muted">{!! __('general.max') !!}</label>
                        <div class="premium-input-wrapper">
                            <input type="number" class="form-control premium-input shadow-none" name="area_max"
                                placeholder="..." autocomplete="off">
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


