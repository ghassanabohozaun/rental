<div class="tab-pane fade" id="owners" role="tabpanel" aria-labelledby="owners-tab">
    <div class="card premium-card border-0 shadow-sm radius-15 mb-2">
        <div class="card-header bg-transparent border-0 pt-0 pb-0 d-flex align-items-center justify-content-between" style="height: 50px;">
            <h5 class="card-title mb-0 font-weight-bold" style="font-size: 1.1rem !important;">
                <i class="fas fa-user-tie text-primary mr-1" style="font-size: 1.2rem !important;"></i> {!! __('owners.owners') !!}
            </h5>
            @can('properties_update')
            <a href="{!! route('dashboard.properties.edit', $property->id) !!}" class="btn btn-sm btn-light-primary radius-10">
                <i class="fas fa-edit mr-1"></i> {!! __('owners.manage_owners') !!}
            </a>
            @endcan
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 px-2">{!! __('owners.owner_name') !!}</th>
                            <th class="border-0">{!! __('owners.phone') !!}</th>
                            <th class="border-0 text-center">{!! __('owners.ownership_percentage') !!}</th>
                            <th class="border-0 text-center">{!! __('owners.is_primary') !!}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($property->owners as $owner)
                            <tr>
                                <td class="px-2 py-1">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-light-primary radius-10 mr-2" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-user text-primary" style="font-size: 14px;"></i>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold text-dark">{!! $owner->name !!}</div>
                                            <small class="text-muted">{!! $owner->email !!}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-1">
                                    <div class="text-dark font-weight-bold">{!! $owner->phone !!}</div>
                                </td>
                                <td class="py-1 text-center">
                                    <div class="progress progress-sm mb-0" style="height: 6px; width: 80px; margin: 0 auto;">
                                        <div class="progress-bar bg-primary" role="progressbar" 
                                             style="width: {{ $owner->pivot->ownership_percentage }}%" 
                                             aria-valuenow="{{ $owner->pivot->ownership_percentage }}" 
                                             aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <small class="font-weight-bold text-primary">{{ $owner->pivot->ownership_percentage }}%</small>
                                </td>
                                <td class="py-1 text-center">
                                    @if($owner->pivot->is_primary)
                                        <span class="badge badge-light-success" style="border-radius: 6px !important;">
                                            <i class="fas fa-star mr-1"></i> {!! __('general.yes') !!}
                                        </span>
                                    @else
                                        <span class="text-muted small">---</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center p-4">
                                    <div class="mb-2">
                                        <i class="fas fa-user-slash text-muted" style="font-size: 3rem; opacity: 0.3;"></i>
                                    </div>
                                    <p class="text-muted mb-0">{!! __('owners.no_owners_assigned') !!}</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
