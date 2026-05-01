<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('maintenances.property') !!}</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">{!! __('maintenances.date') !!}</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">{!! __('maintenances.cost') !!}</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">{!! __('companies.company') !!}</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('maintenances.status') !!}</th>
                <th class="text-center align-middle py-3 border-top-0" style="min-width: 150px;">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($maintenances as $key=>$maintenance)
                <tr id="row{{ $maintenance->id }}">
                    <td class="text-center d-lg-none align-middle">
                        <span class="details-control pointer">
                            <i class="la la-plus-circle text-primary" style="font-size: 22px;"></i>
                        </span>
                        <!-- Hidden Row Details -->
                        <div class="row-details d-none">
                            <div class="modal-details-card">
                                <!-- Header Gradient -->
                                <div class="premium-modal-header"></div>

                                <div class="text-center">
                                    <div class="modal-profile-wrapper">
                                        <div class="avatar-circle avatar-size-100 d-inline-flex align-items-center justify-content-center text-white text-uppercase shadow-sm bg-indigo-alt">
                                            <i class="la la-tools font-40"></i>
                                        </div>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold">{!! optional($maintenance->property)->name !!}</h4>
                                    
                                    <div class="modal-member-since-box">
                                        <i class="la la-calendar small mr-1"></i>
                                        {!! __('general.created_at') !!}: {!! is_string($maintenance->created_at) ? $maintenance->created_at : $maintenance->created_at->format('Y-m-d') !!}
                                    </div>
                                </div>

                                <!-- Detail Items List -->
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-fingerprint"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('general.system_id') !!}</span>
                                            <span class="detail-info-value text-muted"># {!! $maintenance->id !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-building"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('maintenances.property') !!}</span>
                                            <span class="detail-info-value">{!! optional($maintenance->property)->name ?? '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-calendar"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('maintenances.date') !!}</span>
                                            <span class="detail-info-value">{!! $maintenance->date ?? '---' !!}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-money"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('maintenances.cost') !!}</span>
                                            <span class="detail-info-value">{!! $maintenance->cost ?? '0.00' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-briefcase"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('companies.company') !!}</span>
                                            <span class="detail-info-value">{!! optional($maintenance->company)->name ?? __('general.all_companies') !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-check-circle"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('maintenances.status') !!}</span>
                                            <div class="detail-info-value mt-1">
                                                @php
                                                    $statusClass = 'badge-warning';
                                                    $statusText = __('maintenances.pending');
                                                    if ($maintenance->status == 'in_progress') {
                                                        $statusClass = 'badge-primary';
                                                        $statusText = __('maintenances.in_progress');
                                                    } elseif ($maintenance->status == 'done') {
                                                        $statusClass = 'badge-success';
                                                        $statusText = __('maintenances.done');
                                                    }
                                                @endphp
                                                <span class="badge badge-glow badge-pill px-2 {{ $statusClass }}">{{ $statusText }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-user-plus"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('general.created_by') !!}</span>
                                            <span class="detail-info-value">{!! optional($maintenance->creator)->name ?? '---' !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    
                    <td class="text-center align-middle">
                        <div class="user-info-cell">
                            <span class="user-name-text font-weight-bold">{!! optional($maintenance->property)->name !!}</span>
                        </div>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-pill badge-glow bg-light-primary text-primary font-weight-bold px-3 py-1">
                            <i class="la la-calendar"></i> {!! $maintenance->date ?? '---' !!}
                        </span>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-dark font-weight-bold">
                            <i class="la la-money text-muted mr-1"></i> {!! $maintenance->cost ?? '0.00' !!}
                        </span>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <div class="company-chip">
                            <i class="la la-briefcase"></i>
                            <span>{!! optional($maintenance->company)->name ?? __('general.all_companies') !!}</span>
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        @php
                            $statusClass = 'badge-warning';
                            $statusText = __('maintenances.pending');
                            if ($maintenance->status == 'in_progress') {
                                $statusClass = 'badge-primary';
                                $statusText = __('maintenances.in_progress');
                            } elseif ($maintenance->status == 'done') {
                                $statusClass = 'badge-success';
                                $statusText = __('maintenances.done');
                            }
                        @endphp
                        <div class="badge badge-pill badge-glow maintenance_status_{!! $maintenance->id !!} {{ $statusClass }}"
                            style="font-size: 12px; font-weight: bold; padding: 5px 12px;">
                            {{ $statusText }}
                        </div>
                    </td>
                    
                    <td class="text-center align-middle">
                        @include('dashboard.maintenances.parts.actions')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center p-3 text-muted">
                        <i class="ft-info mr-1"></i> {!! __('maintenances.no_maintenances_found') !!}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="float-right mt-2 custom-pagination">
    {!! $maintenances->links() !!}
</div>
