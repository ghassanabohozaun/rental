<!-- Header Premium Card -->
<div class="contract-header-premium header-customer-royal mb-2">
    <div class="header-bg-shape"></div>
    <div class="premium-header-flex d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center flex-grow-1">
            <div class="header-profile-box d-flex align-items-center flex-grow-1">
                <!-- Icon -->
                <div class="header-icon-wrapper shadow-sm text-primary mr-2"
                    style="background: white; border-radius: 12px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-user-tie font-16"></i>
                </div>

                <div class="d-flex flex-column justify-content-center">
                    <div class="d-flex align-items-center">
                        <!-- Name -->
                        <h1 class="text-white font-weight-bold mb-0 header-title-lg mr-3">
                            {!! $customer->getTranslation('name', 'ar') !!}
                            <span class="opacity-50 mx-1 font-medium-3">|</span>
                            <span class="font-medium-5">{!! $customer->getTranslation('name', 'en') !!}</span>
                        </h1>

                        <!-- Details Strip -->
                        <div
                            class="text-white header-subtitle-md d-flex align-items-center border-left-light-opacity pl-3" style="opacity: 0.9;">
                            <span class="mr-3"><i
                                    class="fas fa-id-card mr-1 font-12"></i>{!! $customer->id_number !!}</span>
                            <span class="mr-3"><i class="fas fa-phone mr-1 font-12"></i>{!! $customer->phone !!}</span>
                            @if ($customer->email)
                                <span><i class="fas fa-envelope mr-1 font-12"></i>{!! $customer->email !!}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status & Type -->
        <div class="header-type-box d-flex align-items-center">
            @php
                $statusColor = $customer->status ? '#28d094' : '#ff4961';
            @endphp
            <span
                class="badge px-3 py-0 font-12 d-inline-flex align-items-center text-white border-0 mr-2 shadow-sm"
                style="background-color: {!! $statusColor !!} !important; height: 30px; font-weight: 600; border-radius: 6px !important;">
                <i class="fas fa-circle font-8 mr-1"></i>
                {!! $customer->status ? __('general.active') : __('general.inactive') !!}
            </span>

            <span class="badge badge-light-primary-opacity text-primary font-12 px-3 py-0"
                style="background: rgba(255, 255, 255, 0.15) !important; color: #fff !important; border: 1px solid rgba(255,255,255,0.25); height: 30px; display: flex; align-items: center; font-weight: 600; border-radius: 6px !important;">
                <i class="fas fa-user-tag mr-1 font-12"></i>
                {!! __('customers.type_' . strtolower($customer->tenant_type)) !!}
            </span>
        </div>
    </div>
</div>
