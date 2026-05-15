<?php $__env->startSection('title'); ?>
    <?php echo $title; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="app-content content">
        <form class="form" id="settings_form" action="" method="post" enctype="multipart/form-data" novalidate>
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <input type="hidden" id='id' name="id" value="<?php echo setting()->id; ?>">

            <div class="content-wrapper">
                <div class="content-header row">
                    <!-- begin: content header left-->
                    <div class="content-header-left col-md-6 col-12 mb-2 mb-md-0">
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb premium-breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo route('dashboard.index'); ?>">
                                            <i class="fas fa-home"></i> <?php echo __('dashboard.home'); ?>

                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active font-weight-bold">
                                        <?php echo __('settings.settings'); ?>

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
                                <?php echo __('general.save'); ?>

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
                                        <?php echo __('settings.basic_settings_section'); ?>

                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label"><?php echo __('settings.site_name_ar'); ?> <span class="text-danger">*</span></label>
                                                    <input type="text" id="site_name_ar" name="site_name[ar]"
                                                        value="<?php echo old('site_name.ar', setting()->getTranslation('site_name', 'ar')); ?>" 
                                                        class="form-control premium-input shadow-none"
                                                        placeholder="<?php echo __('settings.enter_site_name_ar'); ?>">
                                                    <span class="text-danger error-text site_name_ar_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label"><?php echo __('settings.site_name_en'); ?> <span class="text-danger">*</span></label>
                                                    <input type="text" id="site_name_en" name="site_name[en]"
                                                        value="<?php echo old('site_name.en', setting()->getTranslation('site_name', 'en')); ?>" 
                                                        class="form-control premium-input shadow-none"
                                                        placeholder="<?php echo __('settings.enter_site_name_en'); ?>">
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
                                        <?php echo __('settings.social_section'); ?>

                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label"><?php echo __('settings.facebook'); ?></label>
                                                    <input type="text" id="facebook" name="facebook"
                                                        value="<?php echo old('facebook', setting()->facebook); ?>" 
                                                        class="form-control premium-input shadow-none"
                                                        placeholder="<?php echo __('settings.enter_facebook'); ?>">
                                                    <span class="text-danger error-text facebook_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label"><?php echo __('settings.twitter'); ?></label>
                                                    <input type="text" id="twitter" name="twitter" 
                                                        value="<?php echo old('twitter', setting()->twitter); ?>"
                                                        class="form-control premium-input shadow-none" 
                                                        placeholder="<?php echo __('settings.enter_twitter'); ?>">
                                                    <span class="text-danger error-text twitter_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label"><?php echo __('settings.instegram'); ?></label>
                                                    <input type="text" id="instegram" name="instegram"
                                                        value="<?php echo old('instegram', setting()->instegram); ?>" 
                                                        class="form-control premium-input shadow-none"
                                                        placeholder="<?php echo __('settings.enter_instegram'); ?>">
                                                    <span class="text-danger error-text instegram_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label"><?php echo __('settings.youtube'); ?></label>
                                                    <input type="text" id="youtube" name="youtube"
                                                        value="<?php echo old('youtube', setting()->youtube); ?>" 
                                                        class="form-control premium-input shadow-none"
                                                        placeholder="<?php echo __('settings.enter_youtube'); ?>">
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
                                        <?php echo __('settings.contact_section'); ?>

                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label"><?php echo __('settings.phone'); ?></label>
                                                    <input type="text" id="phone" name="phone"
                                                        value="<?php echo old('phone', setting()->phone); ?>" 
                                                        class="form-control premium-input shadow-none"
                                                        placeholder="<?php echo __('settings.enter_phone'); ?>">
                                                    <span class="text-danger error-text phone_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label"><?php echo __('settings.mobile'); ?></label>
                                                    <input type="text" id="mobile" name="mobile"
                                                        value="<?php echo old('mobile', setting()->mobile); ?>" 
                                                        class="form-control premium-input shadow-none"
                                                        placeholder="<?php echo __('settings.enter_mobile'); ?>">
                                                    <span class="text-danger error-text mobile_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label"><?php echo __('settings.whatsapp'); ?></label>
                                                    <input type="text" id="whatsapp" name="whatsapp"
                                                        value="<?php echo old('whatsapp', setting()->whatsapp); ?>" 
                                                        class="form-control premium-input shadow-none"
                                                        placeholder="<?php echo __('settings.enter_whatsapp'); ?>">
                                                    <span class="text-danger error-text whatsapp_error"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-1">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label"><?php echo __('settings.email'); ?></label>
                                                    <input type="email" id="email" name="email"
                                                        value="<?php echo old('email', setting()->email); ?>" 
                                                        class="form-control premium-input shadow-none"
                                                        placeholder="<?php echo __('settings.enter_email'); ?>">
                                                    <span class="text-danger error-text email_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-1">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label"><?php echo __('settings.email_support'); ?></label>
                                                    <input type="email" id="email_support" name="email_support"
                                                        value="<?php echo old('email_support', setting()->email_support); ?>" 
                                                        class="form-control premium-input shadow-none"
                                                        placeholder="<?php echo __('settings.enter_email_support'); ?>">
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
                                        <?php echo __('settings.auth_welcome_section'); ?>

                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Badge & Footer -->
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label"><?php echo __('settings.auth_welcome_badge'); ?></label>
                                                    <input type="text" id="auth_welcome_badge" name="auth_welcome_badge[<?php echo e(app()->getLocale()); ?>]"
                                                        value="<?php echo old('auth_welcome_badge.' . app()->getLocale(), setting()->getTranslation('auth_welcome_badge', app()->getLocale())); ?>" 
                                                        class="form-control premium-input shadow-none"
                                                        placeholder="<?php echo __('settings.enter_auth_welcome_badge'); ?>">
                                                    <span class="text-danger error-text auth_welcome_badge_ar_error"></span>
                                                    <span class="text-danger error-text auth_welcome_badge_en_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label"><?php echo __('settings.auth_welcome_footer'); ?></label>
                                                    <input type="text" id="auth_welcome_footer" name="auth_welcome_footer[<?php echo e(app()->getLocale()); ?>]"
                                                        value="<?php echo old('auth_welcome_footer.' . app()->getLocale(), setting()->getTranslation('auth_welcome_footer', app()->getLocale())); ?>" 
                                                        class="form-control premium-input shadow-none"
                                                        placeholder="<?php echo __('settings.enter_auth_welcome_footer'); ?>">
                                                    <span class="text-danger error-text auth_welcome_footer_ar_error"></span>
                                                    <span class="text-danger error-text auth_welcome_footer_en_error"></span>
                                                </div>
                                            </div>

                                            <!-- Title Ar & En -->
                                            <div class="col-md-6 mt-1">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label"><?php echo __('settings.auth_welcome_title'); ?> (AR)</label>
                                                    <input type="text" id="auth_welcome_title_ar" name="auth_welcome_title[ar]"
                                                        value="<?php echo old('auth_welcome_title.ar', setting()->getTranslation('auth_welcome_title', 'ar')); ?>" 
                                                        class="form-control premium-input shadow-none"
                                                        placeholder="<?php echo __('settings.enter_auth_welcome_title'); ?>">
                                                    <span class="text-danger error-text auth_welcome_title_ar_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-1">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label"><?php echo __('settings.auth_welcome_title'); ?> (EN)</label>
                                                    <input type="text" id="auth_welcome_title_en" name="auth_welcome_title[en]"
                                                        value="<?php echo old('auth_welcome_title.en', setting()->getTranslation('auth_welcome_title', 'en')); ?>" 
                                                        class="form-control premium-input shadow-none"
                                                        placeholder="<?php echo __('settings.enter_auth_welcome_title'); ?>">
                                                    <span class="text-danger error-text auth_welcome_title_en_error"></span>
                                                </div>
                                            </div>

                                            <!-- Description Ar -->
                                            <div class="col-md-12 mt-1">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label"><?php echo __('settings.auth_welcome_desc'); ?> (AR)</label>
                                                    <textarea name="auth_welcome_desc[ar]" id="auth_welcome_desc_ar" class="form-control premium-input shadow-none" rows="3"
                                                        placeholder="<?php echo __('settings.enter_auth_welcome_desc'); ?>"><?php echo old('auth_welcome_desc.ar', setting()->getTranslation('auth_welcome_desc', 'ar')); ?></textarea>
                                                    <span class="text-danger error-text auth_welcome_desc_ar_error"></span>
                                                </div>
                                            </div>
                                            
                                            <!-- Description En -->
                                            <div class="col-md-12 mt-1">
                                                <div class="premium-form-group mb-2">
                                                    <label class="premium-label"><?php echo __('settings.auth_welcome_desc'); ?> (EN)</label>
                                                    <textarea name="auth_welcome_desc[en]" id="auth_welcome_desc_en" class="form-control premium-input shadow-none" rows="3"
                                                        placeholder="<?php echo __('settings.enter_auth_welcome_desc'); ?>"><?php echo old('auth_welcome_desc.en', setting()->getTranslation('auth_welcome_desc', 'en')); ?></textarea>
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
                                            <div class="summary-title"><?php echo __('settings.media_section'); ?></div>
                                        </div>
                                        
                                        <div class="premium-form-group mb-3">
                                            <label class="premium-label"><?php echo __('settings.logo'); ?></label>
                                            <div class="premium-photo-container">
                                                <input type="file" name="logo" id="settings_logo" class="form-control"
                                                    accept="image/*" data-show-caption="true" data-show-upload="false">
                                            </div>
                                            <span class="text-danger error-text logo_error"></span>
                                        </div>

                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('settings.favicon'); ?></label>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
            var settings_id = "<?php echo e(setting()->id); ?>";
            var data = new FormData(this);
            var url = "<?php echo route('dashboard.settings.update', 'id'); ?>".replace('id', settings_id);

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
                        flasher.success("<?php echo __('general.update_success_message'); ?>");
                    } else {
                        flasher.error("<?php echo __('general.upload_error_message'); ?>");
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

        var lang = "<?php echo Lang(); ?>";
        var logo = "<?php echo setting()->logo; ?>";
        var favicon = "<?php echo setting()->favicon; ?>";

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
            removeLabel: "<?php echo __('general.delete'); ?>",
            browseLabel: "<?php echo __('general.choose_file'); ?>"
        };

        $("#settings_logo").fileinput(Object.assign({}, fileInputConfig, {
            initialPreview: logo === '' ? [] : ["<?php echo asset('/uploads/settings/' . setting()->logo); ?>"]
        }));

        $("#settings_favicon").fileinput(Object.assign({}, fileInputConfig, {
            initialPreview: favicon === '' ? [] : ["<?php echo asset('/uploads/settings/' . setting()->favicon); ?>"]
        }));
    </script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.dashboard.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\rental\resources\views/dashboard/settings/index.blade.php ENDPATH**/ ?>