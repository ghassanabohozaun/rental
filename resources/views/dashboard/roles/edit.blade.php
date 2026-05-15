@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@push('style')
@endpush

@section('content')
    <div class="app-content content">
        <form class="form ajax-form" id="myForm" action="{!! route('dashboard.roles.update', $role->id) !!}" method="post" enctype="multipart/form-data"
            novalidate data-success-msg="{!! __('general.update_success_message') !!}" data-success-action="redirect"
            data-redirect-url="{!! route('dashboard.roles.index') !!}">
            @csrf
            @method('PUT')
            <div class="content-wrapper">
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
                                        <a href="{!! route('dashboard.roles.index') !!}">
                                            {!! __('roles.roles') !!}
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active font-weight-bold">
                                        {!! __('roles.update_role') !!}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right col-md-6 col-12 text-md-right mb-2">
                        <div class="d-flex align-items-center justify-content-end mb-1 gap-15px">
                            <a href="{!! route('dashboard.roles.index') !!}" class="btn-premium-back">
                                <i class="fas fa-arrow-right"></i> {!! __('general.back') !!}
                            </a>
                            @if ($role->id !== 1)
                                <button class="btn btn-premium-save" type="submit" id="saveBtn">
                                    <i class="fas fa-save mr-2 save-icon"></i>
                                    <i class="fas fa-sync fa-spin d-none spinner_loading mr-2"></i>
                                    {!! __('general.save') !!}
                                </button>
                            @endif
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
                                    <!-- begin: card header -->
                                    <div class="premium-mandatory-header py-2">
                                        <div class="title-wrapper">
                                            <i class="fas fa-user-shield"></i>
                                            <span class="font-weight-bold">{!! __('roles.update_role') !!}</span>
                                        </div>
                                    </div>
                                    <!-- end: card header -->

                                    <!-- begin: card content -->
                                    <div class="card-content collapse show">
                                        <div class="card-body">


                                            <div class="form-body">
                                                @if ($role->id === 1)
                                                    <!-- begin: Administrative Security Protocol -->
                                                    <div class="alert alert-icon-left alert-arrow-left alert-primary mb-3 shadow-sm border-0"
                                                        role="alert" style="border-radius: 12px;">
                                                        <span class="alert-icon"><i class="fas fa-info-circle"></i></span>
                                                        <h5 class="alert-heading font-weight-bold mb-1">
                                                            {!! __('roles.system_role_protected') !!}</h5>
                                                        <p class="mb-0 small">
                                                            {!! __('roles.super_admin_protection_msg') !!}
                                                        </p>
                                                    </div>
                                                    <!-- end: Administrative Security Protocol -->
                                                @endif

                                                @if (isset($companies) && $role->id !== 1)
                                                    <!-- begin: Global Role Note -->
                                                    <div class="alert alert-icon-left alert-arrow-left alert-info mb-3 shadow-sm border-0"
                                                        role="alert" style="border-radius: 12px;">
                                                        <span class="alert-icon"><i class="fas fa-info-circle"></i></span>
                                                        <h6 class="alert-heading font-weight-bold mb-1">
                                                            {!! __('general.pro_tip') !!}</h6>
                                                        <p class="mb-0" style="font-size: 1.1rem;">
                                                            {!! __('roles.global_role_note') !!}
                                                        </p>
                                                    </div>
                                                    <!-- end: Global Role Note -->
                                                @endif

                                                @if (isset($companies))
                                                    <div class="row mb-2">
                                                        <div class="col-md-12">
                                                            <div class="premium-form-group">
                                                                <label for="company_id"
                                                                    class="premium-label">{!! __('companies.company') !!}</label>
                                                                <select id="company_id" name="company_id"
                                                                    class="form-control premium-input shadow-none select2"
                                                                    @disabled($role->isSystemRole())
                                                                    @if ($role->isSystemRole()) style="cursor: not-allowed;" @endif>
                                                                    <option value="">{!! __('roles.global_role') !!}</option>
                                                                    @foreach ($companies as $company)
                                                                        <option value="{{ $company->id }}"
                                                                            @selected($role->company_id == $company->id)>
                                                                            {{ $company->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <span
                                                                    class="text-danger error-text company_id_error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="row mb-4px">
                                                    <div class="col-md-6 mb-2">
                                                        <div class="premium-form-group">
                                                            <label for="name_ar"
                                                                class="premium-label">{!! __('roles.role_ar') !!} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="name_ar" name="name[ar]"
                                                                value="{!! old('name.ar', $role->getTranslation('name', 'ar')) !!}"
                                                                class="form-control premium-input shadow-none"
                                                                autocomplete="off" placeholder="{!! __('roles.enter_role_ar') !!}"
                                                                @disabled($role->id === 1)>
                                                            <span class="text-danger error-text name_ar_error"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mb-2">
                                                        <div class="premium-form-group">
                                                            <label for="name_en"
                                                                class="premium-label">{!! __('roles.role_en') !!} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="name_en" name="name[en]"
                                                                value="{!! old('name.en', $role->getTranslation('name', 'en')) !!}"
                                                                class="form-control premium-input shadow-none"
                                                                autocomplete="off" placeholder="{!! __('roles.enter_role_en') !!}"
                                                                @disabled($role->id === 1)>
                                                            <span class="text-danger error-text name_en_error"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- begin: row -->
                                                <div class="row mb-4px">
                                                    <div class="col-md-12 mb-2">
                                                        <div class="premium-form-group">
                                                            <label for="description"
                                                                class="premium-label">{!! __('roles.description') !!}</label>
                                                            <input type="text" id="description" name="description"
                                                                value="{!! old('description', $role->description) !!}"
                                                                class="form-control premium-input shadow-none"
                                                                autocomplete="off" placeholder="{!! __('roles.enter_description') ?? 'ادخل وصفاً لهذا الدور...' !!}"
                                                                @disabled($role->id === 1)>
                                                            <span class="text-danger error-text description_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end: row -->

                                                <!-- begin: Premium Permissions Grid -->
                                                <div class="row mt-4px">
                                                    <div class="col-md-12">
                                                        <h5
                                                            class="premium-section-title d-flex align-items-center justify-content-between">
                                                            <span>
                                                                <i class="fas fa-key"></i> {!! __('roles.permissions') !!} <span
                                                                    class="text-danger">*</span>
                                                            </span>
                                                            <span
                                                                class="permissions_error premium-error-alert-chip"></span>
                                                        </h5>

                                                        <div class="permissions-grid">
                                                            @php
                                                                $rolePermissions = $role->permissions
                                                                    ->pluck('name')
                                                                    ->toArray();
                                                            @endphp
                                                            @foreach (config('global.modules') as $moduleKey => $moduleLangKey)
                                                                <div
                                                                    class="permission-card {{ $role->id === 1 ? 'disabled-card' : '' }}">
                                                                    <div class="permission-card-header">
                                                                        <div class="permission-card-title">
                                                                            <i
                                                                                class="{{ config('global.module_icons.' . $moduleKey, 'la la-dot-circle') }}"></i>
                                                                            {!! __($moduleLangKey) !!}
                                                                        </div>
                                                                        @php
                                                                            $modulePermissions = collect(
                                                                                config('global.crud_operations'),
                                                                            )->map(function ($opLangKey, $opKey) use (
                                                                                $moduleKey,
                                                                            ) {
                                                                                return $moduleKey . '_' . $opKey;
                                                                            });
                                                                            $allChecked =
                                                                                $role->id === 1 ||
                                                                                $modulePermissions->every(function (
                                                                                    $perm,
                                                                                ) use ($rolePermissions) {
                                                                                    return in_array(
                                                                                        $perm,
                                                                                        $rolePermissions,
                                                                                    );
                                                                                });
                                                                        @endphp
                                                                        <label class="modern-switch">
                                                                            <input type="checkbox"
                                                                                class="select-all-module"
                                                                                data-module="module-{{ $moduleKey }}"
                                                                                @checked($allChecked)
                                                                                @disabled($role->id === 1)>
                                                                            <span class="modern-slider"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="permission-card-body">
                                                                        @foreach (config('global.crud_operations') as $opKey => $opLangKey)
                                                                            @php $permName = $moduleKey . '_' . $opKey; @endphp
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
                                                                                        value="{{ $permName }}"
                                                                                        @checked($role->id === 1 || in_array($permName, $rolePermissions))
                                                                                        @disabled($role->id === 1)>
                                                                                    <span class="modern-slider"></span>
                                                                                </label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="text-center mt-3">
                                                            <span
                                                                class="permissions_error premium-error-alert-chip"></span>
                                                        </div>
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
            function updateSelectAllSwitches() {
                $('.select-all-module').each(function() {
                    let moduleClass = $(this).data('module');
                    let allChecked = $('.' + moduleClass).length > 0 && $('.' + moduleClass).length === $(
                        '.' + moduleClass + ':checked').length;
                    $(this).prop('checked', allChecked);
                });
            }

            // updateSelectAllSwitches(); // No longer needed as it's handled by PHP on load

            $('.select-all-module').on('change', function() {
                let moduleClass = $(this).data('module');
                let isChecked = $(this).is(':checked');
                $('.' + moduleClass).prop('checked', isChecked).trigger('change');
            });

            $('.permission-checkbox').on('change', function() {
                let classes = $(this).attr('class').split(' ');
                let moduleClass = classes.find(c => c.startsWith('module-'));
                let allChecked = $('.' + moduleClass).length === $('.' + moduleClass + ':checked').length;
                $('.select-all-module[data-module="' + moduleClass + '"]').prop('checked', allChecked);
            });

            // Initialize Company Select2 Standard
            if ($('#company_id').length) {
                $('#company_id').select2({
                    width: '100%',
                    dir: $('html').attr('data-textdirection') || 'ltr'
                });
            }
        });
    </script>
@endpush
