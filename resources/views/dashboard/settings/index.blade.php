@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@push('style')
    {{-- Unified styles in pages.css --}}
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
                                                    <label class="premium-label">{!! __('settings.site_name_ar') !!} <span class="text-danger">*</span></label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" id="site_name_ar" name="site_name[ar]"
                                                            value="{!! old('site_name.ar', setting()->getTranslation('site_name', 'ar')) !!}" 
                                                            class="form-control premium-input shadow-none"
                                                            placeholder="{!! __('settings.enter_site_name_ar') !!}">
                                                        <i class="fas fa-font text-primary"></i>
                                                    </div>
                                                    <span class="text-danger error-text site_name_ar_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label">{!! __('settings.site_name_en') !!} <span class="text-danger">*</span></label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" id="site_name_en" name="site_name[en]"
                                                            value="{!! old('site_name.en', setting()->getTranslation('site_name', 'en')) !!}" 
                                                            class="form-control premium-input shadow-none"
                                                            placeholder="{!! __('settings.enter_site_name_en') !!}">
                                                        <i class="fas fa-language text-primary"></i>
                                                    </div>
                                                    <span class="text-danger error-text site_name_en_error"></span>
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
                                                    <label class="premium-label">{!! __('settings.facebook') !!}</label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" id="facebook" name="facebook"
                                                            value="{!! old('facebook', setting()->facebook) !!}" 
                                                            class="form-control premium-input shadow-none"
                                                            placeholder="{!! __('settings.enter_facebook') !!}">
                                                        <i class="fab fa-facebook-f text-primary"></i>
                                                    </div>
                                                    <span class="text-danger error-text facebook_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label">{!! __('settings.twitter') !!}</label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" id="twitter" name="twitter" 
                                                            value="{!! old('twitter', setting()->twitter) !!}"
                                                            class="form-control premium-input shadow-none" 
                                                            placeholder="{!! __('settings.enter_twitter') !!}">
                                                        <i class="fab fa-twitter text-primary"></i>
                                                    </div>
                                                    <span class="text-danger error-text twitter_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label">{!! __('settings.instegram') !!}</label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" id="instegram" name="instegram"
                                                            value="{!! old('instegram', setting()->instegram) !!}" 
                                                            class="form-control premium-input shadow-none"
                                                            placeholder="{!! __('settings.enter_instegram') !!}">
                                                        <i class="fab fa-instagram text-primary"></i>
                                                    </div>
                                                    <span class="text-danger error-text instegram_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label">{!! __('settings.youtube') !!}</label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" id="youtube" name="youtube"
                                                            value="{!! old('youtube', setting()->youtube) !!}" 
                                                            class="form-control premium-input shadow-none"
                                                            placeholder="{!! __('settings.enter_youtube') !!}">
                                                        <i class="fab fa-youtube text-primary"></i>
                                                    </div>
                                                    <span class="text-danger error-text youtube_error"></span>
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
                                                    <label class="premium-label">{!! __('settings.phone') !!}</label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" id="phone" name="phone"
                                                            value="{!! old('phone', setting()->phone) !!}" 
                                                            class="form-control premium-input shadow-none"
                                                            placeholder="{!! __('settings.enter_phone') !!}">
                                                        <i class="fas fa-phone text-primary"></i>
                                                    </div>
                                                    <span class="text-danger error-text phone_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label">{!! __('settings.mobile') !!}</label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" id="mobile" name="mobile"
                                                            value="{!! old('mobile', setting()->mobile) !!}" 
                                                            class="form-control premium-input shadow-none"
                                                            placeholder="{!! __('settings.enter_mobile') !!}">
                                                        <i class="fas fa-mobile-alt text-primary"></i>
                                                    </div>
                                                    <span class="text-danger error-text mobile_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label">{!! __('settings.whatsapp') !!}</label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" id="whatsapp" name="whatsapp"
                                                            value="{!! old('whatsapp', setting()->whatsapp) !!}" 
                                                            class="form-control premium-input shadow-none"
                                                            placeholder="{!! __('settings.enter_whatsapp') !!}">
                                                        <i class="fab fa-whatsapp text-primary"></i>
                                                    </div>
                                                    <span class="text-danger error-text whatsapp_error"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-1">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label">{!! __('settings.email') !!}</label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="email" id="email" name="email"
                                                            value="{!! old('email', setting()->email) !!}" 
                                                            class="form-control premium-input shadow-none"
                                                            placeholder="{!! __('settings.enter_email') !!}">
                                                        <i class="fas fa-envelope text-primary"></i>
                                                    </div>
                                                    <span class="text-danger error-text email_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-1">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label">{!! __('settings.email_support') !!}</label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="email" id="email_support" name="email_support"
                                                            value="{!! old('email_support', setting()->email_support) !!}" 
                                                            class="form-control premium-input shadow-none"
                                                            placeholder="{!! __('settings.enter_email_support') !!}">
                                                        <i class="fas fa-envelope-open-text text-primary"></i>
                                                    </div>
                                                    <span class="text-danger error-text email_support_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 4: Auth Welcome Content -->
                                <div class="card premium-card mb-3 premium-fade-in">
                                    <div class="premium-mandatory-header" style="border-bottom-color: var(--premium-warning);">
                                        <i class="fas fa-sign-in-alt text-warning"></i>
                                        {!! __('settings.auth_welcome_section') !!}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Badge & Footer -->
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label">{!! __('settings.auth_welcome_badge') !!}</label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" id="auth_welcome_badge" name="auth_welcome_badge[{{ app()->getLocale() }}]"
                                                            value="{!! old('auth_welcome_badge.' . app()->getLocale(), setting()->getTranslation('auth_welcome_badge', app()->getLocale())) !!}" 
                                                            class="form-control premium-input shadow-none"
                                                            placeholder="{!! __('settings.enter_auth_welcome_badge') !!}">
                                                        <i class="fas fa-tag text-primary"></i>
                                                    </div>
                                                    <span class="text-danger error-text auth_welcome_badge_ar_error"></span>
                                                    <span class="text-danger error-text auth_welcome_badge_en_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label">{!! __('settings.auth_welcome_footer') !!}</label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" id="auth_welcome_footer" name="auth_welcome_footer[{{ app()->getLocale() }}]"
                                                            value="{!! old('auth_welcome_footer.' . app()->getLocale(), setting()->getTranslation('auth_welcome_footer', app()->getLocale())) !!}" 
                                                            class="form-control premium-input shadow-none"
                                                            placeholder="{!! __('settings.enter_auth_welcome_footer') !!}">
                                                        <i class="fas fa-info-circle text-primary"></i>
                                                    </div>
                                                    <span class="text-danger error-text auth_welcome_footer_ar_error"></span>
                                                    <span class="text-danger error-text auth_welcome_footer_en_error"></span>
                                                </div>
                                            </div>

                                            <!-- Title Ar & En -->
                                            <div class="col-md-6 mt-1">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label">{!! __('settings.auth_welcome_title') !!} (AR)</label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" id="auth_welcome_title_ar" name="auth_welcome_title[ar]"
                                                            value="{!! old('auth_welcome_title.ar', setting()->getTranslation('auth_welcome_title', 'ar')) !!}" 
                                                            class="form-control premium-input shadow-none"
                                                            placeholder="{!! __('settings.enter_auth_welcome_title') !!}">
                                                        <i class="fas fa-heading text-primary"></i>
                                                    </div>
                                                    <span class="text-danger error-text auth_welcome_title_ar_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-1">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label">{!! __('settings.auth_welcome_title') !!} (EN)</label>
                                                    <div class="premium-input-wrapper">
                                                        <input type="text" id="auth_welcome_title_en" name="auth_welcome_title[en]"
                                                            value="{!! old('auth_welcome_title.en', setting()->getTranslation('auth_welcome_title', 'en')) !!}" 
                                                            class="form-control premium-input shadow-none"
                                                            placeholder="{!! __('settings.enter_auth_welcome_title') !!}">
                                                        <i class="fas fa-heading text-primary"></i>
                                                    </div>
                                                    <span class="text-danger error-text auth_welcome_title_en_error"></span>
                                                </div>
                                            </div>

                                            <!-- Description Ar -->
                                            <div class="col-md-12 mt-1">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label">{!! __('settings.auth_welcome_desc') !!} (AR)</label>
                                                    <div class="premium-input-wrapper">
                                                        <textarea name="auth_welcome_desc[ar]" id="auth_welcome_desc_ar" class="form-control premium-input shadow-none" rows="3"
                                                            placeholder="{!! __('settings.enter_auth_welcome_desc') !!}">{!! old('auth_welcome_desc.ar', setting()->getTranslation('auth_welcome_desc', 'ar')) !!}</textarea>
                                                        <i class="fas fa-pen-nib text-primary"></i>
                                                    </div>
                                                    <span class="text-danger error-text auth_welcome_desc_ar_error"></span>
                                                </div>
                                            </div>
                                            
                                            <!-- Description En -->
                                            <div class="col-md-12 mt-1">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label">{!! __('settings.auth_welcome_desc') !!} (EN)</label>
                                                    <div class="premium-input-wrapper">
                                                        <textarea name="auth_welcome_desc[en]" id="auth_welcome_desc_en" class="form-control premium-input shadow-none" rows="3"
                                                            placeholder="{!! __('settings.enter_auth_welcome_desc') !!}">{!! old('auth_welcome_desc.en', setting()->getTranslation('auth_welcome_desc', 'en')) !!}</textarea>
                                                        <i class="fas fa-pen-nib text-primary"></i>
                                                    </div>
                                                    <span class="text-danger error-text auth_welcome_desc_en_error"></span>
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
                                            <label class="premium-label">{!! __('settings.logo') !!}</label>
                                            <div class="premium-photo-container">
                                                <input type="file" name="logo" id="settings_logo" class="form-control"
                                                    accept="image/*" data-show-caption="true" data-show-upload="false">
                                            </div>
                                            <span class="text-danger error-text logo_error"></span>
                                        </div>

                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('settings.favicon') !!}</label>
                                            <div class="premium-photo-container">
                                                <input type="file" id="settings_favicon" name="favicon" class="form-control"
                                                    accept="image/*" data-show-caption="true" data-show-upload="false">
                                            </div>
                                            <span class="text-danger error-text favicon_error"></span>
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
                'whatsapp', 'email', 'email_support', 'logo', 'favicon',
                'auth_welcome_title_ar', 'auth_welcome_title_en', 'auth_welcome_desc_ar', 'auth_welcome_desc_en',
                'auth_welcome_badge_ar', 'auth_welcome_badge_en', 'auth_welcome_footer_ar', 'auth_welcome_footer_en'
            ];
            $.each(errors, function(index, id) {
                let field = $('#' + id);
                let wrapper = field.closest('.premium-input-wrapper, .premium-photo-container');
                let errorSpan = field.closest('.premium-form-group').find('.error-text');
                
                if(wrapper) wrapper.removeClass('is-invalid-premium');
                errorSpan.text('');
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
                        if (key == 'auth_welcome_title.ar') key = 'auth_welcome_title_ar';
                        if (key == 'auth_welcome_title.en') key = 'auth_welcome_title_en';
                        if (key == 'auth_welcome_desc.ar') key = 'auth_welcome_desc_ar';
                        if (key == 'auth_welcome_desc.en') key = 'auth_welcome_desc_en';
                        if (key == 'auth_welcome_badge.ar') key = 'auth_welcome_badge_ar';
                        if (key == 'auth_welcome_badge.en') key = 'auth_welcome_badge_en';
                        if (key == 'auth_welcome_footer.ar') key = 'auth_welcome_footer_ar';
                        if (key == 'auth_welcome_footer.en') key = 'auth_welcome_footer_en';

                        let field = $('#' + key);
                        let wrapper = field.closest('.premium-input-wrapper, .premium-photo-container');
                        let errorSpan = field.closest('.premium-form-group').find('.error-text');

                        if(wrapper) wrapper.addClass('is-invalid-premium');
                        errorSpan.text(value[0]);
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
            dropZoneEnabled: false,
            initialPreviewAsData: true,
            browseClass: "btn btn-sm btn-primary px-3",
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


