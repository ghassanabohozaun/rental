<input type="hidden" id="properties-total-count" value="{!! $properties->total() !!}">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead>
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th> <!-- Mobile Control -->
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0" style="width: 50px;">#</th>
                @if(isset($companies))
                    <th class="text-center align-middle py-3 border-top-0 d-none d-md-table-cell">{!! __('companies.company') !!}</th>
                @endif
                <th class="align-middle py-3 border-top-0 property-info-td">{!! __('properties.property') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-md-table-cell">{!! __('properties.type') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-md-table-cell">{!! __('properties.parent_property') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-md-table-cell">{!! __('properties.file_number') !!}</th>

                <th class="text-center align-middle py-3 border-top-0">{!! __('properties.status') !!}</th>
                <!-- Actions Column Removed for Bottom Action Bar -->
            </tr>
        </thead>
        <tbody>
            @forelse ($properties as $key => $property)
                <tr id="row{{ $property->id }}" class="premium-table-row pointer" data-row-title="عقار | {!! $property->name !!}">
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
                                            <span class="detail-info-label">{!! __('properties.zone_number') !!}</span>
                                            <span class="detail-info-value text-muted small">{!! $property->zone_number ?? '---' !!}</span>
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

                    <!-- Company -->
                    @if(isset($companies))
                        <td class="text-center align-middle d-none d-md-table-cell">
                            <span class="font-weight-bold text-dark">
                                {!! optional($property->company)->name !!}
                            </span>
                        </td>
                    @endif

                    <!-- Property Info (Name + Address) -->
                    <td class="align-middle property-info-td">
                        <!-- Hidden Actions for Bottom Bar -->
                        <div class="row-actions-html d-none">
                            @include('dashboard.properties.parts.actions')
                        </div>

                        <!-- Hidden Subtitle for Bottom Bar -->
                        <div class="row-subtitle-html d-none">
                            <span class="text-muted"><i class="fas fa-sitemap mr-25 opacity-5"></i> {!! optional($property->propertyType)->name !!}</span>
                            <span class="text-muted mx-50">|</span>
                            <span class="text-muted"><i class="far fa-folder-open mr-25 opacity-5"></i> ملف: {!! $property->file_number ?? '---' !!}</span>
                            @if($property->propertyStatus)
                            <span class="text-muted mx-50">|</span>
                            <span class="font-weight-bold" style="color: {!! $property->propertyStatus->color !!}"><i class="fas fa-circle mr-25 font-10"></i> {!! $property->propertyStatus->name !!}</span>
                            @endif
                        </div>

                        <div class="user-info-cell">
                            <span class="user-name-text">{!! $property->name !!}</span>
                            <span class="user-email-text"><i class="fas fa-map-marker-alt mr-25"></i> {!! Str::limit($property->zone_number . ' - ' . $property->street_number, 30) ?? '---' !!}</span>
                        </div>
                    </td>

                    <!-- Type -->
                    <td class="text-center align-middle d-none d-md-table-cell">
                        <span class="text-dark">
                            {!! optional($property->propertyType)->name !!}
                        </span>
                    </td>

                    <!-- Parent Property -->
                    <td class="text-center align-middle d-none d-md-table-cell">
                        @if($property->parent_id)
                            <span class="text-warning font-weight-bold">
                                <i class="fas fa-link mr-1 opacity-5"></i>
                                {!! optional($property->parent)->name !!}
                            </span>
                        @else
                            <span class="text-primary">
                                <i class="fas fa-sitemap mr-1 opacity-5"></i>
                                {!! __('properties.standalone_property') !!}
                            </span>
                        @endif
                    </td>

                    <!-- File Number -->
                    <td class="text-center align-middle d-none d-md-table-cell">
                        <span class="text-dark">
                            {!! $property->file_number ?? '---' !!}
                        </span>
                    </td>



                    <!-- Status -->
                    <td class="text-center align-middle">
                        @if($property->propertyStatus)
                            <span class="badge badge-pill border-0 shadow-none px-2 py-1 font-weight-bold" style="background-color: {!! $property->propertyStatus->color !!}15; color: {!! $property->propertyStatus->color !!};">
                                <i class="fas fa-circle font-10 mr-1"></i>
                                {!! $property->propertyStatus->name !!}
                            </span>
                        @else
                            <span class="text-muted">---</span>
                        @endif
                    </td>

                    <!-- Actions Column Removed -->
                </tr>
            @empty
                <tr>
                    <td colspan="100%" class="text-center p-4">
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



