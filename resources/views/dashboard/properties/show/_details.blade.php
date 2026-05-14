<div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
    <div class="row">
        <!-- 1. Basic Information Section (Expanded Grid) -->
        <div class="col-md-12">
            <div class="card border-0 shadow-sm mb-2 radius-15">
                <div class="card-header bg-transparent border-0 pt-0 pb-0 d-flex align-items-center" style="height: 50px;">
                    <h5 class="card-title font-weight-bold mb-0" style="font-size: 1.1rem !important;">
                        <i class="fas fa-info-circle text-primary mr-1" style="font-size: 1.2rem !important;"></i> {!! __('properties.basic_information') !!}
                    </h5>
                </div>
                <div class="card-body pt-3 pb-3">
                    <div class="row">
                        <!-- Property Name -->
                        <div class="col-md-4 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-primary-opacity">
                                    <i class="fas fa-signature text-primary"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('properties.property_name') !!}</label>
                                    <span class="data-grid-value">{!! $property->name !!}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Property Number -->
                        <div class="col-md-4 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-info-opacity">
                                    <i class="fas fa-hashtag text-info"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('properties.property_number') !!}</label>
                                    <span class="data-grid-value">{!! $property->property_number !!}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Property Type -->
                        <div class="col-md-4 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-warning-opacity">
                                    <i class="fas fa-th-large text-warning"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('properties.property_type') !!}</label>
                                    <span class="data-grid-value">{!! $property->propertyType->name !!}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="col-md-4 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-danger-opacity">
                                    <i class="fas fa-map-marker-alt text-danger"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('properties.location') !!}</label>
                                    <span class="data-grid-value">{!! $property->location !!}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Area -->
                        <div class="col-md-4 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-success-opacity">
                                    <i class="fas fa-expand-arrows-alt text-success"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('properties.area') !!}</label>
                                    <span class="data-grid-value">{!! $property->area !!} {!! __('properties.sq_m') ?? 'm²' !!}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="col-md-4 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-primary-opacity">
                                    <i class="fas fa-tag text-primary"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('properties.price') !!}</label>
                                    <span class="data-grid-value text-primary font-weight-bolder">{!! number_format($property->price, 0) !!} {!! __('general.currency') !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Legal & Utility Info (Expanded Grid) -->
        <div class="col-md-12 mt-1">
            <div class="card border-0 shadow-sm mb-2 radius-15">
                <div class="card-header bg-transparent border-0 pt-0 pb-0 d-flex align-items-center" style="height: 50px;">
                    <h5 class="card-title font-weight-bold mb-0" style="font-size: 1.1rem !important;">
                        <i class="fas fa-file-invoice text-primary mr-1" style="font-size: 1.2rem !important;"></i> {!! __('properties.legal_utility_info') !!}
                    </h5>
                </div>
                <div class="card-body pt-3 pb-3">
                    <div class="row">
                        <!-- File Number -->
                        <div class="col-md-3 mb-3">
                            <div class="data-grid-item border-left-primary-3">
                                <div class="data-grid-icon bg-light-primary-opacity">
                                    <i class="fas fa-folder-open text-primary"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('properties.file_number') !!}</label>
                                    <span class="data-grid-value text-primary">{!! $property->file_number ?? '---' !!}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Title Deed -->
                        <div class="col-md-3 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-dark-opacity">
                                    <i class="fas fa-scroll text-dark"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('properties.title_deed_number') !!}</label>
                                    <span class="data-grid-value">{!! $property->title_deed_number ?? '---' !!}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Electricity -->
                        <div class="col-md-3 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-warning-opacity">
                                    <i class="fas fa-bolt text-warning"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('properties.electricity_account_number') !!}</label>
                                    <span class="data-grid-value">{!! $property->electricity_account_number ?? '---' !!}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Water -->
                        <div class="col-md-3 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-info-opacity">
                                    <i class="fas fa-tint text-info"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('properties.water_account_number') !!}</label>
                                    <span class="data-grid-value">{!! $property->water_account_number ?? '---' !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description/Notes -->
                    <div class="col-12 mt-1">
                        <div class="notes-area-premium p-2 rounded bg-light-blue-info border-dashed-premium">
                            <h6 class="font-weight-bold text-muted mb-1 font-small-3">
                                <i class="fas fa-align-left mr-1"></i> {!! __('properties.description') !!}
                            </h6>
                            <p class="text-muted small mb-0">
                                {!! $property->description ?: __('general.no_description') !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Attachments Section -->
        <div class="col-12 mt-1">
            <div class="card border-0 shadow-sm mb-2 radius-15">
                <div class="card-header bg-transparent border-0 pt-0 pb-0 d-flex align-items-center" style="height: 50px;">
                    <h5 class="card-title font-weight-bold mb-0" style="font-size: 1.1rem !important;">
                        <i class="fas fa-paperclip text-warning mr-1" style="font-size: 1.2rem !important;"></i> {!! __('properties.attachments') !!}
                    </h5>
                </div>
                <div class="card-body pt-3 pb-3">
                    <div class="row">
                        @php
                            $attachments = [
                                'rental_contract_original' => ['icon' => 'fa-file-contract', 'color' => 'primary'],
                                'building_completion_certificate' => ['icon' => 'fa-file-pdf', 'color' => 'danger'],
                                'other_documents' => ['icon' => 'fa-file-alt', 'color' => 'info'],
                            ];
                        @endphp

                        @foreach($attachments as $field => $info)
                            <div class="col-md-4 mb-3">
                                <div class="premium-attachment-box d-flex align-items-center p-2 rounded border-light bg-white shadow-xs">
                                    <div class="icon-wrapper mr-2 bg-light-{!! $info['color'] !!}-opacity p-1 radius-10">
                                        <i class="fas {!! $info['icon'] !!} text-{!! $info['color'] !!} font-20"></i>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h6 class="mb-0 font-weight-bold text-truncate attachment-title-mini">{!! __('properties.'.$field) !!}</h6>
                                        @if($property->$field)
                                            <a href="{!! asset('uploads/properties/' . $property->$field) !!}" target="_blank" class="text-primary attachment-link-mini font-weight-bold">
                                                <i class="fas fa-download mr-1"></i> {!! __('general.download') !!}
                                            </a>
                                        @else
                                            <span class="text-muted italic attachment-link-mini">{!! __('general.no_file_found') !!}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


