<div class="d-flex justify-content-start w-100">
    <ul class="nav premium-nav-tabs" id="propertyTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab">
                <i class="fas fa-info-circle"></i> {!! __('properties.property_details') !!}
            </a>
        </li>
        @if($property->units->count() > 0)
        <li class="nav-item">
            <a class="nav-link" id="units-tab" data-toggle="tab" href="#units" role="tab">
                <i class="fas fa-th-large"></i> {!! __('properties.sub_units') !!}
                <span class="badge badge-pill">{{ $property->units->count() }}</span>
            </a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" id="owners-tab" data-toggle="tab" href="#owners" role="tab" data-text="{!! __('owners.owners') !!}">
                <i class="fas fa-user-tie"></i> {!! __('owners.owners') !!}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contracts-tab" data-toggle="tab" href="#contracts" role="tab" data-text="{!! __('contracts.contracts') !!}">
                <i class="fas fa-file-contract"></i> {!! __('contracts.contracts') !!}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="maintenances-tab" data-toggle="tab" href="#maintenances" role="tab">
                <i class="fas fa-tools"></i> {!! __('maintenances.maintenances') !!}
            </a>
        </li>
    </ul>
</div>


