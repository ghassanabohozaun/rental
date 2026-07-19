<input type="hidden" id="templates-total-count" value="{!! $templates->total() !!}">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead>
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th> <!-- For Details Control -->
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">#</th>
                @if(auth()->user()->role_id == 1)
                    <th class="text-center align-middle py-3 border-top-0 d-none d-md-table-cell">{!! __('companies.company') !!}</th>
                @endif
                <th class="align-middle py-3 border-top-0">{!! __('contracts.clause_title') !!}</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('contracts.is_default_clause') !!}</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('contracts.order_num') !!}</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('contracts.status') !!}</th>
                <!-- Actions Column Removed for Bottom Action Bar -->
            </tr>
        </thead>
        <tbody>
            @forelse ($templates as $key => $template)
                <tr id="row{{ $template->id }}" class="premium-table-row pointer" data-row-title="بند #{!! $template->id !!} | {!! Str::limit($template->title, 30) !!}">
                    <!-- Mobile Details Control -->
                    <td class="text-center align-middle d-lg-none">
                        <span class="details-control pointer">
                            <i class="fas fa-plus-circle text-primary font-22"></i>
                        </span>

                        <!-- Hidden Actions for Bottom Bar -->
                        <div class="row-actions-html d-none">
                            @include('dashboard.contract_clause_templates.parts.actions', ['template' => $template])
                        </div>

                        <!-- Hidden Subtitle for Bottom Bar -->
                        <div class="row-subtitle-html d-none">
                            @if(auth()->user()->role_id == 1)
                                <span class="text-muted"><i class="far fa-building mr-25 opacity-5"></i> {!! optional($template->company)->name !!}</span>
                                <span class="text-muted mx-50">|</span>
                            @endif
                            <span class="text-muted"><i class="fas fa-sort-numeric-down mr-25 opacity-5"></i> {!! __('contracts.order_num') !!}: {!! $template->order_num !!}</span>
                            
                            @if($template->is_default)
                                <span class="text-muted mx-50">|</span>
                                <span class="text-success font-weight-bold"><i class="fas fa-check-circle mr-25"></i> {!! __('general.yes') !!}</span>
                            @endif
                            
                            <span class="text-muted mx-50">|</span>
                            @if($template->is_active)
                                <span class="text-success font-weight-bold"><i class="fas fa-circle mr-25 font-10"></i> {!! __('general.active') !!}</span>
                            @else
                                <span class="text-danger font-weight-bold"><i class="fas fa-circle mr-25 font-10"></i> {!! __('general.inactive') !!}</span>
                            @endif
                        </div>

                        <!-- Hidden Row Details for AJAX Modal -->
                        <div class="row-details d-none">
                            <div class="modal-details-card">
                                <!-- Header Gradient -->
                                <div class="premium-modal-header"></div>

                                <div class="text-center">
                                    <div class="modal-profile-wrapper">
                                        <div
                                            class="avatar-circle avatar-size-100 d-inline-flex align-items-center justify-content-center text-white text-uppercase shadow-sm bg-premium-gradient">
                                            <i class="fas fa-file-contract font-40"></i>
                                        </div>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold">{!! $template->title !!}</h4>
                                    <span class="modal-role-badge">
                                        {!! __('contracts.contract_clauses_library') !!}
                                    </span>
                                </div>

                                <!-- Detail Items List -->
                                <div class="modal-info-list mt-2">
                                    @if (auth()->user()->role_id == 1)
                                        <div class="detail-item-modern mt-1">
                                            <div class="icon-circle"><i class="fas fa-briefcase"></i></div>
                                            <div class="detail-info-box text-left">
                                                <span class="detail-info-label">{!! __('companies.company') !!}</span>
                                                <span class="detail-info-value">
                                                    <span
                                                        class="font-weight-bold text-dark">{!! optional($template->company)->name ?? __('general.all_companies') !!}</span>
                                                </span>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-align-justify"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('contracts.clause_title') !!}</span>
                                            <span class="detail-info-value text-muted">{!! nl2br(e($template->content)) !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-check-double"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('contracts.is_default_clause') !!}</span>
                                            <span class="detail-info-value">
                                                @if($template->is_default)
                                                    <span class="text-success font-weight-bold"><i class="fas fa-check mr-25 font-10"></i> {!! __('general.yes') !!}</span>
                                                @else
                                                    <span class="text-muted"><i class="fas fa-minus mr-25 font-10 opacity-5"></i> {!! __('general.no') !!}</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-sort-numeric-up"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('contracts.order_num') !!}</span>
                                            <span class="detail-info-value font-weight-bold text-dark">{!! $template->order_num !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-check-circle"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('contracts.status') !!}</span>
                                            <span class="detail-info-value">
                                                @if($template->status)
                                                    <span class="badge badge-pill badge-light-success border-0 px-2 py-1 shadow-none">{!! __('general.active') !!}</span>
                                                @else
                                                    <span class="badge badge-pill badge-light-danger border-0 px-2 py-1 shadow-none">{!! __('general.inactive') !!}</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- Desktop ID Badge -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            {!! $loop->iteration + ($templates->currentPage() - 1) * $templates->perPage() !!}
                        </span>
                    </td>
                    @if(auth()->user()->role_id == 1)
                    <td class="text-center align-middle d-none d-md-table-cell">
                        <span class="font-weight-bold text-dark">
                            {!! optional($template->company)->name ?? __('general.all_companies') !!}
                        </span>
                    </td>
                    @endif
                    <td class="align-middle py-3">
                        <span class="font-weight-bold font-15 mb-25 text-dark">
                            {!! $template->title !!}
                        </span>
                    </td>
                    <td class="text-center align-middle">
                        @if($template->is_default)
                            <span class="text-success font-weight-bold"><i class="fas fa-check mr-25 font-10"></i> {!! __('general.yes') !!}</span>
                        @else
                            <span class="text-muted"><i class="fas fa-minus mr-25 font-10 opacity-5"></i> {!! __('general.no') !!}</span>
                        @endif
                    </td>
                    <td class="text-center align-middle">
                        <span class="font-weight-bold font-15">{!! $template->order_num !!}</span>
                    </td>
                    <td class="text-center align-middle">
                        @if($template->status)
                            <span class="badge badge-pill badge-light-success border-0 px-2 py-1 font-weight-bold shadow-none"><i class="fas fa-circle mr-25 font-10"></i> {!! __('general.active') !!}</span>
                        @else
                            <span class="badge badge-pill badge-light-danger border-0 px-2 py-1 font-weight-bold shadow-none"><i class="fas fa-circle mr-25 font-10"></i> {!! __('general.inactive') !!}</span>
                        @endif
                    </td>
                    <!-- Actions Column Removed -->
                </tr>
            @empty
                <tr>
                    <td colspan="100%" class="text-center p-5 text-muted">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-info-circle mb-2" style="font-size: 50px; opacity: 0.2;"></i>
                            <span class="font-weight-bold font-15">{!! __('contracts.empty_library_message') !!}</span>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="float-right mt-2 custom-pagination">
        {!! $templates->links() !!}
    </div>
</div>

