<div class="d-flex justify-content-start w-100">
    <ul class="nav premium-nav-tabs" id="customerTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab">
                <i class="fas fa-info-circle"></i> {!! __('customers.personal_info') !!}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contracts-tab" data-toggle="tab" href="#contracts" role="tab">
                <i class="fas fa-file-contract"></i> {!! __('contracts.contracts') !!}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="guarantors-tab" data-toggle="tab" href="#guarantors" role="tab">
                <i class="fas fa-user-shield"></i> {!! __('customers.guarantors') !!}
                @if($customer->guarantors->count() > 0)
                <span class="badge badge-pill">{{ $customer->guarantors->count() }}</span>
                @endif
            </a>
        </li>
    </ul>
</div>


