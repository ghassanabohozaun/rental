<!-- Header Premium Card -->
<div class="contract-header-premium header-property-dark mb-4">
    <div class="header-bg-shape"></div>
    <div class="premium-header-flex">
        <div class="header-profile-box">
            <div class="header-icon-wrapper shadow-lg text-primary mr-3" style="background: white; border-radius: 20px;">
                <i class="fas fa-building icon-size-36"></i>
            </div>
            <div>
                <h1 class="text-white font-weight-bold mb-1 header-title-lg">
                    {!! $property->name !!}
                </h1>
                <p class="text-white-50 mb-0 header-subtitle-md">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    <span>{!! $property->location !!}</span>
                    <span class="mx-2">|</span>
                    <i class="fas fa-hashtag mr-1"></i>
                    <span>{!! $property->property_number !!}</span>
                    <span class="mx-2">|</span>
                    <i class="fas fa-vector-square mr-1"></i>
                    <span>{!! $property->area !!} {!! __('properties.sq_m') ?? 'm²' !!}</span>
                </p>
            </div>
        </div>
        <div class="header-price-side text-center">
            <div class="price-hero-box">
                <div class="small text-white-50 text-uppercase letter-spacing-1">{!! __('properties.property_type') !!}</div>
                <h2 class="text-white font-weight-bold mb-0" style="font-size: 24px;">
                    {!! $property->propertyType->name !!}
                </h2>
            </div>
            <div class="mt-2">
                @php
                    $statusColor = '#28d094'; // default green
                    if ($property->property_status_id == 2) $statusColor = '#5A8DEE'; // Rented (Blue)
                    if ($property->property_status_id == 4) $statusColor = '#ff9f43'; // Maintenance (Orange)
                @endphp
                <span class="badge badge-pill px-3 py-1 shadow-sm" style="font-size: 14px; display: inline-flex; align-items: center; background-color: {!! $statusColor !!} !important; color: white; border: none;">
                    <i class="fas fa-info-circle mr-2"></i>
                    {!! $property->propertyStatus->name !!}
                </span>
            </div>
        </div>
    </div>
</div>
