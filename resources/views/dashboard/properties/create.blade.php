@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@section('content')
    <div class="app-content content">
        <form class="form ajax-form" id='myForm' action="{!! route('dashboard.properties.store') !!}" method="post" enctype="multipart/form-data"
            novalidate data-success-msg="{!! __('general.add_success_message') !!}" data-success-action="redirect"
            data-redirect-url="{!! route('dashboard.properties.index') !!}">
            @csrf
            <div class="content-wrapper">
                <!-- begin: content header -->
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 mb-md-0">
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb premium-breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{!! route('dashboard.index') !!}">
                                            <i class="la la-home"></i> {!! __('dashboard.home') !!}
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{!! route('dashboard.properties.index') !!}">
                                            {!! __('properties.properties') !!}
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        {!! __('properties.create_new_property') !!}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right col-md-6 col-12">
                        <div class="float-md-right mb-1">
                            <button class="btn btn-premium-save" type="submit" id="saveBtn">
                                <i class="la la-save"></i>
                                {!! __('general.save') !!}
                                <i class="la la-refresh la-spin spinner_loading d-none ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end :content header -->

                <!-- begin: content body -->
                <div class="content-body">
                    <section id="basic-form-layouts">
                        <div class="row match-height">
                            <div class="col-md-12">
                                <div class="card premium-card shadow-lg border-0">
                                    <div class="card-header border-0 pb-0">
                                        <h4 class="card-title text-primary font-weight-bold"
                                            id="basic-layout-colored-form-control">
                                            <i class="la la-plus-circle mr-1"></i> {!! __('properties.create_new_property') !!}
                                        </h4>
                                    </div>

                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                            <div class="form-body">

                                                @if (isset($companies))
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="premium-form-group">
                                                                <label for="company_id"
                                                                    class="premium-label">{!! __('companies.company') !!} <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="premium-input-wrapper">
                                                                    <select id="company_id" name="company_id"
                                                                        class="form-control premium-input shadow-none">
                                                                        <option value="">{!! __('general.select_company') !!}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <span
                                                                    class="text text-danger small mt-1 d-block error-text company_id_error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="premium-form-group">
                                                            <label for="name_ar"
                                                                class="premium-label">{!! __('properties.name_ar') !!} <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="premium-input-wrapper">
                                                                <input type="text" id="name_ar" name="name[ar]"
                                                                    value="{!! old('name.ar') !!}"
                                                                    class="form-control premium-input shadow-none"
                                                                    autocomplete="off"
                                                                    placeholder="{!! __('properties.enter_name_ar') !!}">
                                                                <i class="la la-building text-primary"></i>
                                                            </div>
                                                            <span
                                                                class="text text-danger small mt-1 d-block error-text name_ar_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="premium-form-group">
                                                            <label for="name_en"
                                                                class="premium-label">{!! __('properties.name_en') !!} <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="premium-input-wrapper">
                                                                <input type="text" id="name_en" name="name[en]"
                                                                    value="{!! old('name.en') !!}"
                                                                    class="form-control premium-input shadow-none"
                                                                    autocomplete="off"
                                                                    placeholder="{!! __('properties.enter_name_en') !!}">
                                                                <i class="la la-building text-primary"></i>
                                                            </div>
                                                            <span
                                                                class="text text-danger small mt-1 d-block error-text name_en_error"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="premium-form-group">
                                                            <label for="property_type_id"
                                                                class="premium-label">{!! __('properties.type') !!} <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="premium-input-wrapper">
                                                                <select id="property_type_id" name="property_type_id"
                                                                    class="form-control premium-input shadow-none select2">
                                                                    <option value="">{!! __('general.select_from_list') !!}</option>
                                                                    @foreach ($property_types as $type)
                                                                        <option value="{{ $type->id }}">
                                                                            {{ $type->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <span
                                                                class="text text-danger small mt-1 d-block error-text property_type_id_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="premium-form-group">
                                                            <label for="property_status_id"
                                                                class="premium-label">{!! __('properties.status') !!} <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="premium-input-wrapper">
                                                                <select id="property_status_id" name="property_status_id"
                                                                    class="form-control premium-input shadow-none select2">
                                                                    <option value="">{!! __('general.select_from_list') !!}
                                                                    </option>
                                                                    @foreach ($property_statuses as $status)
                                                                        <option value="{{ $status->id }}">
                                                                            {{ $status->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <span
                                                                class="text text-danger small mt-1 d-block error-text property_status_id_error"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="premium-form-group">
                                                            <label for="price"
                                                                class="premium-label">{!! __('properties.price') !!}</label>
                                                            <div class="premium-input-wrapper">
                                                                <input type="number" step="0.01" id="price"
                                                                    name="price" value="{!! old('price') !!}"
                                                                    class="form-control premium-input shadow-none"
                                                                    autocomplete="off"
                                                                    placeholder="{!! __('properties.enter_price') !!}">
                                                                <i class="la la-money text-primary"></i>
                                                            </div>
                                                            <span
                                                                class="text text-danger small mt-1 d-block error-text price_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="premium-form-group">
                                                            <label for="area"
                                                                class="premium-label">{!! __('properties.area') !!}</label>
                                                            <div class="premium-input-wrapper">
                                                                <input type="text" id="area" name="area"
                                                                    value="{!! old('area') !!}"
                                                                    class="form-control premium-input shadow-none"
                                                                    autocomplete="off"
                                                                    placeholder="{!! __('properties.enter_area') !!}">
                                                                <i class="la la-expand text-primary"></i>
                                                            </div>
                                                            <span
                                                                class="text text-danger small mt-1 d-block error-text area_error"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="premium-form-group">
                                                            <label for="location"
                                                                class="premium-label">{!! __('properties.location') !!}</label>
                                                            <div class="premium-input-wrapper">
                                                                <input type="text" id="location" name="location"
                                                                    value="{!! old('location') !!}"
                                                                    class="form-control premium-input shadow-none"
                                                                    autocomplete="off"
                                                                    placeholder="{!! __('properties.enter_location') !!}">
                                                                <i class="la la-map-marker text-primary"></i>
                                                            </div>
                                                            <span
                                                                class="text text-danger small mt-1 d-block error-text location_error"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="premium-mandatory-section mb-4">
                                                    <div class="premium-mandatory-header">
                                                        <i class="la la-exclamation-triangle mr-1"></i>
                                                        {!! __('properties.mandatory_details_title') !!}
                                                    </div>
                                                    <div class="premium-mandatory-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="premium-form-group">
                                                                    <label for="property_number" class="premium-label">
                                                                        {!! __('properties.property_number') !!} <span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="premium-input-wrapper">
                                                                        <input type="text" id="property_number"
                                                                            name="property_number"
                                                                            value="{!! old('property_number') !!}"
                                                                            class="form-control premium-input shadow-none"
                                                                            autocomplete="off"
                                                                            placeholder="{!! __('properties.enter_property_number') !!}">
                                                                        <i class="la la-building"></i>
                                                                    </div>
                                                                    <span
                                                                        class="text text-danger small mt-1 d-block error-text property_number_error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="premium-form-group">
                                                                    <label for="title_deed_number" class="premium-label">
                                                                        {!! __('properties.title_deed_number') !!} <span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="premium-input-wrapper">
                                                                        <input type="text" id="title_deed_number"
                                                                            name="title_deed_number"
                                                                            value="{!! old('title_deed_number') !!}"
                                                                            class="form-control premium-input shadow-none"
                                                                            autocomplete="off"
                                                                            placeholder="{!! __('properties.enter_title_deed_number') !!}">
                                                                        <i class="la la-certificate"></i>
                                                                    </div>
                                                                    <span
                                                                        class="text text-danger small mt-1 d-block error-text title_deed_number_error"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="premium-form-group">
                                                                    <label for="electricity_account_number"
                                                                        class="premium-label">
                                                                        {!! __('properties.electricity_account_number') !!} <span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="premium-input-wrapper">
                                                                        <input type="text"
                                                                            id="electricity_account_number"
                                                                            name="electricity_account_number"
                                                                            value="{!! old('electricity_account_number') !!}"
                                                                            class="form-control premium-input shadow-none"
                                                                            autocomplete="off"
                                                                            placeholder="{!! __('properties.enter_electricity_account') !!}">
                                                                        <i class="la la-bolt"></i>
                                                                    </div>
                                                                    <span
                                                                        class="text text-danger small mt-1 d-block error-text electricity_account_number_error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="premium-form-group">
                                                                    <label for="water_account_number"
                                                                        class="premium-label">
                                                                        {!! __('properties.water_account_number') !!} <span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="premium-input-wrapper">
                                                                        <input type="text" id="water_account_number"
                                                                            name="water_account_number"
                                                                            value="{!! old('water_account_number') !!}"
                                                                            class="form-control premium-input shadow-none"
                                                                            autocomplete="off"
                                                                            placeholder="{!! __('properties.enter_water_account') !!}">
                                                                        <i class="la la-tint"></i>
                                                                    </div>
                                                                    <span
                                                                        class="text text-danger small mt-1 d-block error-text water_account_number_error"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="premium-form-group">
                                                            <label for="description"
                                                                class="premium-label">{!! __('properties.description') !!}</label>
                                                            <textarea id="description" name="description" class="form-control shadow-none" rows="3"
                                                                placeholder="{!! __('properties.enter_description') !!}">{!! old('description') !!}</textarea>
                                                            <span
                                                                class="text text-danger small mt-1 d-block error-text description_error"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
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

            // Initialize Company Select2 Autocomplete
            if ($('#company_id').length) {
                initGenericSelect2('#company_id', '{!! route('dashboard.companies.autocomplete') !!}', '{!! __('general.select_company') !!}');
            }
        });
    </script>
@endpush
