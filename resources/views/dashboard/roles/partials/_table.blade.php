<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th> <!-- For Details Control -->
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">#</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('roles.role_name') !!}</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('companies.company') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('roles.created_by') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('roles.description') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 min-w-140">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $key=>$role)
                <tr id="row{{ $role->id }}">
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
                                            <i class="la la-shield font-40"></i>
                                        </div>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold">{!! $role->name !!}</h4>
                                    <span class="modal-role-badge">{!! __('roles.role') !!}</span>
                                </div>

                                <!-- Detail Items List -->
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-fingerprint"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('general.system_id') !!}</span>
                                            <span class="detail-info-value text-muted"># {!! $role->id !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="la la-briefcase"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('companies.company') !!}</span>
                                            <span class="detail-info-value">
                                                @if($role->company_id)
                                                    <span class="badge badge-light-primary border-0">{!! optional($role->company)->name !!}</span>
                                                @else
                                                    <span class="badge badge-light-warning border-0">{!! __('roles.global_role') !!}</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="la la-info-circle"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('roles.description') !!}</span>
                                            <span class="detail-info-value text-muted small">{!! $role->description ?? '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="la la-user-plus"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('roles.created_by') !!}</span>
                                            <span class="detail-info-value">{!! $role->creator->name ?? '---' !!}</span>
                                        </div>
                                    </div>
                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="la la-calendar"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('general.created_at') !!}</span>
                                            <span class="detail-info-value text-muted">{!! $role->created_at->format('Y-m-d') !!}</span>
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
                            <i class="la la-shield mr-1 d-none d-md-inline"></i>
                            {!! $role->name !!}
                        </div>
                    </td>

                    <!-- Company -->
                    <td class="text-center align-middle">
                        @if($role->company_id)
                            <span class="badge badge-light-primary border-0">
                                <i class="la la-briefcase mr-25"></i> {!! optional($role->company)->name !!}
                            </span>
                        @else
                            <span class="badge badge-light-warning border-0">
                                <i class="la la-globe mr-25"></i> {!! __('roles.global_role') !!}
                            </span>
                        @endif
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-muted small">{!! $role->creator->name ?? '---' !!}</span>
                    </td>

                    <!-- Description (Desktop Only) -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        @if($role->description)
                            <span class="text-muted small">{!! Str::limit($role->description, 30) !!}</span>
                        @else
                            <span class="text-muted small">---</span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="text-center align-middle">
                        @include('dashboard.roles.parts.actions')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center p-3 text-muted">
                        <i class="ft-info mr-1"></i> {!! __('roles.no_roles_found') !!}
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>
    <div class="float-right mt-2 custom-pagination">
        {!! $roles->links() !!}
    </div>
</div>
