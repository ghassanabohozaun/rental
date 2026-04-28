@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@push('style')
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord/css/settings.css') !!}">
@endpush

@section('content')
    <div class="app-content content">
        <form class="form" id="settings_form" action="" method="post" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
            <input type="hidden" id='id' name="id" value="{!! setting()->id !!}">

            <div class="content-wrapper px-md-4 py-md-3">

                <!-- Header -->
                <div class="content-header row mb-2 align-items-center">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        <h3 class="content-header-title d-inline-block">{!! __('settings.settings') !!}</h3>
                        <div class="row breadcrumbs-top d-inline-block">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{!! route('dashboard.index') !!}">{!! __('dashboard.home') !!}</a></li>
                                    <li class="breadcrumb-item active">{!! __('settings.settings') !!}</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="content-header-right col-md-6 col-12 text-md-right">
                        <button class="btn btn-premium-save" type="submit">
                            <i class="la la-save"></i>
                            {!! __('general.save') !!}
                            <i class="la la-refresh spinner_loading d-none"></i>
                        </button>
                    </div>
                </div>

                <!-- Body -->
                <div class="content-body">

                    <!-- Section 1: Basic Settings -->
                    <div class="card card-settings">
                        <div class="card-body p-2">
                            <div class="settings-section-header">
                                <div class="icon-wrapper icon-wrapper-primary">
                                    <i class="la la-globe fa-lg"></i>
                                </div>
                                <h4 class="settings-section-title">{!! __('settings.basic_settings_section') !!}</h4>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <div class="field-header">
                                            <i class="la la-font"></i>
                                            <label class="font-weight-bold text-dark">{!! __('settings.site_name_ar') !!} <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <input type="text" id="site_name_ar" name="site_name[ar]"
                                            value="{!! old('site_name.ar', setting()->getTranslation('site_name', 'ar')) !!}" class="form-control form-control-custom"
                                            autocomplete="off" placeholder="{!! __('settings.enter_site_name_ar') !!}">
                                        <span class="text-danger"><strong id="site_name_ar_error"></strong></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <div class="field-header">
                                            <i class="la la-language"></i>
                                            <label class="font-weight-bold text-dark">{!! __('settings.site_name_en') !!} <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <input type="text" id="site_name_en" name="site_name[en]"
                                            value="{!! old('site_name.en', setting()->getTranslation('site_name', 'en')) !!}" class="form-control form-control-custom"
                                            autocomplete="off" placeholder="{!! __('settings.enter_site_name_en') !!}">
                                        <span class="text-danger"><strong id="site_name_en_error"></strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Social Media -->
                    <div class="card card-settings">
                        <div class="card-body p-2">
                            <div class="settings-section-header">
                                <div class="icon-wrapper icon-wrapper-success">
                                    <i class="la la-share-alt fa-lg"></i>
                                </div>
                                <h4 class="settings-section-title">{!! __('settings.social_section') !!}</h4>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <div class="field-header">
                                            <i class="la la-facebook text-fb"></i>
                                            <label class="font-weight-bold text-dark">{!! __('settings.facebook') !!}</label>
                                        </div>
                                        <input type="text" id="facebook" name="facebook"
                                            value="{!! old('facebook', setting()->facebook) !!}" class="form-control form-control-custom"
                                            autocomplete="off" placeholder="{!! __('settings.enter_facebook') !!}">
                                        <span class="text-danger"><strong id="facebook_error"></strong></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <div class="field-header">
                                            <i class="la la-twitter text-tw"></i>
                                            <label class="font-weight-bold text-dark">{!! __('settings.twitter') !!}</label>
                                        </div>
                                        <input type="text" id="twitter" name="twitter" value="{!! old('twitter', setting()->twitter) !!}"
                                            class="form-control form-control-custom" autocomplete="off"
                                            placeholder="{!! __('settings.enter_twitter') !!}">
                                        <span class="text-danger"><strong id="twitter_error"></strong></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <div class="field-header">
                                            <i class="la la-instagram text-ig"></i>
                                            <label class="font-weight-bold text-dark">{!! __('settings.instegram') !!}</label>
                                        </div>
                                        <input type="text" id="instegram" name="instegram"
                                            value="{!! old('instegram', setting()->instegram) !!}" class="form-control form-control-custom"
                                            autocomplete="off" placeholder="{!! __('settings.enter_instegram') !!}">
                                        <span class="text-danger"><strong id="instegram_error"></strong></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <div class="field-header">
                                            <i class="la la-youtube text-yt"></i>
                                            <label class="font-weight-bold text-dark">{!! __('settings.youtube') !!}</label>
                                        </div>
                                        <input type="text" id="youtube" name="youtube"
                                            value="{!! old('youtube', setting()->youtube) !!}" class="form-control form-control-custom"
                                            autocomplete="off" placeholder="{!! __('settings.enter_youtube') !!}">
                                        <span class="text-danger"><strong id="youtube_error"></strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Contact Info -->
                    <div class="card card-settings">
                        <div class="card-body p-2">
                            <div class="settings-section-header">
                                <div class="icon-wrapper icon-wrapper-cyan">
                                    <i class="la la-phone fa-lg"></i>
                                </div>
                                <h4 class="settings-section-title">{!! __('settings.contact_section') !!}</h4>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <div class="field-header">
                                            <i class="la la-phone"></i>
                                            <label class="font-weight-bold text-dark">{!! __('settings.phone') !!}</label>
                                        </div>
                                        <input type="text" id="phone" name="phone"
                                            value="{!! old('phone', setting()->phone) !!}" class="form-control form-control-custom"
                                            autocomplete="off" placeholder="{!! __('settings.enter_phone') !!}">
                                        <span class="text-danger"><strong id="phone_error"></strong></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <div class="field-header">
                                            <i class="la la-mobile"></i>
                                            <label class="font-weight-bold text-dark">{!! __('settings.mobile') !!}</label>
                                        </div>
                                        <input type="text" id="mobile" name="mobile"
                                            value="{!! old('mobile', setting()->mobile) !!}" class="form-control form-control-custom"
                                            autocomplete="off" placeholder="{!! __('settings.enter_mobile') !!}">
                                        <span class="text-danger"><strong id="mobile_error"></strong></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <div class="field-header">
                                            <i class="la la-whatsapp text-wa"></i>
                                            <label class="font-weight-bold text-dark">{!! __('settings.whatsapp') !!}</label>
                                        </div>
                                        <input type="text" id="whatsapp" name="whatsapp"
                                            value="{!! old('whatsapp', setting()->whatsapp) !!}" class="form-control form-control-custom"
                                            autocomplete="off" placeholder="{!! __('settings.enter_whatsapp') !!}">
                                        <span class="text-danger"><strong id="whatsapp_error"></strong></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <div class="field-header">
                                            <i class="la la-envelope"></i>
                                            <label class="font-weight-bold text-dark">{!! __('settings.email') !!}</label>
                                        </div>
                                        <input type="email" id="email" name="email"
                                            value="{!! old('email', setting()->email) !!}" class="form-control form-control-custom"
                                            autocomplete="off" placeholder="{!! __('settings.enter_email') !!}">
                                        <span class="text-danger"><strong id="email_error"></strong></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <div class="field-header">
                                            <i class="la la-envelope-o"></i>
                                            <label class="font-weight-bold text-dark">{!! __('settings.email_support') !!}</label>
                                        </div>
                                        <input type="email" id="email_support" name="email_support"
                                            value="{!! old('email_support', setting()->email_support) !!}" class="form-control form-control-custom"
                                            autocomplete="off" placeholder="{!! __('settings.enter_email_support') !!}">
                                        <span class="text-danger"><strong id="email_support_error"></strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Media -->
                    <div class="card card-settings">
                        <div class="card-body p-2">
                            <div class="settings-section-header">
                                <div class="icon-wrapper icon-wrapper-warning">
                                    <i class="la la-image fa-lg"></i>
                                </div>
                                <h4 class="settings-section-title">{!! __('settings.media_section') !!}</h4>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <div class="field-header">
                                            <i class="la la-image"></i>
                                            <label for="logo"
                                                class="font-weight-bold text-dark">{!! __('settings.logo') !!}</label>
                                        </div>
                                        <input type="file" name="logo" id="settings_logo" class="form-control"
                                            accept="image/*" data-show-caption="true" data-show-upload="false">
                                        <span class="text-danger"><strong id="logo_error"></strong></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <div class="field-header">
                                            <i class="la la-image"></i>
                                            <label for="favicon"
                                                class="font-weight-bold text-dark">{!! __('settings.favicon') !!}</label>
                                        </div>
                                        <input type="file" id="settings_favicon" name="favicon" class="form-control"
                                            accept="image/*" data-show-caption="true" data-show-upload="false">
                                        <span class="text-danger"><strong id="favicon_error"></strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
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
