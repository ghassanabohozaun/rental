<input type="hidden" id="properties-total-count" value="{!! $properties->total() !!}">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead>
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th> <!-- Mobile Control -->
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0" style="width: 50px;">#</th>
                <th class="align-middle py-3 border-top-0 property-info-td">{!! __('properties.property') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-md-table-cell">{!! __('properties.type') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-md-table-cell">{!! __('properties.area') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('properties.price') !!}</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('properties.status') !!}</th>
                @if(isset($companies))
                    <th class="text-center align-middle py-3 border-top-0 d-none d-md-table-cell">{!! __('companies.company') !!}</th>
                @endif
                <th class="text-center align-middle py-3 border-top-0 min-w-140">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($properties as $key => $property)
                <tr id="row{{ $property->id }}">
                    <!-- Mobile Details Control -->
                    <td class="text-center align-middle d-lg-none">
                        <span class="details-control pointer">
                            <i class="fas fa-plus-circle text-primary" style="font-size: 22px;"></i>
                        </span>
                        <!-- Hidden Row Details for AJAX Modal -->
                        <div class="row-details d-none">
                            <div class="modal-details-card">
                                <div class="premium-modal-header"></div>
                                <div class="text-center">
                                    <div class="modal-profile-wrapper">
                                        <div class="avatar-circle avatar-size-100 d-inline-flex align-items-center justify-content-center text-white text-uppercase shadow-sm bg-premium-gradient">
                                            <i class="fas fa-building font-40"></i>
                                        </div>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold">{!! $property->name !!}</h4>
                                    <span class="modal-role-badge">{!! optional($property->propertyType)->name !!}</span>
                                </div>
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-map-marker-alt"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('properties.location') !!}</span>
                                            <span class="detail-info-value text-muted small">{!! $property->location ?? '---' !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- ID -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            {!! $loop->iteration + ($properties->currentPage() - 1) * $properties->perPage() !!}
                        </span>
                    </td>

                    <!-- Property Info (Name + Location) -->
                    <td class="align-middle property-info-td">
                        <div class="user-info-cell">
                            <span class="user-name-text">{!! $property->name !!}</span>
                            <span class="user-email-text"><i class="fas fa-map-marker-alt mr-25"></i> {!! Str::limit($property->location, 30) ?? '---' !!}</span>
                        </div>
                    </td>

                    <!-- Type -->
                    <td class="text-center align-middle d-none d-md-table-cell">
                        <span class="property-type-badge">
                            {!! optional($property->propertyType)->name !!}
                        </span>
                    </td>

                    <!-- Area -->
                    <td class="text-center align-middle d-none d-md-table-cell">
                        <span class="area-badge">
                            {!! $property->area ?? '---' !!}
                        </span>
                    </td>

                    <!-- Price -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <div class="flex-column-center">
                            <span class="font-weight-bold text-dark font-14">
                                {!! $property->price ? number_format($property->price, 0) : '---' !!}
                            </span>
                        </div>
                    </td>

                    <!-- Status -->
                    <td class="text-center align-middle">
                        @if($property->propertyStatus)
                            <span class="premium-badge" style="background-color: {!! $property->propertyStatus->color !!}15; color: {!! $property->propertyStatus->color !!};">
                                <i class="fas fa-circle font-11 mr-1"></i>
                                {!! $property->propertyStatus->name !!}
                            </span>
                        @else
                            <span class="text-muted">---</span>
                        @endif
                    </td>

                    <!-- Company -->
                    @if(isset($companies))
                        <td class="text-center align-middle d-none d-md-table-cell">
                            <a href="javascript:void(0)" class="company-chip">
                                <i class="fas fa-briefcase mr-1"></i>
                                {!! optional($property->company)->name !!}
                            </a>
                        </td>
                    @endif

                    <!-- Actions -->
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center gap-2">
                            @include('dashboard.properties.parts.actions')
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center p-4">
                        <div class="flex-column-center">
                            <i class="fas fa-info-circle text-muted font-40 mb-2"></i>
                            <h5 class="text-muted">{!! __('properties.no_properties_found') !!}</h5>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <!-- Modern Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-3 px-2">
        <div class="text-muted font-12">
            {!! __('general.showing') !!} {{ $properties->firstItem() }} {!! __('general.to') !!} {{ $properties->lastItem() }} {!! __('general.of') !!} {{ $properties->total() }} {!! __('properties.properties') !!}
        </div>
        <div class="custom-pagination">
            {!! $properties->links() !!}
        </div>
    </div>
</div>
