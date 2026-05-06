<!-- Header Premium Card -->
<div class="contract-header-premium header-customer-dark mb-4">
    <div class="header-bg-shape"></div>
    <div class="premium-header-flex">
        <div class="header-profile-box">
            <div class="header-icon-wrapper shadow-lg text-primary mr-3" style="background: white; border-radius: 20px;">
                <i class="fas fa-user-tie icon-size-36"></i>
            </div>
            <div>
                <h1 class="text-white font-weight-bold mb-1 header-title-lg">
                    {!! $customer->name !!}
                </h1>
                <p class="text-white-50 mb-0 header-subtitle-md">
                    <i class="fas fa-id-card mr-1"></i>
                    <span>{!! $customer->id_number !!}</span>
                    <span class="mx-2">|</span>
                    <i class="fas fa-phone mr-1"></i>
                    <span>{!! $customer->phone !!}</span>
                    @if($customer->email)
                    <span class="mx-2">|</span>
                    <i class="fas fa-envelope mr-1"></i>
                    <span>{!! $customer->email !!}</span>
                    @endif
                </p>
            </div>
        </div>
        <div class="header-price-side text-center">
            <div class="price-hero-box">
                <div class="small text-white-50 text-uppercase letter-spacing-1">{!! __('customers.customer_type') !!}</div>
                <h2 class="text-white font-weight-bold mb-0" style="font-size: 24px;">
                    {!! __('customers.type_' . strtolower($customer->tenant_type)) !!}
                </h2>
            </div>
            <div class="mt-2">
                @php
                    $statusClass = $customer->status ? 'success' : 'danger';
                    $statusIcon = $customer->status ? 'check-circle' : 'times-circle';
                    $statusLabel = $customer->status ? __('general.active') : __('general.inactive');
                @endphp
                <span class="badge badge-pill badge-{!! $statusClass !!} px-3 py-1 shadow-sm" style="font-size: 14px; display: inline-flex; align-items: center; background-color: {!! $customer->status ? '#28d094' : '#ff4961' !!} !important; border: none;">
                    <i class="fas fa-{!! $statusIcon !!} mr-2"></i>
                    {!! $statusLabel !!}
                </span>
            </div>
        </div>
    </div>
</div>
