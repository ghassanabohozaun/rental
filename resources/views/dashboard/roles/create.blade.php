@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@section('content')
    <div class="app-content content">
        <form class="form ajax-form" id='myForm' action="{!! route('dashboard.roles.store') !!}" method="post" enctype="multipart/form-data" novalidate
            data-success-msg="{!! __('general.add_success_message') !!}"
            data-success-action="redirect"
            data-redirect-url="{!! route('dashboard.roles.index') !!}">
            @csrf
            <div class="content-wrapper">
                <!-- begin: content header -->
                <div class="content-header row">
                    <!-- begin: content header left-->
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
                                        <a href="{!! route('dashboard.roles.index') !!}">
                                            {!! __('roles.roles') !!}
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        {!! __('roles.create_new_role') !!}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- end: content header left-->

                    <!-- begin: content header right-->
                    <div class="content-header-right col-md-6 col-12">
                        <div class="float-md-right mb-1">
                            <button class="btn btn-premium-save" type="submit" id="saveBtn">
                                <i class="la la-save"></i>
                                {!! __('general.save') !!}
                                <i class="la la-refresh la-spin spinner_loading d-none ml-1"></i>
                            </button>
                        </div>
                    </div>
                    <!-- end: content header right-->

                </div> <!-- end :content header -->

                <!-- begin: content body -->
                <div class="content-body">

                    <section id="basic-form-layouts">
                        <div class="row match-height">
                            <div class="col-md-12">
                                <div class="card premium-card shadow-lg border-0">
                                    <!-- begin: card header -->
                                    <div class="card-header border-0 pb-0">
                                        <h4 class="card-title text-primary font-weight-bold"
                                            id="basic-layout-colored-form-control">
                                            <i class="la la-plus-circle mr-1"></i> {!! __('roles.create_new_role') !!}
                                        </h4>
                                    </div>
                                    <!-- end: card header -->

                                    <!-- begin: card content -->
                                    <div class="card-content collapse show">
                                        <div class="card-body">

                                            <div class="form-body">
                                                @if(isset($companies))
                                                <!-- begin: Global Role Note -->
                                                <div class="alert alert-icon-left alert-arrow-left alert-info mb-3 shadow-sm border-0" role="alert" style="border-radius: 12px;">
                                                    <span class="alert-icon"><i class="la la-info-circle"></i></span>
                                                    <h6 class="alert-heading font-weight-bold mb-1">{!! __('general.pro_tip') !!}</h6>
                                                    <p class="mb-0" style="font-size: 1.1rem;">
                                                        {!! __('roles.global_role_note') !!}
                                                    </p>
                                                </div>
                                                <!-- end: Global Role Note -->

                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="premium-form-group">
                                                            <label for="company_id" class="premium-label">{!! __('companies.company') !!}</label>
                                                            <div class="premium-input-wrapper">
                                                                <select id="company_id" name="company_id" class="form-control premium-input shadow-none">
                                                                    <option value="">{!! __('roles.global_role') !!}</option>
                                                                    <!-- Options will be loaded via Select2 Autocomplete -->
                                                                </select>
                                                            </div>
                                                            <span class="text text-danger small mt-1 d-block error-text company_id_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="premium-form-group">
                                                            <label for="name_ar"
                                                                class="premium-label">{!! __('roles.role_ar') !!} <span class="text-danger">*</span></label>
                                                            <div class="premium-input-wrapper">
                                                                <input type="text" id="name_ar" name="name[ar]"
                                                                    value="{!! old('name.ar') !!}"
                                                                    class="form-control premium-input shadow-none"
                                                                    autocomplete="off"
                                                                    placeholder="{!! __('roles.enter_role_ar') !!}">
                                                                <i class="la la-shield text-primary"></i>
                                                            </div>
                                                            <span class="text text-danger small mt-1 d-block error-text name_ar_error"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="premium-form-group">
                                                            <label for="name_en"
                                                                class="premium-label">{!! __('roles.role_en') !!} <span class="text-danger">*</span></label>
                                                            <div class="premium-input-wrapper">
                                                                <input type="text" id="name_en" name="name[en]"
                                                                    value="{!! old('name.en') !!}"
                                                                    class="form-control premium-input shadow-none"
                                                                    autocomplete="off"
                                                                    placeholder="{!! __('roles.enter_role_en') !!}">
                                                                <i class="la la-shield text-primary"></i>
                                                            </div>
                                                            <span class="text text-danger small mt-1 d-block error-text name_en_error"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- begin: row -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="premium-form-group">
                                                            <label for="description"
                                                                class="premium-label">{!! __('roles.description') !!}</label>
                                                            <div class="premium-input-wrapper">
                                                                <input type="text" id="description" name="description"
                                                                    value="{!! old('description') !!}"
                                                                    class="form-control premium-input shadow-none"
                                                                    autocomplete="off"
                                                                    placeholder="{!! __('roles.enter_description') ?? 'ادخل وصفاً لهذا الدور...' !!}">
                                                                <i class="la la-info-circle text-primary"></i>
                                                            </div>
                                                            <span class="text text-danger small mt-1 d-block error-text description_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end: row -->

                                                <!-- begin: Premium Permissions Grid -->
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <h5 class="mb-3 text-primary font-weight-bold">
                                                            <i class="la la-key mr-1"></i> {!! __('roles.permissions') !!} <span class="text-danger">*</span>
                                                        </h5>

                                                        <div class="permissions-grid">
                                                            @foreach (config('global.modules') as $moduleKey => $moduleLangKey)
                                                                <div class="permission-card">
                                                                    <div class="permission-card-header">
                                                                        <div class="permission-card-title">
                                                                            <i
                                                                                class="la {{ config('global.module_icons.' . $moduleKey, 'la-dot-circle') }}"></i>
                                                                            {!! __($moduleLangKey) !!}
                                                                        </div>
                                                                        <label class="modern-switch"
                                                                            style="transform: scale(0.8);">
                                                                            <input type="checkbox" class="select-all-module"
                                                                                data-module="module-{{ $moduleKey }}">
                                                                            <span class="modern-slider"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="permission-card-body">
                                                                        @foreach (config('global.crud_operations') as $opKey => $opLangKey)
                                                                            <div class="permission-item">
                                                                                <div class="permission-info">
                                                                                    <label
                                                                                        class="permission-label">{!! __($opLangKey) !!}</label>
                                                                                    <p class="permission-desc">
                                                                                        {!! __($opLangKey . '_desc') !!}</p>
                                                                                </div>
                                                                                <label class="modern-switch">
                                                                                    <input type="checkbox"
                                                                                        class="permission-checkbox module-{{ $moduleKey }}"
                                                                                        name="permissions[]"
                                                                                        value="{{ $moduleKey }}_{{ $opKey }}">
                                                                                    <span class="modern-slider"></span>
                                                                                </label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <span class="text text-danger small mt-1 d-block error-text permissions_error"></span>
                                                    </div>
                                                </div>
                                                <!-- end: Premium Permissions Grid -->

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
    <script>
        $(document).ready(function() {
            // Permission UI Logic
            $('.select-all-module').on('change', function() {
                let moduleClass = $(this).data('module');
                let isChecked = $(this).is(':checked');
                $('.' + moduleClass).prop('checked', isChecked);
            });

            $('.permission-checkbox').on('change', function() {
                let classes = $(this).attr('class').split(' ');
                let moduleClass = classes.find(c => c.startsWith('module-'));
                let allChecked = $('.' + moduleClass).length === $('.' + moduleClass + ':checked').length;
                $('.select-all-module[data-module="' + moduleClass + '"]').prop('checked', allChecked);
            });

            // Initialize Company Select2 Autocomplete
            if ($('#company_id').length) {
                initGenericSelect2('#company_id', '{!! route("dashboard.companies.autocomplete") !!}', '{!! __("roles.global_role") !!}');
            }
        });
    </script>
@endpush
