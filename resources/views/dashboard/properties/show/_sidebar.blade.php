<!-- Compact Sidebar Stats Panel -->
<div class="sidebar-stats-panel mt-1">
    <div class="card premium-card border-0 shadow-sm overflow-hidden radius-15 bg-white">
        <!-- Header - Premium Wallet Icon -->
        <div class="card-header bg-transparent border-0 pt-0 pb-0 d-flex align-items-center" style="height: 50px;">
            <h5 class="card-title font-weight-bold mb-0" style="font-size: 1.1rem !important;">
                <i class="fas fa-wallet text-primary mr-1" style="font-size: 1.2rem !important;"></i> {!! __('contracts.financial_summary') !!}
            </h5>
        </div>

        <div class="card-body p-2 d-flex flex-column h-100" style="padding-bottom: 28px !important;">
            <!-- File Number Badge - Accent Border -->
            <div class="file-number-sidebar-badge mb-2 text-center p-2 rounded shadow-none bg-light-info-opacity"
                style="border-left: 4px solid #00cfe8;">
                <div class="file-number-label text-muted font-medium-1 mb-1">{!! __('properties.file_number') !!}</div>
                <div class="font-weight-bold font-large-1 text-primary">{!! $property->file_number ?? '---' !!}</div>
            </div>

            <!-- 1. Financial Summary Section (Side-by-Side) - Dashed Border -->
            <div class="stat-section mb-2 p-2 rounded border-dashed-premium">
                <div class="row no-gutters align-items-center">
                    <!-- Total Revenue -->
                    <div class="col-6 text-center border-right-light">
                        <span
                            class="sidebar-meta-label text-muted d-block font-medium-1 mb-1">{!! __('contracts.total_revenue') !!}</span>
                        <span class="font-weight-bold font-large-2 text-success">{!! number_format($property->contracts->sum('total_amount'), 0) !!}</span>
                    </div>

                    <!-- Rental Price -->
                    <div class="col-6 text-center">
                        <span
                            class="sidebar-meta-label text-muted d-block font-medium-1 mb-1">{!! __('properties.price') !!}</span>
                        <span class="font-weight-bold font-large-2 text-primary">{!! number_format($property->price, 0) !!}</span>
                    </div>
                </div>
            </div>

            <!-- 2. Creation Meta Info - Dashed Border -->
            <div class="stat-section mb-2 p-2 rounded border-dashed-premium">
                <div class="row no-gutters align-items-center">
                    <div class="col-6 text-center border-right-light">
                        <span
                            class="sidebar-meta-label text-muted d-block font-medium-1 mb-1">{!! __('general.created_at') !!}</span>
                        <span class="font-weight-bold font-small-3 text-dark">{!! $property->created_at->format('Y-m-d H:i') !!}</span>
                    </div>
                    <div class="col-6 text-center">
                        <span
                            class="sidebar-meta-label text-muted d-block font-medium-1 mb-1">{!! __('general.created_by') !!}</span>
                        <span class="font-weight-bold font-small-3 text-primary d-block">{!! $property->creator->name ?? __('general.system') !!}</span>
                    </div>
                </div>
            </div>

            <!-- 3. Usage & Inventory Summary -->
            <div class="stat-section mt-1 mb-0 px-1">
                <h6 class="text-muted font-weight-bold mb-1 font-medium-1 text-right-rtl">
                    {!! __('general.usage_summary') !!}
                </h6>

                <div class="stats-grid row no-gutters">
                    <div class="col-6 pr-1">
                        <div class="p-2 rounded text-center bg-light-primary-opacity border-0">
                            <div class="text-muted font-medium-1 mb-0">{!! __('contracts.contracts') !!}</div>
                            <div class="font-weight-bold text-primary font-large-2">{!! $property->contracts->count() !!}</div>
                        </div>
                    </div>
                    <div class="col-6 pl-1">
                        <div class="p-2 rounded text-center bg-light-warning-opacity border-0">
                            <div class="text-muted font-medium-1 mb-0">{!! __('maintenances.maintenances') !!}</div>
                            <div class="font-weight-bold text-warning font-large-2">{!! $property->maintenances->count() !!}</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



