<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('customers.name_ar') !!}</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">{!! __('customers.phone') !!}</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">{!! __('customers.id_number') !!}</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">{!! __('customers.tenant_type') !!}</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">{!! __('companies.company') !!}</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">{!! __('customers.guarantor') !!}</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('customers.status') !!}</th>
                @can('customers_update')
                <th class="text-center align-middle py-3 border-top-0" style="min-width: 120px;">{!! __('general.status') !!}</th>
                @endcan
                <th class="text-center align-middle py-3 border-top-0" style="min-width: 150px;">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $key=>$customer)
                <tr id="row{{ $customer->id }}">
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
                                    <h4 class="modal-name-title font-weight-bold">{!! $customer->name !!}</h4>
                                    
                                    <div class="modal-member-since-box">
                                        <i class="la la-calendar small mr-1"></i>
                                        {!! __('general.created_at') !!}: {!! is_string($customer->created_at) ? $customer->created_at : $customer->created_at->format('Y-m-d') !!}
                                    </div>
                                </div>

                                <!-- Detail Items List -->
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-fingerprint"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('general.system_id') !!}</span>
                                            <span class="detail-info-value text-muted"># {!! $customer->id !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-phone"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('customers.phone') !!}</span>
                                            <span class="detail-info-value">{!! $customer->phone ?? '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-credit-card"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('customers.id_number') !!}</span>
                                            <span class="detail-info-value">{!! $customer->id_number ?? '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-at"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('customers.email') !!}</span>
                                            <span class="detail-info-value">{!! $customer->email ?? '---' !!}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-tags"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('customers.tenant_type') !!}</span>
                                            <span class="detail-info-value">{!! __('customers.' . $customer->tenant_type) !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-briefcase"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('companies.company') !!}</span>
                                            <span class="detail-info-value">{!! optional($customer->company)->name ?? __('general.all_companies') !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-check-circle"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('customers.status') !!}</span>
                                            <div class="detail-info-value mt-1">
                                                @if ($customer->status == 1)
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
                                            <span class="detail-info-label">{!! __('customers.address') !!}</span>
                                            <span class="detail-info-value">{!! $customer->address ?? '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-shield-alt"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('customers.guarantor') !!}</span>
                                            <span class="detail-info-value">{!! optional($customer->guarantor)->name ?? '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="la la-user-plus"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('customers.created_by') !!}</span>
                                            <span class="detail-info-value">{!! optional($customer->creator)->name ?? '---' !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    
                    <td class="text-center align-middle">
                        <div class="user-info-cell">
                            <span class="user-name-text font-weight-bold">{!! $customer->name !!}</span>
                            @if($customer->email)
                                <span class="user-email-text">{!! $customer->email !!}</span>
                            @endif
                        </div>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-pill badge-glow bg-light-primary text-primary font-weight-bold px-3 py-1">
                            <i class="la la-phone"></i> {!! $customer->phone ?? '---' !!}
                        </span>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-dark font-weight-bold">
                            <i class="la la-credit-card text-muted mr-1"></i> {!! $customer->id_number ?? '---' !!}
                        </span>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow">
                            {!! __('customers.' . $customer->tenant_type) !!}
                        </span>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <div class="company-chip">
                            <i class="la la-briefcase"></i>
                            <span>{!! optional($customer->company)->name ?? __('general.all_companies') !!}</span>
                        </div>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-dark font-weight-bold">
                            <i class="la la-shield-alt text-muted mr-1"></i> {!! optional($customer->guarantor)->name ?? '---' !!}
                        </span>
                    </td>
                    <td class="text-center align-middle">
                        <div class="badge badge-pill badge-glow customer_status_{!! $customer->id !!} {!! $customer->status == 1 ? 'badge-success' : 'badge-danger' !!}"
                            style="font-size: 12px; font-weight: bold; padding: 5px 12px;">
                            {!! $customer->status == 1 ? __('general.enable') : __('general.disabled') !!}
                        </div>
                    </td>
                    
                    @can('customers_update')
                    <td class="text-center align-middle">
                        <div class="premium-switch-centered-wrapper">
                            <div class="custom-control custom-switch custom-control-primary premium-switch-centered">
                                <input type="checkbox" class="custom-control-input change_status" id="customSwitch_{{ $customer->id }}" {{ $customer->status == 1 ? 'checked' : '' }} data-id="{{ $customer->id }}" />
                                <label class="custom-control-label" for="customSwitch_{{ $customer->id }}"></label>
                            </div>
                        </div>
                    </td>
                    @endcan

                    <td class="text-center align-middle">
                        @include('dashboard.customers.parts.actions')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center p-3 text-muted">
                        <i class="ft-info mr-1"></i> {!! __('customers.no_customers_found') !!}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="float-right mt-2 custom-pagination">
    {!! $customers->links() !!}
</div>
