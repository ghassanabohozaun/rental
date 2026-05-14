<input type="hidden" id="owners-total-count" value="{!! $owners->total() !!}">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th> <!-- For Details Control -->
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0" style="width: 50px;">#</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('companies.company') !!}</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">{!! __('owners.type') !!}</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">{!! __('owners.identification_number') !!}</th>
                <th class="align-middle py-3 border-top-0 property-info-td">{!! __('owners.name') !!}</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">{!! __('owners.phone') !!}</th>
                <th class="text-center align-middle py-3 border-top-0" style="min-width: 150px;">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($owners as $key=>$owner)
                <tr id="row{{ $owner->id }}">
                    <td class="text-center d-lg-none align-middle">
                        <span class="details-control pointer">
                            <i class="fas fa-plus-circle text-primary" style="font-size: 22px;"></i>
                        </span>
                        <!-- Hidden Row Details -->
                        <div class="row-details d-none">
                            <div class="modal-details-card">
                                <!-- Header Gradient -->
                                <div class="premium-modal-header"></div>

                                <div class="text-center">
                                    <div class="modal-profile-wrapper">
                                        <div class="avatar-circle avatar-size-100 d-inline-flex align-items-center justify-content-center text-white text-uppercase shadow-sm bg-indigo-alt">
                                            <i class="fas fa-user font-40"></i>
                                        </div>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold">{!! $owner->name !!}</h4>
                                    
                                    <div class="modal-member-since-box">
                                        <i class="fas fa-calendar-alt small mr-1"></i>
                                        {!! __('general.created_at') !!}: {!! is_string($owner->created_at) ? $owner->created_at : $owner->created_at->format('Y-m-d') !!}
                                    </div>
                                </div>

                                <!-- Detail Items List -->
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-fingerprint"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('general.system_id') !!}</span>
                                            <span class="detail-info-value text-muted"># {!! $owner->id !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-phone"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('owners.phone') !!}</span>
                                            <span class="detail-info-value">{!! $owner->phone ?? '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-id-card"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('owners.identification_number') !!}</span>
                                            <span class="detail-info-value">{!! $owner->identification_number ?? '---' !!}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-tags"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('owners.type') !!}</span>
                                            <span class="detail-info-value">{!! isset($owner->type) ? __('owners.owner_types.' . $owner->type) : '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-briefcase"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('companies.company') !!}</span>
                                            <span class="detail-info-value">{!! optional($owner->company)->name ?? __('general.all_companies') !!}</span>
                                        </div>
                                    </div>

                                    
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-map-marker-alt"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('owners.address') !!}</span>
                                            <span class="detail-info-value">{!! $owner->address ?? '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-user-plus"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('owners.created_by') !!}</span>
                                            <span class="detail-info-value">{!! optional($owner->creator)->name ?? '---' !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    
                    <!-- ID -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            {!! $loop->iteration + ($owners->currentPage() - 1) * $owners->perPage() !!}
                        </span>
                    </td>

                    <!-- Company -->
                    <td class="text-center align-middle">
                        <a href="javascript:void(0)" class="company-chip">
                            <i class="fas fa-briefcase mr-1"></i>
                            {!! optional($owner->company)->name ?? __('general.all_companies') !!}
                        </a>
                    </td>

                    <!-- Type -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-pill bg-light-info text-info font-weight-bold px-3 py-1">
                            <i class="fas fa-tag mr-1"></i> {!! isset($owner->type) ? __('owners.owner_types.' . $owner->type) : '---' !!}
                        </span>
                    </td>

                    <!-- ID Number -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-dark font-weight-bold">
                            <i class="fas fa-id-card text-muted mr-1"></i> {!! $owner->identification_number ?? '---' !!}
                        </span>
                    </td>

                    <!-- Name -->
                    <td class="align-middle property-info-td">
                        <div class="user-info-cell">
                            <span class="user-name-text font-weight-bold">{!! $owner->name !!}</span>
                            <span class="user-email-text">{!! $owner->email ?? '---' !!}</span>
                        </div>
                    </td>

                    <!-- Phone -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-pill badge-glow bg-light-primary text-primary font-weight-bold px-3 py-1">
                            <i class="fas fa-phone"></i> {!! $owner->phone ?? '---' !!}
                        </span>
                    </td>

                    <td class="text-center align-middle">
                        @include('dashboard.owners.parts.actions')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center p-3 text-muted">
                        <i class="fas fa-info-circle mr-1"></i> {!! __('owners.no_owners_found') !!}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="float-right mt-2 custom-pagination">
    {!! $owners->links() !!}
</div>


