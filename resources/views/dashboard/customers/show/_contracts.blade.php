<!-- Contracts Tab -->
<div class="tab-pane fade" id="contracts" role="tabpanel">
    <div class="card border-0 shadow-sm mb-2 radius-15">
        <div class="card-header bg-transparent border-0 pt-2 pb-0">
            <h5 class="card-title font-weight-bold mb-0">
                <i class="fas fa-file-contract text-primary mr-1"></i> {!! __('contracts.contracts') !!}
            </h5>
        </div>
        <div class="card-body p-0 mt-2">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light-primary-opacity">
                        <tr class="text-muted" style="font-size: 13px;">
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">{!! __('properties.property') !!}</th>
                            <th class="border-top-0">{!! __('contracts.start_date') !!}</th>
                            <th class="border-top-0">{!! __('contracts.end_date') !!}</th>
                            <th class="border-top-0">{!! __('contracts.rent_amount') !!}</th>
                            <th class="border-top-0 text-center">{!! __('general.status') !!}</th>
                            <th class="border-top-0 text-center">{!! __('general.actions') !!}</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px;">
                        @forelse($customer->contracts as $contract)
                        <tr>
                            <td class="py-2">#{!! $contract->id !!}</td>
                            <td class="py-2">
                                <div class="font-weight-bold text-dark">{!! optional($contract->property)->name !!}</div>
                                <small class="text-muted">{!! optional($contract->property->propertyType)->name !!}</small>
                            </td>
                            <td class="py-2 text-dark font-weight-bold">{!! $contract->start_date->format('Y-m-d') !!}</td>
                            <td class="py-2 text-dark font-weight-bold">{!! $contract->end_date->format('Y-m-d') !!}</td>
                            <td class="py-2 font-weight-bold text-success">{!! number_format($contract->rent_amount, 2) !!}</td>
                            <td class="py-2 text-center">
                                @php
                                    $cStatusColor = 'success';
                                    if($contract->status == 'ended') $cStatusColor = 'warning';
                                    if($contract->status == 'cancelled') $cStatusColor = 'danger';
                                @endphp
                                <span class="badge badge-light-{!! $cStatusColor !!}-opacity text-{!! $cStatusColor !!} badge-pill border-0 px-2 font-weight-bold">
                                    {!! __('contracts.status_' . $contract->status) !!}
                                </span>
                            </td>
                            <td class="py-2 text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{!! route('dashboard.contracts.show', $contract->id) !!}" class="btn-premium-action btn-premium-action-info mr-1" title="{!! __('general.view') !!}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-success mr-1 btn-show-payments" data-id="{!! $contract->id !!}" title="{!! __('payments.payments') !!}">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-warning btn-show-cheques" data-id="{!! $contract->id !!}" title="{!! __('cheques.cheques') !!}">
                                        <i class="fas fa-money-check-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open font-large-2 d-block mb-1"></i>
                                {!! __('general.no_data_found') !!}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


