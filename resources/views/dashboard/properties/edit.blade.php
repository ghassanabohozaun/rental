@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@section('content')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/properties-premium.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/contracts-premium.css') }}?v={{ time() }}">
@endpush

    <div class="app-content content">
        <form class="form ajax-form" id='myForm' action="{!! route('dashboard.properties.update', $property->id) !!}" method="post" enctype="multipart/form-data"
            novalidate data-success-msg="{!! __('general.update_success_message') !!}" data-success-action="redirect"
            data-redirect-url="{!! route('dashboard.properties.index') !!}">
            @csrf
            @method('PUT')
            <div class="content-wrapper">
                <!-- begin: content header -->
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 mb-md-0">
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb premium-breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{!! route('dashboard.index') !!}">
                                            <i class="fas fa-home"></i> {!! __('dashboard.home') !!}
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{!! route('dashboard.properties.index') !!}">
                                            {!! __('properties.properties') !!}
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active font-weight-bold">
                                        {!! __('properties.update_property') !!}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right col-md-6 col-12 text-md-right">
                        <div class="d-flex align-items-center justify-content-end mb-1">
                            <a href="{!! route('dashboard.properties.index') !!}" class="btn-premium-back mr-1">
                                <i class="fas fa-arrow-right"></i> {!! __('general.back') !!}
                            </a>
                            <button class="btn btn-premium-save shadow-pulse" type="submit" id="saveBtn">
                                <i class="fas fa-save"></i>
                                {!! __('general.update') !!}
                                <i class="fas fa-sync fa-spin spinner_loading d-none ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end :content header -->

                <!-- begin: content body -->
                <div class="content-body">
                    <section id="basic-form-layouts">
                        <div class="row">
                            <!-- Main Form Column (8) -->
                            <div class="col-lg-8 col-md-12">
                                
                                <!-- Card 1: Basic Information -->
                                <div class="card premium-card mb-2 premium-fade-in">
                                    <div class="premium-mandatory-header">
                                        <i class="fas fa-info-circle text-primary"></i>
                                        {!! __('properties.basic_info') !!}
                                    </div>
                                    <div class="card-body pt-1">
                                        {{-- Company Selection --}}
                                        @if (isset($companies))
                                            <div class="row mb-1 mt-n2">
                                                <div class="col-md-12">
                                                    <div class="premium-form-group" style="margin-bottom: 0.5rem !important;">
                                                        <label class="premium-label">{!! __('companies.company') !!} <span class="text-danger">*</span></label>
                                                        <div class="premium-input-wrapper">
                                                            <select id="company_id" name="company_id" class="form-control premium-input shadow-none select2">
                                                                <option value="">{!! __('general.select_company') !!}</option>
                                                                @foreach ($companies as $company)
                                                                    <option value="{{ $company->id }}" @selected($property->company_id == $company->id)>{{ $company->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <i class="fas fa-briefcase text-primary"></i>
                                                        </div>
                                                        <span class="text text-danger small mt-1 d-block error-text company_id_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="premium-form-group">
                                                    <label class="premium-label">{!! __('properties.name_ar') !!} <span class="text-danger">*</span></label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" name="name[ar]" value="{!! old('name.ar', $property->getTranslation('name', 'ar')) !!}" class="form-control premium-input shadow-none" placeholder="{!! __('properties.enter_name_ar') !!}">
                                                        <i class="fas fa-building text-primary"></i>
                                                    </div>
                                                    <span class="text text-danger small mt-1 d-block error-text name_ar_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group">
                                                    <label class="premium-label">{!! __('properties.name_en') !!} <span class="text-danger">*</span></label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" name="name[en]" value="{!! old('name.en', $property->getTranslation('name', 'en')) !!}" class="form-control premium-input shadow-none" placeholder="{!! __('properties.enter_name_en') !!}">
                                                        <i class="fas fa-building text-primary"></i>
                                                    </div>
                                                    <span class="text text-danger small mt-1 d-block error-text name_en_error"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="premium-form-group">
                                                    <label class="premium-label">{!! __('properties.type') !!} <span class="text-danger">*</span></label>
                                                    <div class="premium-input-wrapper">
                                                        <select name="property_type_id" class="form-control premium-input shadow-none select2">
                                                            <option value="">{!! __('general.select_from_list') !!}</option>
                                                            @foreach ($property_types as $type)
                                                                <option value="{{ $type->id }}" @selected($property->property_type_id == $type->id)>{{ $type->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <i class="fas fa-home text-primary"></i>
                                                    </div>
                                                    <span class="text text-danger small mt-1 d-block error-text property_type_id_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group">
                                                    <label class="premium-label">{!! __('properties.status') !!} <span class="text-danger">*</span></label>
                                                    <div class="premium-input-wrapper">
                                                        <select name="property_status_id" class="form-control premium-input shadow-none select2">
                                                            <option value="">{!! __('general.select_from_list') !!}</option>
                                                            @foreach ($property_statuses as $status)
                                                                <option value="{{ $status->id }}" @selected($property->property_status_id == $status->id)>{{ $status->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <i class="fas fa-check-circle text-primary"></i>
                                                    </div>
                                                    <span class="text text-danger small mt-1 d-block error-text property_status_id_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 2: Specs & Price -->
                                <div class="card premium-card mb-2 premium-fade-in" style="animation-delay: 0.1s;">
                                    <div class="premium-mandatory-header">
                                        <i class="fas fa-sliders-h text-warning"></i>
                                        {!! __('properties.specs_and_price') !!}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="premium-form-group">
                                                    <label class="premium-label">{!! __('properties.price') !!}</label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="number" step="0.01" name="price" value="{!! old('price', $property->price) !!}" class="form-control premium-input shadow-none" placeholder="{!! __('properties.enter_price') !!}">
                                                        <i class="fas fa-money-bill-wave text-success"></i>
                                                    </div>
                                                    <span class="text text-danger small mt-1 d-block error-text price_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group">
                                                    <label class="premium-label">{!! __('properties.area') !!}</label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" name="area" value="{!! old('area', $property->area) !!}" class="form-control premium-input shadow-none" placeholder="{!! __('properties.enter_area') !!}">
                                                        <i class="fas fa-ruler-combined text-warning"></i>
                                                    </div>
                                                    <span class="text text-danger small mt-1 d-block error-text area_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="premium-form-group">
                                                    <label class="premium-label">{!! __('properties.location') !!}</label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" name="location" value="{!! old('location', $property->location) !!}" class="form-control premium-input shadow-none" placeholder="{!! __('properties.enter_location') !!}">
                                                        <i class="fas fa-map-marker-alt text-danger"></i>
                                                    </div>
                                                    <span class="text text-danger small mt-1 d-block error-text location_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 3: Mandatory Details -->
                                <div class="card premium-card mb-2 premium-fade-in" style="animation-delay: 0.2s;">
                                    <div class="premium-mandatory-header">
                                        <i class="fas fa-shield-alt text-danger"></i>
                                        {!! __('properties.mandatory_details_title') !!}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="premium-form-group">
                                                    <label class="premium-label">{!! __('properties.property_number') !!} <span class="text-danger">*</span></label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" name="property_number" value="{!! old('property_number', $property->property_number) !!}" class="form-control premium-input shadow-none" placeholder="{!! __('properties.enter_property_number') !!}">
                                                        <i class="fas fa-hashtag text-primary"></i>
                                                    </div>
                                                    <span class="text text-danger small mt-1 d-block error-text property_number_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group">
                                                    <label class="premium-label">{!! __('properties.title_deed_number') !!} <span class="text-danger">*</span></label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" name="title_deed_number" value="{!! old('title_deed_number', $property->title_deed_number) !!}" class="form-control premium-input shadow-none" placeholder="{!! __('properties.enter_title_deed_number') !!}">
                                                        <i class="fas fa-certificate text-warning"></i>
                                                    </div>
                                                    <span class="text text-danger small mt-1 d-block error-text title_deed_number_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="premium-form-group">
                                                    <label class="premium-label">{!! __('properties.electricity_account_number') !!} <span class="text-danger">*</span></label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" name="electricity_account_number" value="{!! old('electricity_account_number', $property->electricity_account_number) !!}" class="form-control premium-input shadow-none" placeholder="{!! __('properties.enter_electricity_account') !!}">
                                                        <i class="fas fa-bolt text-warning"></i>
                                                    </div>
                                                    <span class="text text-danger small mt-1 d-block error-text electricity_account_number_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group">
                                                    <label class="premium-label">{!! __('properties.water_account_number') !!} <span class="text-danger">*</span></label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" name="water_account_number" value="{!! old('water_account_number', $property->water_account_number) !!}" class="form-control premium-input shadow-none" placeholder="{!! __('properties.enter_water_account') !!}">
                                                        <i class="fas fa-tint text-info"></i>
                                                    </div>
                                                    <span class="text text-danger small mt-1 d-block error-text water_account_number_error"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <div class="premium-form-group mb-0">
                                                    <label class="premium-label">{!! __('properties.description') !!}</label>
                                                    <textarea name="description" class="form-control shadow-none radius-15" rows="3" placeholder="{!! __('properties.enter_description') !!}">{!! old('description', $property->description) !!}</textarea>
                                                    <span class="text text-danger small mt-1 d-block error-text description_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sidebar Area (4) -->
                            <div class="col-lg-4 col-md-12">
                                <div class="sticky-top" style="top: 20px;">
                                    {{-- Summary Card --}}
                                    <div class="property-summary-card mb-2 premium-fade-in" style="animation-delay: 0.3s;">
                                        <div class="summary-header">
                                            <i class="fas fa-building"></i>
                                            <div class="summary-title">{!! __('properties.property_edit_summary') !!}</div>
                                        </div>
                                        <p class="text-muted small mb-3">{!! __('properties.property_preview_desc') !!}</p>
                                        
                                        <div class="summary-list">
                                            <div class="summary-item">
                                                <span class="summary-label">{!! __('properties.type') !!}</span>
                                                <span class="summary-value" id="preview_type">{{ $property->propertyType->name ?? '---' }}</span>
                                            </div>
                                            <div class="summary-item">
                                                <span class="summary-label">{!! __('properties.price') !!}</span>
                                                <span class="summary-value text-success" id="preview_price">{{ number_format($property->price, 2) }}</span>
                                            </div>
                                            <div class="summary-item">
                                                <span class="summary-label">{!! __('properties.status') !!}</span>
                                                <span class="summary-value" id="preview_status">{{ $property->propertyStatus->name ?? '---' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Tips Card --}}
                                    <div class="tip-card premium-fade-in" style="animation-delay: 0.4s;">
                                        <h6><i class="fas fa-lightbulb"></i> {!! __('properties.quick_tips') !!}</h6>
                                        <ul class="tip-list">
                                            <li><i class="fas fa-check-circle"></i> {!! __('properties.tip_1') !!}</li>
                                            <li><i class="fas fa-check-circle"></i> {!! __('properties.tip_2') !!}</li>
                                            <li><i class="fas fa-check-circle"></i> {!! __('properties.tip_3') !!}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/dashbaord/js/generic-select2.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 for standard selects
            $('.select2').select2({
                width: '100%',
                dir: $('html').attr('data-textdirection') || 'ltr'
            });

            // Live Preview Logic
            $('select[name="property_type_id"]').on('change', function() {
                const text = $(this).find('option:selected').text();
                $('#preview_type').text(text.trim() || '---');
            });

            $('select[name="property_status_id"]').on('change', function() {
                const text = $(this).find('option:selected').text();
                $('#preview_status').text(text.trim() || '---');
            });

            $('input[name="price"]').on('input', function() {
                const val = $(this).val();
                $('#preview_price').text(val ? parseFloat(val).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}) : '0.00');
            });
        });
    </script>
@endpush
