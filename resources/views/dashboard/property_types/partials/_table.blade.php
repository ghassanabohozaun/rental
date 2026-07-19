<input type="hidden" id="property_types-total-count" value="{!! $property_types->total() !!}">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">#</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('companies.company') !!}</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('property_types.name') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('property_types.created_by') !!}</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('property_types.status') !!}</th>
                @can('property_types_update')
                <th class="text-center align-middle py-3 border-top-0">{!! __('property_types.manage_status') !!}</th>
                @endcan
                <!-- Actions Column Removed for Bottom Action Bar -->
            </tr>
        </thead>
        <tbody>
            @forelse ($property_types as $key=>$property_type)
                <tr id="row{{ $property_type->id }}" class="premium-table-row pointer" data-row-title="نوع عقار | {!! $property_type->name !!}">
                    <!-- Mobile Details Control -->
                    <td class="text-center align-middle d-lg-none">
                        <span class="details-control pointer">
                            <i class="fas fa-plus-circle text-primary" style="font-size: 22px;"></i>
                        </span>

                        <!-- Hidden Row Details for AJAX Modal -->
                        <div class="row-details d-none">
                            <div class="modal-details-card">
                                <!-- Header Gradient -->
                                <div class="premium-modal-header"></div>

                                <div class="text-center">
                                    <div class="modal-profile-wrapper">
                                        <div class="avatar-circle avatar-size-100 d-inline-flex align-items-center justify-content-center text-white text-uppercase shadow-sm bg-indigo-alt">
                                            <i class="fas fa-briefcase font-40"></i>
                                        </div>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold">{!! $property_type->name !!}</h4>
                                    <span class="modal-role-badge">{!! __('property_types.property_type') !!}</span>
                                </div>

                                <!-- Detail Items List -->
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-fingerprint"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('general.system_id') !!}</span>
                                            <span class="detail-info-value text-muted"># {!! $property_type->id !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-briefcase"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('companies.company') !!}</span>
                                            <span class="detail-info-value text-muted small">
                                                @if($property_type->company_id)
                                                    <span class="badge badge-light-primary border-0">{!! optional($property_type->company)->name !!}</span>
                                                @else
                                                    <span class="badge badge-light-warning border-0">{!! __('roles.global_role') !!}</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-check-circle"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('property_types.status') !!}</span>
                                            <div class="detail-info-value mt-1">
                                                @if ($property_type->status == 1)
                                                    <span class="badge badge-success badge-glow badge-pill px-2">{!! __('general.enable') !!}</span>
                                                @else
                                                    <span class="badge badge-danger badge-glow badge-pill px-2">{!! __('general.disabled') !!}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-user-plus"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('property_types.created_by') !!}</span>
                                            <span class="detail-info-value">{!! $property_type->creator->name ?? '---' !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- Desktop ID Badge -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            {!! $loop->iteration + ($property_types->currentPage() - 1) * $property_types->perPage() !!}
                        </span>
                    </td>

                    <!-- Company -->
                    <td class="text-center align-middle">
                        @if($property_type->company_id)
                            <span class="font-weight-bold text-dark">
                                {!! optional($property_type->company)->name !!}
                            </span>
                        @else
                            <span class="text-warning font-weight-bold">
                                {!! __('roles.global_role') !!}
                            </span>
                        @endif
                    </td>

                    <!-- Name -->
                    <td class="align-middle property-info-td font-weight-bold text-primary">
                        <!-- Hidden Actions for Bottom Bar -->
                        <div class="row-actions-html d-none">
                            @include('dashboard.property_types.parts.actions')
                        </div>

                        <!-- Hidden Subtitle for Bottom Bar -->
                        <div class="row-subtitle-html d-none">
                            <span class="text-muted"><i class="fas fa-briefcase mr-25 opacity-5"></i> {!! optional($property_type->company)->name ?? __('roles.global_role') !!}</span>
                            <span class="text-muted mx-50">|</span>
                            <span class="text-muted"><i class="far fa-user mr-25 opacity-5"></i> {!! $property_type->creator->name ?? '---' !!}</span>
                        </div>

                        {!! $property_type->name !!}
                    </td>

                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-muted small">{!! $property_type->creator->name ?? '---' !!}</span>
                    </td>

                    <!-- Status -->
                    <td class="text-center align-middle">
                        @include('dashboard.property_types.parts.status')
                    </td>

                    <!-- Manage Status -->
                    @can('property_types_update')
                    <td class="text-center align-middle">
                        @include('dashboard.property_types.parts.manage_status')
                    </td>
                    @endcan

                    <!-- Actions Column Removed -->
                </tr>
            @empty
                <tr>
                    <td colspan="100%" class="text-center p-3 text-muted">
                        <i class="ft-info mr-1"></i> {!! __('property_types.no_property_types_found') !!}
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>
    <div class="float-right mt-2 custom-pagination">
        {!! $property_types->links() !!}
    </div>
</div>



