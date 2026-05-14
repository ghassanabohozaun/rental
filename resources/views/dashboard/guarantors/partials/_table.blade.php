<input type="hidden" id="guarantors-total-count" value="{!! $guarantors->total() !!}">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th> <!-- For Details Control -->
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0" style="width: 50px;">#</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">{!! __('companies.company') !!}</th>
                <th class="align-middle py-3 border-top-0 property-info-td">{!! __('guarantors.name') !!}</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">{!! __('guarantors.phone') !!}</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">{!! __('guarantors.id_number') !!}</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('guarantors.status') !!}</th>
                @can('guarantors_update')
                <th class="text-center align-middle py-3 border-top-0" style="min-width: 120px;">{!! __('general.status') !!}</th>
                @endcan
                <th class="text-center align-middle py-3 border-top-0" style="min-width: 150px;">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($guarantors as $key=>$guarantor)
                <tr id="row{{ $guarantor->id }}">
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
                                    <h4 class="modal-name-title font-weight-bold">{!! $guarantor->name !!}</h4>
                                    
                                    <div class="modal-member-since-box">
                                        <i class="fas fa-calendar-alt small mr-1"></i>
                                        {!! __('general.created_at') !!}: {!! is_string($guarantor->created_at) ? $guarantor->created_at : $guarantor->created_at->format('Y-m-d') !!}
                                    </div>
                                </div>

                                <!-- Detail Items List -->
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-fingerprint"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('general.system_id') !!}</span>
                                            <span class="detail-info-value text-muted"># {!! $guarantor->id !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-phone"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('guarantors.phone') !!}</span>
                                            <span class="detail-info-value">{!! $guarantor->phone ?? '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-credit-card"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('guarantors.id_number') !!}</span>
                                            <span class="detail-info-value">{!! $guarantor->id_number ?? '---' !!}</span>
                                        </div>
                                    </div>
                                    

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-briefcase"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('companies.company') !!}</span>
                                            <span class="detail-info-value">{!! optional($guarantor->company)->name ?? __('general.all_companies') !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-check-circle"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('guarantors.status') !!}</span>
                                            <div class="detail-info-value mt-1">
                                                @if ($guarantor->status == 1)
                                                    <span class="badge badge-success badge-glow badge-pill px-2">{!! __('general.enable') !!}</span>
                                                @else
                                                    <span class="badge badge-danger badge-glow badge-pill px-2">{!! __('general.disabled') !!}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-map-marker"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('guarantors.address') !!}</span>
                                            <span class="detail-info-value">{!! $guarantor->address ?? '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-user-plus"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('guarantors.created_by') !!}</span>
                                            <span class="detail-info-value">{!! optional($guarantor->creator)->name ?? '---' !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    
                    <!-- ID -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            {!! $loop->iteration + ($guarantors->currentPage() - 1) * $guarantors->perPage() !!}
                        </span>
                    </td>

                    <!-- Company -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <div class="company-chip">
                            <i class="fas fa-briefcase"></i>
                            <span>{!! optional($guarantor->company)->name ?? __('general.all_companies') !!}</span>
                        </div>
                    </td>

                    <!-- Name -->
                    <td class="align-middle property-info-td">
                        <div class="user-info-cell">
                            <span class="user-name-text font-weight-bold">{!! $guarantor->name !!}</span>
                        </div>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-pill badge-glow bg-light-primary text-primary font-weight-bold px-3 py-1">
                            <i class="fas fa-phone"></i> {!! $guarantor->phone ?? '---' !!}
                        </span>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-dark font-weight-bold">
                            <i class="fas fa-credit-card text-muted mr-1"></i> {!! $guarantor->id_number ?? '---' !!}
                        </span>
                    </td>

                    <td class="text-center align-middle">
                        <div class="badge badge-pill badge-glow guarantor_status_{!! $guarantor->id !!} {!! $guarantor->status == 1 ? 'badge-success' : 'badge-danger' !!}"
                            style="font-size: 12px; font-weight: bold; padding: 5px 12px;">
                            {!! $guarantor->status == 1 ? __('general.enable') : __('general.disabled') !!}
                        </div>
                    </td>
                    
                    @can('guarantors_update')
                        <td class="text-center align-middle">
                            <div class="premium-switch-centered-wrapper">
                                <label class="modern-switch">
                                    <input type="checkbox" class="change_status" id="customSwitch_{{ $guarantor->id }}" {{ $guarantor->status == 1 ? 'checked' : '' }} data-id="{{ $guarantor->id }}" />
                                    <span class="modern-slider"></span>
                                </label>
                            </div>
                        </td>
                    @endcan

                    <td class="text-center align-middle">
                        @include('dashboard.guarantors.parts.actions')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center p-3 text-muted">
                        <i class="ft-info mr-1"></i> {!! __('guarantors.no_guarantors_found') !!}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="float-right mt-2 custom-pagination">
    {!! $guarantors->links() !!}
</div>


