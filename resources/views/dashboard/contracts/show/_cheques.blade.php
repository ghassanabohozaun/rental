<div class="tab-pane fade" id="cheques" role="tabpanel">
    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-header bg-white border-bottom py-2 px-3 d-flex {{ request()->ajax() ? 'justify-content-end' : 'justify-content-between' }} align-items-center">
            @if(!request()->ajax())
            <h6 class="card-title font-weight-bolder text-dark mb-0 d-flex align-items-center justify-content-start">
                <i class="fas fa-money-check text-primary mr-1"></i>
                <span>{!! __('cheques.cheques') !!}</span>
            </h6>
            @endif
            @if(!request()->ajax())
                @can('cheques_create')
                <a href="{!! route('dashboard.cheques.create') !!}?contract_id={!! $contract->id !!}&is_deposit=0" class="text-warning font-weight-bolder hover-scale" style="text-decoration: none;">
                    <i class="fas fa-plus-circle font-medium-3 ml-1"></i>
                    <span>{!! __('cheques.add_cheque') !!}</span>
                </a>
                @endcan
            @endif
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr class="text-muted" style="font-size: 15px;">
                            <th class="border-top-0 py-2">{!! __('cheques.cheque_number') !!}</th>
                            <th class="border-top-0 py-2">{!! __('cheques.bank_name') !!}</th>
                            <th class="border-top-0 py-2">{!! __('cheques.amount') !!}</th>
                            <th class="border-top-0 py-2">{!! __('cheques.due_date') !!}</th>
                            <th class="border-top-0 py-2 text-center">{!! __('cheques.status') !!}</th>
                            <th class="border-top-0 py-2">{!! __('cheques.is_deposit') !!}</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 15px;">
                        @forelse($contract->cheques as $cheque)
                        <tr>
                            <td class="py-2 font-weight-bold">#{!! $cheque->cheque_number !!}</td>
                            <td class="py-2">{!! $cheque->bank_name !!}</td>
                            <td class="py-2 text-primary font-weight-bold">{!! number_format($cheque->amount, 2) !!} <small>{!! __('general.sar') !!}</small></td>
                            <td class="py-2">{!! $cheque->due_date ? $cheque->due_date->format('Y-m-d') : '---' !!}</td>
                            <td class="py-2 text-center">
                                <span class="badge badge-light-{{ $cheque->status_color }} badge-pill border-0 px-2 py-1">
                                    <i class="fas fa-circle font-small-1 mr-1"></i>
                                    {!! $cheque->status_label !!}
                                </span>
                            </td>
                            <td class="py-2">
                                @if($cheque->is_deposit)
                                    <span class="badge badge-light-warning badge-pill border-0 px-2 py-1">{!! __('cheques.insurance_cheques') !!}</span>
                                @else
                                    <span class="badge badge-light-primary badge-pill border-0 px-2 py-1">{!! __('cheques.rent_cheques') !!}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-money-check font-large-1 text-muted d-block mb-2 opacity-50"></i>
                                <span class="text-muted">{!! __('general.no_data_found') !!}</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
