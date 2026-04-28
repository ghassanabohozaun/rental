<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th> <!-- For Details Control -->
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">#</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('properties.property') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('properties.location') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('properties.type') !!}</th>
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
                            <i class="la la-plus-circle text-primary" style="font-size: 22px;"></i>
                        </span>

                        <!-- Hidden Row Details for AJAX Modal -->
                        <div class="row-details d-none">
                            <div class="modal-details-card">
                                <!-- Header Gradient -->
                                <div class="premium-modal-header"></div>

                                <div class="text-center">
                                    <div class="modal-profile-wrapper">
                                        <div class="avatar-circle avatar-size-100 d-inline-flex align-items-center justify-content-center text-white text-uppercase shadow-sm bg-premium-gradient">
                                            <i class="la la-building font-40"></i>
                                        </div>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold">{!! $property->name !!}</h4>
                                    <span class="modal-role-badge">
                                        {!! optional($property->propertyType)->name !!}
                                    </span>
                                </div>

                                <!-- Detail Items List -->
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-fingerprint"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('general.system_id') !!}</span>
                                            <span class="detail-info-value text-muted"># {!! $property->id !!}</span>
                                        </div>
                                    </div>

                                    @if(isset($companies))
                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="la la-briefcase"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('companies.company') !!}</span>
                                            <span class="detail-info-value">
                                                <span class="badge badge-light-primary border-0">{!! optional($property->company)->name !!}</span>
                                            </span>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="la la-map-marker"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('properties.location') !!}</span>
                                            <span class="detail-info-value text-muted small">{!! $property->location ?? '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="la la-money"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('properties.price') !!}</span>
                                            <span class="detail-info-value font-weight-bold text-success">{!! $property->price ? number_format($property->price, 2) : '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="la la-check-circle"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('properties.status') !!}</span>
                                            <span class="detail-info-value">
                                                @if($property->propertyStatus)
                                                    <span class="badge" style="background-color: {!! $property->propertyStatus->color !!}20; color: {!! $property->propertyStatus->color !!}; border: 1px solid {!! $property->propertyStatus->color !!}40;">
                                                        {!! $property->propertyStatus->name !!}
                                                    </span>
                                                @else
                                                    ---
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="la la-user-plus"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('properties.owner') !!}</span>
                                            <span class="detail-info-value">{!! $property->owner->name ?? '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="la la-calendar"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('general.created_at') !!}</span>
                                            <span class="detail-info-value text-muted">{!! $property->created_at->format('Y-m-d') !!}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- Desktop ID Badge -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            {!! $loop->iteration !!}
                        </span>
                    </td>

                    <!-- Name -->
                    <td class="text-center align-middle font-weight-bold text-primary">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="la la-building mr-1 d-none d-md-inline"></i>
                            {!! $property->name !!}
                        </div>
                    </td>

                    <!-- Location -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-muted small">
                            <i class="la la-map-marker mr-25"></i> {!! Str::limit($property->location, 20) ?? '---' !!}
                        </span>
                    </td>

                    <!-- Type -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-light-primary border-0">
                            {!! optional($property->propertyType)->name !!}
                        </span>
                    </td>

                    <!-- Price -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="font-weight-bold text-success">
                            {!! $property->price ? number_format($property->price, 2) : '---' !!}
                        </span>
                    </td>

                    <!-- Status -->
                    <td class="text-center align-middle">
                        @if($property->propertyStatus)
                            <span class="badge" style="background-color: {!! $property->propertyStatus->color !!}20; color: {!! $property->propertyStatus->color !!}; border: 1px solid {!! $property->propertyStatus->color !!}40;">
                                {!! $property->propertyStatus->name !!}
                            </span>
                        @else
                            ---
                        @endif
                    </td>

                    <!-- Company (Super Admin Only) -->
                    @if(isset($companies))
                        <td class="text-center align-middle d-none d-md-table-cell">
                            <span class="badge badge-light-primary border-0">
                                <i class="la la-briefcase mr-25"></i> {!! optional($property->company)->name !!}
                            </span>
                        </td>
                    @endif

                    <!-- Actions -->
                    <td class="text-center align-middle">
                        @include('dashboard.properties.parts.actions')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center p-3 text-muted">
                        <i class="ft-info mr-1"></i> {!! __('properties.no_properties_found') !!}
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>
    <div class="float-right mt-2 custom-pagination">
        {!! $properties->links() !!}
    </div>
</div>
