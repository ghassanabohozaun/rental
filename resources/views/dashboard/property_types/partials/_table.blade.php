<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">#</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('property_types.name') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('companies.company') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('property_types.created_by') !!}</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('property_types.status') !!}</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('property_types.manage_status') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 min-w-140">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($property_types as $key=>$property_type)
                <tr id="row{{ $property_type->id }}">
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
                                        <div class="avatar-circle avatar-size-100 d-inline-flex align-items-center justify-content-center text-white text-uppercase shadow-sm bg-indigo-alt">
                                            <i class="la la-briefcase font-40"></i>
                                        </div>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold">{!! $property_type->name !!}</h4>
                                    <span class="modal-role-badge">{!! __('property_types.property_type') !!}</span>
                                </div>

                                <!-- Detail Items List -->
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-fingerprint"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('general.system_id') !!}</span>
                                            <span class="detail-info-value text-muted"># {!! $property_type->id !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-briefcase"></i></div>
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
                                        <div class="icon-circle"><i class="la la-check-circle"></i></div>
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
                                        <div class="icon-circle"><i class="la la-user-plus"></i></div>
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
                            {!! $loop->iteration !!}
                        </span>
                    </td>

                    <!-- Name -->
                    <td class="text-center align-middle font-weight-bold text-primary">{!! $property_type->name !!}</td>

                    <!-- Company -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        @if($property_type->company_id)
                            <span class="badge badge-light-primary border-0">
                                <i class="la la-briefcase mr-25"></i> {!! optional($property_type->company)->name !!}
                            </span>
                        @else
                            <span class="badge badge-light-warning border-0">
                                <i class="la la-globe mr-25"></i> {!! __('roles.global_role') !!}
                            </span>
                        @endif
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-muted small">{!! $property_type->creator->name ?? '---' !!}</span>
                    </td>

                    <!-- Status -->
                    <td class="text-center align-middle">
                        @include('dashboard.property_types.parts.status')
                    </td>

                    <!-- Manage Status -->
                    <td class="text-center align-middle">
                        @include('dashboard.property_types.parts.manage_status')
                    </td>

                    <!-- Actions -->
                    <td class="text-center align-middle">
                        @include('dashboard.property_types.parts.actions')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center p-3 text-muted">
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
