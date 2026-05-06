<!-- Maintenances Tab -->
<div class="tab-pane fade" id="maintenances" role="tabpanel">
    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-header bg-white border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
            <h6 class="card-title font-weight-bolder text-dark mb-0 d-flex align-items-center justify-content-start">
                <i class="fas fa-tools text-primary mr-1"></i>
                <span>{!! __('maintenances.maintenances') !!}</span>
            </h6>
            @can('maintenances_create')
            <a href="{!! route('dashboard.maintenances.index') !!}?property_id={!! $property->id !!}" class="text-primary font-weight-bolder hover-scale" style="text-decoration: none;">
                <i class="fas fa-plus-circle font-medium-3 ml-1"></i>
                <span>{!! __('maintenances.add_maintenance') !!}</span>
            </a>
            @endcan
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr class="text-muted" style="font-size: 14px;">
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">{!! __('maintenances.description') !!}</th>
                            <th class="border-top-0">{!! __('maintenances.date') !!}</th>
                            <th class="border-top-0">{!! __('maintenances.cost') !!}</th>
                            <th class="border-top-0 text-center">{!! __('general.status') !!}</th>
                            <th class="border-top-0 text-center">{!! __('general.actions') !!}</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px;">
                        @forelse($property->maintenances as $maintenance)
                        <tr>
                            <td class="py-2">#{!! $maintenance->id !!}</td>
                            <td class="py-2">
                                <div class="font-weight-bold">{!! Str::limit($maintenance->description, 50) !!}</div>
                            </td>
                            <td class="py-2">{!! $maintenance->date !!}</td>
                            <td class="py-2 font-weight-bold text-danger">{!! number_format($maintenance->cost, 2) !!}</td>
                            <td class="py-2 text-center">
                                @php
                                    $mStatusColor = 'info';
                                    if($maintenance->status == 'completed') $mStatusColor = 'success';
                                    if($maintenance->status == 'pending') $mStatusColor = 'warning';
                                @endphp
                                <span class="badge badge-light-{!! $mStatusColor !!} badge-pill border-0 px-2">
                                    {!! __('maintenances.status_' . $maintenance->status) ?? $maintenance->status !!}
                                </span>
                            </td>
                            <td class="py-2 text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{!! route('dashboard.maintenances.show', $maintenance->id) !!}" class="btn-premium-action btn-premium-action-info mr-1" title="{!! __('general.view') !!}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
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
