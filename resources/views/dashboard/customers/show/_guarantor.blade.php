<!-- Guarantor Tab -->
<div class="tab-pane fade" id="guarantors" role="tabpanel">
    <div class="row">
        @forelse($customer->guarantors as $guarantor)
        <div class="col-lg-6 col-12 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
                    <h6 class="card-title font-weight-bolder text-dark mb-0 d-flex align-items-center justify-content-start">
                        <i class="fas fa-user-shield text-info mr-1"></i>
                        <span>{!! __('guarantors.guarantor_details') !!}</span>
                    </h6>
                    @if($guarantor->pivot->is_primary)
                        <span class="badge badge-pill badge-light-primary">{!! __('customers.is_primary') !!}</span>
                    @endif
                </div>
                <div class="card-body p-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light-info p-3 rounded-circle mr-2">
                            <i class="fas fa-user font-large-1 text-info"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 font-weight-bold text-dark">{!! $guarantor->name !!}</h4>
                            <div class="d-flex align-items-center">
                                <span class="badge badge-pill badge-light-success mr-1">{{ $guarantor->pivot->guarantee_percentage }}%</span>
                                <small class="text-muted">{!! __('guarantors.guarantor') !!}</small>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6 mb-2">
                            <div class="info-row border-bottom pb-1">
                                <span class="text-muted d-block font-small-3">{!! __('guarantors.national_id') !!}</span>
                                <span class="text-dark font-weight-bold">{!! $guarantor->id_number !!}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="info-row border-bottom pb-1">
                                <span class="text-muted d-block font-small-3">{!! __('guarantors.phone') !!}</span>
                                <span class="text-dark font-weight-bold">{!! $guarantor->phone !!}</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="info-row @if($guarantor->pivot->notes) border-bottom pb-1 mb-2 @endif">
                                <span class="text-muted d-block font-small-3">{!! __('guarantors.address') !!}</span>
                                <span class="text-dark">{!! $guarantor->address ?: '---' !!}</span>
                            </div>
                        </div>
                        @if($guarantor->pivot->notes)
                        <div class="col-md-12">
                            <div class="info-row">
                                <span class="text-muted d-block font-small-3">{!! __('customers.notes') !!}</span>
                                <span class="text-dark small italic">{!! $guarantor->pivot->notes !!}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="card border-0 shadow-sm py-5" style="border-radius: 12px;">
                <i class="fas fa-user-slash font-large-1 text-muted d-block mb-2 opacity-50"></i>
                <span class="text-muted">{!! __('customers.no_guarantor') !!}</span>
            </div>
        </div>
        @endforelse
    </div>
</div>


