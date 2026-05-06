@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@push('style')
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord/css/settings-premium.css') !!}?v={{ time() }}">
@endpush

@section('content')
    <div class="app-content content">
        <form class="form" id="settings_form" action="" method="post" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
            <input type="hidden" id='id' name="id" value="{!! setting()->id !!}">

            <div class="content-wrapper">
                <div class="content-header row">
                    <!-- begin: content header left-->
                    <div class="content-header-left col-md-6 col-12 mb-2 mb-md-0">
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb premium-breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{!! route('dashboard.index') !!}">
                                            <i class="fas fa-home"></i> {!! __('dashboard.home') !!}
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active font-weight-bold">
                                        {!! __('settings.settings') !!}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- end: content header left-->

                    <!-- begin: content header right-->
                    <div class="content-header-right col-md-6 col-12 text-md-right">
                        <div class="mb-1">
                            <button class="btn btn-premium-save shadow-pulse" type="submit" id="saveBtn">
                                <i class="fas fa-save"></i>
                                {!! __('general.save') !!}
                                <i class="fas fa-sync fa-spin spinner_loading d-none"></i>
                            </button>
                        </div>
                    </div>
                    <!-- end: content header right-->
                </div> 
                <!-- end :content header -->

                <!-- begin: content body -->
                <div class="content-body">
                    <section id="basic-form-layouts">
                        <div class="row">
                            <!-- Main Form Column (8) -->
                            <div class="col-lg-8 col-md-12">
                                
                                <!-- Card 1: Basic Information -->
                                <div class="card premium-card mb-3 premium-fade-in">
                                    <div class="premium-mandatory-header">
                                        <i class="fas fa-globe text-primary"></i>
                                        {!! __('settings.basic_settings_section') !!}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <div class="field-header">
                                                        <i class="fas fa-font"></i>
                                                        <label>{!! __('settings.site_name_ar') !!} <span class="text-danger">*</span></label>
                                                    </div>
                                                    <input type="text" id="site_name_ar" name="site_name[ar]"
                                                        value="{!! old('site_name.ar', setting()->getTranslation('site_name', 'ar')) !!}" 
                                                        class="form-control form-control-custom shadow-none"
                                                        placeholder="{!! __('settings.enter_site_name_ar') !!}">
                                                    <span class="text-danger small mt-1 d-block"><strong id="site_name_ar_error"></strong></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <div class="field-header">
                                                        <i class="fas fa-language"></i>
                                                        <label>{!! __('settings.site_name_en') !!} <span class="text-danger">*</span></label>
                                                    </div>
                                                    <input type="text" id="site_name_en" name="site_name[en]"
                                                        value="{!! old('site_name.en', setting()->getTranslation('site_name', 'en')) !!}" 
                                                        class="form-control form-control-custom shadow-none"
                                                        placeholder="{!! __('settings.enter_site_name_en') !!}">
                                                    <span class="text-danger small mt-1 d-block"><strong id="site_name_en_error"></strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 2: Social Media -->
                                <div class="card premium-card mb-3 premium-fade-in">
                                    <div class="premium-mandatory-header" style="border-bottom-color: var(--premium-success);">
                                        <i class="fas fa-share-alt text-success"></i>
                                        {!! __('settings.social_section') !!}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <div class="field-header">
                                                        <i class="fab fa-facebook-f"></i>
                                                        <label>{!! __('settings.facebook') !!}</label>
                                                    </div>
                                                    <input type="text" id="facebook" name="facebook"
                                                        value="{!! old('facebook', setting()->facebook) !!}" 
                                                        class="form-control form-control-custom shadow-none"
                                                        placeholder="{!! __('settings.enter_facebook') !!}">
                                                    <span class="text-danger small mt-1 d-block"><strong id="facebook_error"></strong></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <div class="field-header">
                                                        <i class="fab fa-twitter"></i>
                                                        <label>{!! __('settings.twitter') !!}</label>
                                                    </div>
                                                    <input type="text" id="twitter" name="twitter" 
                                                        value="{!! old('twitter', setting()->twitter) !!}"
                                                        class="form-control form-control-custom shadow-none" 
                                                        placeholder="{!! __('settings.enter_twitter') !!}">
                                                    <span class="text-danger small mt-1 d-block"><strong id="twitter_error"></strong></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <div class="field-header">
                                                        <i class="fab fa-instagram"></i>
                                                        <label>{!! __('settings.instegram') !!}</label>
                                                    </div>
                                                    <input type="text" id="instegram" name="instegram"
                                                        value="{!! old('instegram', setting()->instegram) !!}" 
                                                        class="form-control form-control-custom shadow-none"
                                                        placeholder="{!! __('settings.enter_instegram') !!}">
                                                    <span class="text-danger small mt-1 d-block"><strong id="instegram_error"></strong></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <div class="field-header">
                                                        <i class="fab fa-youtube"></i>
                                                        <label>{!! __('settings.youtube') !!}</label>
                                                    </div>
                                                    <input type="text" id="youtube" name="youtube"
                                                        value="{!! old('youtube', setting()->youtube) !!}" 
                                                        class="form-control form-control-custom shadow-none"
                                                        placeholder="{!! __('settings.enter_youtube') !!}">
                                                    <span class="text-danger small mt-1 d-block"><strong id="youtube_error"></strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 3: Contact Information -->
                                <div class="card premium-card mb-3 premium-fade-in">
                                    <div class="premium-mandatory-header" style="border-bottom-color: var(--premium-info);">
                                        <i class="fas fa-headset text-info"></i>
                                        {!! __('settings.contact_section') !!}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="premium-form-group mb-2">
                                                    <div class="field-header">
                                                        <i class="fas fa-phone"></i>
                                                        <label>{!! __('settings.phone') !!}</label>
                                                    </div>
                                                    <input type="text" id="phone" name="phone"
                                                        value="{!! old('phone', setting()->phone) !!}" 
                                                        class="form-control form-control-custom shadow-none"
                                                        placeholder="{!! __('settings.enter_phone') !!}">
                                                    <span class="text-danger small mt-1 d-block"><strong id="phone_error"></strong></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="premium-form-group mb-2">
                                                    <div class="field-header">
                                                        <i class="fas fa-mobile-alt"></i>
                                                        <label>{!! __('settings.mobile') !!}</label>
                                                    </div>
                                                    <input type="text" id="mobile" name="mobile"
                                                        value="{!! old('mobile', setting()->mobile) !!}" 
                                                        class="form-control form-control-custom shadow-none"
                                                        placeholder="{!! __('settings.enter_mobile') !!}">
                                                    <span class="text-danger small mt-1 d-block"><strong id="mobile_error"></strong></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="premium-form-group mb-2">
                                                    <div class="field-header">
                                                        <i class="fab fa-whatsapp"></i>
                                                        <label>{!! __('settings.whatsapp') !!}</label>
                                                    </div>
                                                    <input type="text" id="whatsapp" name="whatsapp"
                                                        value="{!! old('whatsapp', setting()->whatsapp) !!}" 
                                                        class="form-control form-control-custom shadow-none"
                                                        placeholder="{!! __('settings.enter_whatsapp') !!}">
                                                    <span class="text-danger small mt-1 d-block"><strong id="whatsapp_error"></strong></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-1">
                                                <div class="premium-form-group mb-2">
                                                    <div class="field-header">
                                                        <i class="fas fa-envelope"></i>
                                                        <label>{!! __('settings.email') !!}</label>
                                                    </div>
                                                    <input type="email" id="email" name="email"
                                                        value="{!! old('email', setting()->email) !!}" 
                                                        class="form-control form-control-custom shadow-none"
                                                        placeholder="{!! __('settings.enter_email') !!}">
                                                    <span class="text-danger small mt-1 d-block"><strong id="email_error"></strong></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-1">
                                                <div class="premium-form-group mb-2">
                                                    <div class="field-header">
                                                        <i class="fas fa-envelope-open-text"></i>
                                                        <label>{!! __('settings.email_support') !!}</label>
                                                    </div>
                                                    <input type="email" id="email_support" name="email_support"
                                                        value="{!! old('email_support', setting()->email_support) !!}" 
                                                        class="form-control form-control-custom shadow-none"
                                                        placeholder="{!! __('settings.enter_email_support') !!}">
                                                    <span class="text-danger small mt-1 d-block"><strong id="email_support_error"></strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sidebar Area (4) -->
                            <div class="col-lg-4 col-md-12">
                                <div class="sticky-top" style="top: 20px;">
                                    <!-- Identity & Media Card -->
                                    <div class="identity-summary-card mb-3 premium-fade-in">
                                        <div class="summary-header">
                                            <i class="fas fa-images"></i>
                                            <div class="summary-title">{!! __('settings.media_section') !!}</div>
                                        </div>
                                        
                                        <div class="premium-form-group mb-3">
                                            <div class="field-header">
                                                <i class="fas fa-image"></i>
                                                <label class="font-weight-bold">{!! __('settings.logo') !!}</label>
                                            </div>
                                            <input type="file" name="logo" id="settings_logo" class="form-control"
                                                accept="image/*" data-show-caption="true" data-show-upload="false">
                                            <span class="text-danger small mt-1 d-block"><strong id="logo_error"></strong></span>
                                        </div>

                                        <div class="premium-form-group">
                                            <div class="field-header">
                                                <i class="fas fa-fingerprint"></i>
                                                <label class="font-weight-bold">{!! __('settings.favicon') !!}</label>
                                            </div>
                                            <input type="file" id="settings_favicon" name="favicon" class="form-control"
                                                accept="image/*" data-show-caption="true" data-show-upload="false">
                                            <span class="text-danger small mt-1 d-block"><strong id="favicon_error"></strong></span>
                                        </div>
                                    </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- end: content body -->
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        function resetUpdateSettings() {
            let errors = ['site_name_ar', 'site_name_en', 'facebook', 'twitter', 'instegram', 'youtube', 'phone', 'mobile',
                'whatsapp', 'email', 'email_support', 'logo', 'favicon'
            ];
            $.each(errors, function(index, id) {
                $('#' + id + '_error').text('');
                $('#' + id).css('border-color', '');
            });
        };

        $('#settings_form').on('submit', function(e) {
            e.preventDefault();
            resetUpdateSettings();
            var settings_id = "{{ setting()->id }}";
            var data = new FormData(this);
            var url = "{!! route('dashboard.settings.update', 'id') !!}".replace('id', settings_id);

            $.ajax({
                url: url,
                data: data,
                type: "POST",
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('.spinner_loading').removeClass('d-none');
                },
                success: function(data) {
                    if (data.status == true) {
                        $('.site_name_logo_section').load(location.href + ' .site_name_logo_section');
                        flasher.success("{!! __('general.update_success_message') !!}");
                    } else {
                        flasher.error("{!! __('general.upload_error_message') !!}");
                    }
                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, value) {
                        if (key == 'site_name.en') key = 'site_name_en';
                        if (key == 'site_name.ar') key = 'site_name_ar';

                        $('#' + key + '_error').text(value[0]);
                        $('#' + key).css('border-color', '#F64E60');
                    });
                },
                complete: function() {
                    $('.spinner_loading').addClass('d-none');
                }
            });
        });

        var lang = "{!! Lang() !!}";
        var logo = "{!! setting()->logo !!}";
        var favicon = "{!! setting()->favicon !!}";

        var fileInputConfig = {
            theme: 'fa5',
            language: lang,
            allowedFileTypes: ['image'],
            maxFileCount: 1,
            showCancel: false,
            showUpload: false,
            initialPreviewAsData: true,
            browseClass: "btn btn-primary d-block w-100",
            removeClass: "btn btn-danger",
            removeLabel: "{!! __('general.delete') !!}",
            browseLabel: "{!! __('general.choose_file') !!}"
        };

        $("#settings_logo").fileinput(Object.assign({}, fileInputConfig, {
            initialPreview: logo === '' ? [] : ["{!! asset('/uploads/settings/' . setting()->logo) !!}"]
        }));

        $("#settings_favicon").fileinput(Object.assign({}, fileInputConfig, {
            initialPreview: favicon === '' ? [] : ["{!! asset('/uploads/settings/' . setting()->favicon) !!}"]
        }));
    </script>
@endpush
