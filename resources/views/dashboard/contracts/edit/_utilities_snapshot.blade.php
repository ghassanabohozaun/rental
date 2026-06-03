<div class="premium-mandatory-section mb-4">
    <div class="premium-mandatory-header">
        <div class="title-wrapper">
            <i class="fas fa-bolt"></i>
            <span class="font-weight-bold">{!! __('contracts.electricity_and_water_numbers') !!}</span>
        </div>
    </div>
    <div class="premium-mandatory-body">
        <p class="text-muted small mb-3">
            <i class="fas fa-info-circle mr-1"></i>
            {!! __('contracts.utilities_snapshot_hint') !!}
        </p>
        
        @php
            $utilities = old('contract_detail.utilities_data', $contract->contractDetail->utilities_data ?? []);
        @endphp

        @if(count($utilities) > 0)
            <div id="utilities-wrapper">
                @foreach($utilities as $index => $utility)
                <div class="row utility-row {{ !$loop->last ? 'border-bottom pb-3 mb-3' : '' }}">
                    <div class="col-md-3">
                        <div class="premium-form-group">
                            <label class="premium-label">{!! __('contracts.unit_name') !!}</label>
                            <input type="text" name="contract_detail[utilities_data][{!! $index !!}][name]" class="form-control premium-input shadow-none"
                                value="{!! $utility['name'] ?? '' !!}" readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="premium-form-group">
                            <label class="premium-label">{!! __('contracts.electricity') !!}</label>
                            <input type="text" name="contract_detail[utilities_data][{!! $index !!}][electricity_account_number]" class="form-control premium-input shadow-none"
                                value="{!! $utility['electricity_account_number'] ?? '' !!}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="premium-form-group">
                            <label class="premium-label">{!! __('contracts.water') !!}</label>
                            <input type="text" name="contract_detail[utilities_data][{!! $index !!}][water_account_number]" class="form-control premium-input shadow-none"
                                value="{!! $utility['water_account_number'] ?? '' !!}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="premium-form-group">
                            <label class="premium-label">{!! __('contracts.monthly_unit_rent') !!}</label>
                            <input type="number" name="contract_detail[utilities_data][{!! $index !!}][unit_rent_amount]" class="form-control premium-input shadow-none"
                                value="{!! $utility['unit_rent_amount'] ?? '' !!}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="premium-form-group">
                            <label class="premium-label">{!! __('contracts.unit_deposit') !!}</label>
                            <input type="number" name="contract_detail[utilities_data][{!! $index !!}][unit_deposit_amount]" class="form-control premium-input shadow-none"
                                value="{!! $utility['unit_deposit_amount'] ?? '' !!}">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-warning">{!! __('contracts.no_utilities_data') !!}</div>
        @endif
    </div>
</div>
