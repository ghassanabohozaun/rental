<div class="card premium-card" style="margin-top: 10px;">
    <div class="premium-mandatory-header py-2">
        <div class="title-wrapper">
            <i class="fas fa-filter text-primary"></i>
            <span class="font-weight-bold">{!! __('reports.search_filters') !!}</span>
        </div>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="fas fa-minus"></i></a></li>
                <li><a data-action="expand"><i class="fas fa-expand"></i></a></li>
            </ul>
        </div>
    </div>

    <div class="card-content collapse show">
        <div class="card-body">
            <div class="row">
                
                <!-- Company Filter -->
                @if (isset($companies) && $companies->count() > 0)
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="company_id" class="premium-label mb-0">
                                {!! __('companies.company') !!}
                            </label>
                            <select class="form-control js-select2" id="filter_company_id" name="company_id">
                                <option value="">{!! __('general.all_companies') !!}</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                <!-- Select Owners (Single/Multi) -->
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-end mb-1">
                            <label for="owner_id" class="premium-label mb-0">
                                {!! __('reports.select_owner') !!} 
                                <span class="badge badge-light-primary badge-pill ml-1 font-10 font-weight-500">{!! __('general.optional') !!}</span>
                            </label>
                            <div class="d-flex align-items-center gap-3">
                                <a href="javascript:void(0);" class="text-primary font-small-3 font-weight-bold text-nowrap" id="select_all_owners" style="white-space: nowrap;">
                                    <i class="fas fa-check-double"></i> {!! __('reports.select_all') !!}
                                </a>
                                <a href="javascript:void(0);" class="text-danger font-small-3 font-weight-bold text-nowrap ml-2" id="deselect_all_owners" style="white-space: nowrap;">
                                    <i class="fas fa-times"></i> {!! __('reports.deselect_all') !!}
                                </a>
                            </div>
                        </div>
                        <select class="form-control select2" id="owner_id" name="owner_id[]" multiple="multiple">
                            @foreach ($owners as $owner)
                                <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Property Type -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="property_type_id">{!! __('reports.property_type') !!}</label>
                        <select class="form-control" id="property_type_id" name="property_type_id">
                            <option value="">{!! __('reports.all_types') !!}</option>
                            @foreach ($propertyTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Property Status -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="property_status_id">{!! __('reports.property_status') !!}</label>
                        <select class="form-control" id="property_status_id" name="property_status_id">
                            <option value="">{!! __('reports.all_statuses') !!}</option>
                            @foreach ($propertyStatuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
