<!-- Units Tab -->
<div class="tab-pane fade" id="units" role="tabpanel">
    <div class="card border-0 shadow-sm radius-15">
        <div class="card-header bg-transparent border-0 pt-0 pb-0 d-flex align-items-center" style="height: 50px;">
            <h5 class="card-title font-weight-bold mb-0" style="font-size: 1.1rem !important;">
                <i class="fas fa-th-large text-primary mr-1" style="font-size: 1.2rem !important;"></i> {!! __('properties.sub_units') !!}
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive" @if($property->units->count() > 15) style="max-height: 650px; overflow-y: auto;" @endif>
                <table class="table table-hover mb-0">
                    <thead class="bg-light" @if($property->units->count() > 15) style="position: sticky; top: 0; z-index: 2; background: #f8f9fa;" @endif>
                        <tr class="text-muted" style="font-size: 14px;">
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">{!! __('properties.property') !!}</th>
                            <th class="border-top-0 text-center">{!! __('properties.type') !!}</th>
                            <th class="border-top-0 text-center">{!! __('properties.area') !!}</th>
                            <th class="border-top-0 text-center">{!! __('properties.price') !!}</th>
                            <th class="border-top-0 text-center">{!! __('properties.status') !!}</th>
                            <th class="border-top-0 text-center">{!! __('general.actions') !!}</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px;">
                        @forelse($property->units as $unit)
                        <tr>
                            <td class="py-2 align-middle">#{!! $loop->iteration !!}</td>
                            <td class="py-2 align-middle">
                                <div class="font-weight-bold">{!! $unit->name !!}</div>
                                <small class="text-muted">{!! $unit->property_number !!}</small>
                            </td>
                            <td class="py-2 align-middle text-center">
                                @if($unit->propertyType)
                                    <span class="badge badge-pill border-0 px-2" style="background-color: #6366f115; color: #6366f1;">
                                        {!! $unit->propertyType->name !!}
                                    </span>
                                @else
                                    <span class="text-muted">---</span>
                                @endif
                            </td>
                            <td class="py-2 align-middle text-center">
                                {!! $unit->area ?? '---' !!}
                            </td>
                            <td class="py-2 align-middle text-center font-weight-bold text-success">
                                {!! number_format($unit->price, 2) !!}
                            </td>
                            <td class="py-2 align-middle text-center">
                                @if($unit->propertyStatus)
                                    <span class="badge badge-pill border-0 px-2" style="background-color: {!! $unit->propertyStatus->color !!}15; color: {!! $unit->propertyStatus->color !!};">
                                        <i class="fas fa-circle font-8 mr-25"></i>
                                        {!! $unit->propertyStatus->name !!}
                                    </span>
                                @else
                                    <span class="text-muted">---</span>
                                @endif
                            </td>
                            <td class="py-2 align-middle text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{!! route('dashboard.properties.show', $unit->id) !!}" class="btn-premium-action btn-premium-action-info mr-1" title="{!! __('general.view') !!}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @can('properties_update')
                                    <a href="{!! route('dashboard.properties.edit', $unit->id) !!}" class="btn-premium-action btn-premium-action-success" title="{!! __('general.edit') !!}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
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


