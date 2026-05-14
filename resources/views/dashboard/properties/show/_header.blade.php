<!-- Header Premium Card -->
<div class="contract-header-premium header-property-black mb-2">
    <div class="header-bg-shape"></div>
    <div class="premium-header-flex d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center flex-grow-1">
            <div class="header-profile-box d-flex align-items-center flex-grow-1">
                <!-- Icon -->
                <div class="header-icon-wrapper shadow-sm text-primary mr-2"
                    style="background: white; border-radius: 12px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-building font-16"></i>
                </div>

                <div class="d-flex flex-column justify-content-center overflow-hidden">
                    <!-- Full Parent Hierarchy Breadcrumbs -->
                    @if ($property->parent_id)
                        <div class="property-hierarchy-path mb-1 font-12 d-flex align-items-center">
                            @php
                                $path = [];
                                $currentParent = $property->parent;
                                while ($currentParent) {
                                    $path[] = $currentParent;
                                    $currentParent = $currentParent->parent;
                                }
                                $path = array_reverse($path);
                            @endphp
                            @foreach ($path as $parentItem)
                                <a href="{!! route('dashboard.properties.show', $parentItem->id) !!}"
                                    class="text-white hover-underline font-weight-600 font-small-3" style="opacity: 0.85;">
                                    {!! $parentItem->name !!}
                                </a>
                                <i class="fas fa-chevron-left mx-1 text-white opacity-50" style="font-size: 8px;"></i>
                            @endforeach
                        </div>
                    @endif

                    <div class="d-flex align-items-center flex-wrap">
                        <!-- Name -->
                        <h1 class="text-white font-weight-bold mb-0 header-title-lg mr-3 text-truncate"
                            style="max-width: 400px;">
                            {!! $property->name !!}
                        </h1>

                        <!-- Details Strip -->
                        <div
                            class="text-white header-subtitle-md d-flex align-items-center border-left-light-opacity pl-3 mt-0" style="opacity: 0.9;">
                            <span class="mr-3"><i
                                    class="fas fa-map-marker-alt mr-1 font-12"></i>{!! $property->location !!}</span>
                            <span class="mr-3"><i
                                    class="fas fa-hashtag mr-1 font-12"></i>{!! $property->property_number !!}</span>
                            <span><i class="fas fa-vector-square mr-1 font-12"></i>{!! $property->area !!}
                                {!! __('properties.sq_m') ?? 'm²' !!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status & Type -->
        <div class="header-type-box d-flex align-items-center">
            @php
                $statusColor = '#28d094';
                if ($property->property_status_id == 2) {
                    $statusColor = '#5A8DEE';
                }
                if ($property->property_status_id == 4) {
                    $statusColor = '#ff9f43';
                }
            @endphp
            <span
                class="badge px-3 py-0 font-12 d-inline-flex align-items-center text-white border-0 mr-2 shadow-sm"
                style="background-color: {!! $statusColor !!} !important; height: 30px; font-weight: 600; border-radius: 6px !important;">
                <i class="fas fa-circle font-8 mr-1"></i>
                {!! $property->propertyStatus->name !!}
            </span>

            <span class="badge badge-light-primary-opacity text-primary font-12 px-3 py-0"
                style="background: rgba(255, 255, 255, 0.15) !important; color: #fff !important; border: 1px solid rgba(255,255,255,0.25); height: 30px; display: flex; align-items: center; font-weight: 600; border-radius: 6px !important;">
                <i class="fas fa-layer-group mr-1 font-12"></i>
                {!! $property->propertyType->name !!}
            </span>
        </div>
    </div>
</div>


