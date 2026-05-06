<!-- Stats Overview -->
<div class="row">
    <div class="col-lg-3 col-md-6 col-12">
        <div class="card border-0 shadow-sm overflow-hidden h-100" style="border-radius: 15px;">
            <div class="card-body p-2 d-flex align-items-center">
                <div class="bg-light-primary p-2 rounded mr-2">
                    <i class="fas fa-file-contract text-primary font-large-1"></i>
                </div>
                <div>
                    <h4 class="font-weight-bolder mb-0 text-dark">{!! $customer->contracts->count() !!}</h4>
                    <p class="card-text text-muted font-small-3 mb-0">{!! __('contracts.contracts') !!}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
        <div class="card border-0 shadow-sm overflow-hidden h-100" style="border-radius: 15px;">
            <div class="card-body p-2 d-flex align-items-center">
                <div class="bg-light-success p-2 rounded mr-2">
                    <i class="fas fa-wallet text-success font-large-1"></i>
                </div>
                <div>
                    <h4 class="font-weight-bolder mb-0 text-success">
                        {!! number_format($customer->contracts->sum('paid_amount'), 2) !!}
                    </h4>
                    <p class="card-text text-muted font-small-3 mb-0">{!! __('payments.paid_amount') !!}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
        <div class="card border-0 shadow-sm overflow-hidden h-100" style="border-radius: 15px;">
            <div class="card-body p-2 d-flex align-items-center">
                <div class="bg-light-warning p-2 rounded mr-2">
                    <i class="fas fa-clock text-warning font-large-1"></i>
                </div>
                <div>
                    <h4 class="font-weight-bolder mb-0 text-warning">
                        {!! number_format($customer->contracts->sum('remaining_amount'), 2) !!}
                    </h4>
                    <p class="card-text text-muted font-small-3 mb-0">{!! __('payments.remaining_amount') !!}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
        <div class="card border-0 shadow-sm overflow-hidden h-100" style="border-radius: 15px;">
            <div class="card-body p-2 d-flex align-items-center">
                <div class="bg-light-info p-2 rounded mr-2">
                    <i class="fas fa-users text-info font-large-1"></i>
                </div>
                <div>
                    <h4 class="font-weight-bolder mb-0 text-info">{!! $customer->guarantor_id ? 1 : 0 !!}</h4>
                    <p class="card-text text-muted font-small-3 mb-0">{!! __('guarantors.guarantor') !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
