/**
 * Premium Generic AJAX Form Handler
 * Handles form submissions globally (Modals or Pages)
 */

$(document).ready(function() {
    
    // Generic AJAX Form Submission Handler
    $('body').on('submit', 'form.ajax-form', function(e) {
        e.preventDefault();
        
        let form = $(this);
        let url = form.attr('action');
        let method = form.attr('method') || 'POST';
        let formData = new FormData(this);
        
        // UI Elements
        let saveBtn = form.find('button[type="submit"]');
        let spinner = saveBtn.find('.spinner_loading');
        
        // Custom Data Attributes (Configuration via HTML)
        let successAction = form.data('success-action') || 'reload-table'; // 'reload-table' or 'redirect'
        let redirectUrl = form.data('redirect-url') || '';
        let tableId = form.data('table-id') || '#table_data';
        
        // Custom Messages
        let successMsg = form.data('success-msg') || "Operation completed successfully.";
        let errorMsg = form.data('error-msg') || "An error occurred.";
        let validationMsg = form.data('validation-msg') || "Please check the form for errors.";
        let accessDeniedMsg = form.data('access-denied-msg') || "Access Denied.";
        
        // Auto-detect if form is inside a modal
        let modal = form.closest('.modal');
        let modalId = modal.length ? modal.attr('id') : null;
        
        // Reset previous errors
        form.find('.error-text, .error-message-premium strong').text('');
        form.find('.premium-input, .form-control').css('border-color', '').removeClass('is-invalid-premium');

        $.ajax({
            url: url,
            type: method, // POST with _method=PUT supported via FormData
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                saveBtn.prop('disabled', true);
                if (spinner.length) spinner.removeClass('d-none');
            },
            success: function(response) {
                if (response.status) {
                    // Show success message (prefer backend message if provided)
                    if (typeof flasher !== 'undefined') {
                        flasher.success(response.message || successMsg);
                    }

                    // Trigger custom success event for additional logic
                    form.trigger('ajax-form-success', [response]);

                    // Handle Modal Closure & Reset
                    if (modalId) {
                        $('#' + modalId).modal('hide');
                        form[0].reset();
                        // Reset Select2 if exists
                        if (typeof $.fn.select2 !== 'undefined') {
                            form.find('select').val(null).trigger('change');
                        }
                    }

                    // Handle Success Actions
                    if (successAction === 'redirect' && redirectUrl) {
                        setTimeout(function() {
                            window.location.href = redirectUrl;
                        }, 1500);
                    } else if (successAction === 'reload-table') {
                        if ($(tableId).length) {
                            let $loader = $('.table-loader-overlay');
                            $.ajax({
                                url: window.location.href,
                                type: 'GET',
                                beforeSend: function() {
                                    if ($loader.length) $loader.addClass("active");
                                    $(tableId).css("opacity", "0.6");
                                },
                                success: function(data) {
                                    $(tableId).html(data);
                                    $(tableId).css("opacity", "1");
                                    if ($loader.length) $loader.removeClass("active");

                                    // Synchronize Browser URL with Actual Returned Page
                                    let activePageTxt = $(tableId).find('.pagination .active span, .pagination .active a').first().text();
                                    let activePage = activePageTxt ? parseInt(activePageTxt) : 1; // If no pagination links, it must be page 1
                                    
                                    let urlParams = new URLSearchParams(window.location.search);
                                    let urlPage = parseInt(urlParams.get('page')) || 1;
                                    
                                    if (activePage !== urlPage) {
                                        if (activePage === 1) {
                                            urlParams.delete('page');
                                        } else {
                                            urlParams.set('page', activePage);
                                        }
                                        
                                        let newUrl = window.location.pathname;
                                        let qs = urlParams.toString();
                                        if (qs) newUrl += '?' + qs;
                                        
                                        window.history.pushState(null, "", newUrl);
                                    }
                                },
                                error: function() {
                                    if ($loader.length) $loader.removeClass("active");
                                    $(tableId).css("opacity", "1");
                                }
                            });
                        } else {
                            location.reload();
                        }
                    }
                } else {
                    if (typeof flasher !== 'undefined') {
                        flasher.error(response.message || errorMsg);
                    }
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        // Smart Key Mapping: name.ar -> name_ar, name.en -> name_en
                        let errorKey = key.replace(/\./g, '_');
                        
                        // Target error text spans (support multiple naming conventions)
                        let errorLabel = form.find('.' + errorKey + '_error, #' + errorKey + '_error, #' + errorKey + '_error_edit');
                        if (errorLabel.length) {
                            errorLabel.text(value[0]);
                        }
                        
                        // Highlight inputs (support multiple naming conventions)
                        let inputField = form.find('[name="' + key + '"], #' + errorKey + ', #' + errorKey + '_edit, #' + errorKey + '_create');
                        if (inputField.length) {
                            inputField.css('border-color', '#ff7588').addClass('is-invalid-premium');
                        }
                    });
                    
                    if (typeof flasher !== 'undefined') {
                        flasher.error(validationMsg);
                    }
                } else if (xhr.status === 403) {
                    if (typeof flasher !== 'undefined') {
                        flasher.error(accessDeniedMsg);
                    }
                } else {
                    if (typeof flasher !== 'undefined') {
                        flasher.error(errorMsg);
                    }
                }
            },
            complete: function() {
                saveBtn.prop('disabled', false);
                if (spinner.length) spinner.addClass('d-none');
            }
        });
    });

    // Auto-reset forms when modals are closed
    $('body').on('hidden.bs.modal', '.modal', function() {
        let form = $(this).find('form.ajax-form');
        if (form.length) {
            form[0].reset();
            
            // Reset FileInput if exists
            if (typeof $.fn.fileinput !== 'undefined') {
                form.find('input[type="file"]').fileinput('clear');
            }

            // Reset Select2 if exists
            if (typeof $.fn.select2 !== 'undefined') {
                form.find('select').val(null).trigger('change');
            }

            form.find('.error-text, .error-message-premium strong').text('');
            form.find('.premium-input, .form-control').css('border-color', '').removeClass('is-invalid-premium');
        }
    });

});
