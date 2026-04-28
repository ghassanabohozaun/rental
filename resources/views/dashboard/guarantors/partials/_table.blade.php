<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th> <!-- For Details Control -->
                <th class="text-center align-middle py-3 border-top-0">{!! __('guarantors.name') !!}</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">{!! __('guarantors.phone') !!}</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">{!! __('guarantors.id_number') !!}</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">{!! __('companies.company') !!}</th>
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
                                            <i class="la la-user font-40"></i>
                                        </div>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold">{!! $guarantor->name !!}</h4>
                                    
                                    <div class="modal-member-since-box">
                                        <i class="la la-calendar small mr-1"></i>
                                        {!! __('general.created_at') !!}: {!! is_string($guarantor->created_at) ? $guarantor->created_at : $guarantor->created_at->format('Y-m-d') !!}
                                    </div>
                                </div>

                                <!-- Detail Items List -->
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-fingerprint"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('general.system_id') !!}</span>
                                            <span class="detail-info-value text-muted"># {!! $guarantor->id !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-phone"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('guarantors.phone') !!}</span>
                                            <span class="detail-info-value">{!! $guarantor->phone ?? '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-credit-card"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('guarantors.id_number') !!}</span>
                                            <span class="detail-info-value">{!! $guarantor->id_number ?? '---' !!}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-users"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('guarantors.relationship') !!}</span>
                                            <span class="detail-info-value">{!! $guarantor->relationship ?? '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-briefcase"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('companies.company') !!}</span>
                                            <span class="detail-info-value">{!! optional($guarantor->company)->name ?? __('general.all_companies') !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-check-circle"></i></div>
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
                                        <div class="icon-circle"><i class="la la-map-marker"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('guarantors.address') !!}</span>
                                            <span class="detail-info-value">{!! $guarantor->address ?? '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-user-plus"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('guarantors.created_by') !!}</span>
                                            <span class="detail-info-value">{!! optional($guarantor->creator)->name ?? '---' !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    
                    <td class="text-center align-middle">
                        <div class="user-info-cell">
                            <span class="user-name-text font-weight-bold">{!! $guarantor->name !!}</span>
                            @if($guarantor->relationship)
                                <span class="user-email-text">{!! $guarantor->relationship !!}</span>
                            @endif
                        </div>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-pill badge-glow bg-light-primary text-primary font-weight-bold px-3 py-1">
                            <i class="la la-phone"></i> {!! $guarantor->phone ?? '---' !!}
                        </span>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-dark font-weight-bold">
                            <i class="la la-credit-card text-muted mr-1"></i> {!! $guarantor->id_number ?? '---' !!}
                        </span>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <div class="company-chip">
                            <i class="la la-briefcase"></i>
                            <span>{!! optional($guarantor->company)->name ?? __('general.all_companies') !!}</span>
                        </div>
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
                            <div class="custom-control custom-switch custom-control-primary premium-switch-centered">
                                <input type="checkbox" class="custom-control-input change_status" id="customSwitch_{{ $guarantor->id }}" {{ $guarantor->status == 1 ? 'checked' : '' }} data-id="{{ $guarantor->id }}" />
                                <label class="custom-control-label" for="customSwitch_{{ $guarantor->id }}"></label>
                            </div>
                        </div>
                    </td>
                    @endcan

                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center align-items-center mb-0">
                            <div class="btn-group" role="group">
                                @can('guarantors_update')
                                    <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-edit js-edit-btn"
                                        title="{!! __('general.edit') !!}" 
                                        data-url="{!! route('dashboard.guarantors.update', $guarantor->id) !!}"
                                        data-id="{!! $guarantor->id !!}" 
                                        data-name_ar="{!! $guarantor->getTranslation('name', 'ar') !!}"
                                        data-name_en="{!! $guarantor->getTranslation('name', 'en') !!}" 
                                        data-phone="{!! $guarantor->phone !!}"
                                        data-id_number="{!! $guarantor->id_number !!}"
                                        data-address="{!! $guarantor->address !!}" 
                                        data-relationship="{!! $guarantor->relationship !!}"
                                        data-notes="{!! $guarantor->notes !!}" 
                                        data-company_id="{!! $guarantor->company_id !!}" 
                                        data-company="{!! optional($guarantor->company)->name !!}"
                                        data-toggle="modal" data-target="#editModal">
                                        <i class="la la-edit"></i>
                                    </a>
                                @endcan

                                @can('guarantors_delete')
                                    <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-danger delete-confirm"
                                        data-id="{!! $guarantor->id !!}" data-route="{!! route('dashboard.guarantors.destroy') !!}"
                                        data-title="{!! __('general.ask_delete_record') !!}" data-text="{!! __('general.delete_warning_text') !!}"
                                        data-confirm-btn="{!! __('general.yes') !!}" data-cancel-btn="{!! __('general.no') !!}"
                                        data-success-title="{!! __('general.deleted') !!}"
                                        data-success-text="{!! __('general.delete_success_message') !!}" title="{!! __('general.delete') !!}">
                                        <i class="la la-trash"></i>
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center p-3 text-muted">
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
