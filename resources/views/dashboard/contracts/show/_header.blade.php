<!-- Header Premium Card -->
<div class="contract-header-premium header-contract-navy mb-3">
    <div class="header-bg-shape"></div>
    <div class="premium-header-flex d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center flex-grow-1">
            <div class="header-profile-box d-flex align-items-center flex-grow-1">
                <!-- Icon -->
                <div class="header-icon-wrapper shadow-sm text-primary mr-2"
                    style="background: white; border-radius: 12px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-file-contract font-16"></i>
                </div>

                <div class="d-flex flex-column justify-content-center">
                    <div class="d-flex align-items-center">
                        <!-- Property Name -->
                        <h1 class="text-white font-weight-bold mb-0 header-title-lg mr-3">
                            {!! optional($contract->property)->name !!}
                        </h1>

                        <!-- Details Strip -->
                        <div class="text-white header-subtitle-md d-flex align-items-center border-left-light-opacity pl-3" style="opacity: 0.9;">
                            <span class="mr-3"><i class="fas fa-user-circle mr-1 font-12"></i>{!! optional($contract->customer)->name !!}</span>
                            <span class="mr-3"><i class="fas fa-calendar-alt mr-1 font-12"></i>{!! $contract->duration_label !!}</span>
                            <span><i class="fas fa-clock mr-1 font-12"></i>{!! __('contracts.payment_cycle_' . $contract->payment_cycle) !!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status & Amount -->
        <div class="header-type-box d-flex align-items-center">
            <span class="badge px-3 py-0 font-12 d-inline-flex align-items-center text-white border-0 mr-2 shadow-sm"
                style="background-color: {!! $statusColor !!} !important; height: 30px; font-weight: 600; border-radius: 6px !important;">
                <i class="fas {!! $statusIcon !!} font-8 mr-1"></i>
                {!! __('contracts.status_' . $contract->status) !!}
            </span>

            <div class="price-hero-box py-1 px-3 d-flex align-items-center" style="height: 30px; background: rgba(255,255,255,0.15); border-radius: 6px; border: 1px solid rgba(255,255,255,0.2);">
                <span class="text-white-50 font-small-2 mr-2 text-uppercase" style="font-size: 10px !important;">{!! __('contracts.rent_amount') !!}</span>
                <span class="text-white font-weight-bold font-medium-1">{!! number_format($contract->rent_amount, 0) !!}</span>
            </div>
        </div>
    </div>
</div>
