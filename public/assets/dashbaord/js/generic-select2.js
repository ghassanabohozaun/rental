/**
 * Generic Select2 Autocomplete Initialization
 * 
 * @param {string} selector - The jQuery selector for the element (e.g. '#company_id_create')
 * @param {string} url - The AJAX endpoint URL
 * @param {string} placeholder - The placeholder text
 * @param {string} dropdownParent - Optional ID of the parent modal to fix z-index issues (e.g. '#createUserModal')
 */
function initGenericSelect2(selector, url, placeholder, dropdownParent = null) {
    let config = {
        placeholder: placeholder,
        allowClear: false, // Disabled native clear to use our custom professional reset icon
        width: '100%',
        minimumInputLength: 0, 
        ajax: {
            url: url,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, 
                    page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: data,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        },
        language: {
            searching: function() { return window.PTC_I18N && window.PTC_I18N.select2 ? window.PTC_I18N.select2.searching() : 'Searching...'; },
            noResults: function() { return window.PTC_I18N && window.PTC_I18N.select2 ? window.PTC_I18N.select2.noResults() : 'No results found'; },
            errorLoading: function() { return window.PTC_I18N && window.PTC_I18N.select2 ? window.PTC_I18N.select2.errorLoading() : 'Error loading results'; },
            inputTooShort: function(args) { return window.PTC_I18N && window.PTC_I18N.select2 ? window.PTC_I18N.select2.inputTooShort(args) : 'Please enter more characters'; },
            inputTooLong: function(args) { return window.PTC_I18N && window.PTC_I18N.select2 ? window.PTC_I18N.select2.inputTooLong(args) : 'Please delete some characters'; }
        }
    };

    if (dropdownParent) {
        config.dropdownParent = $(dropdownParent);
    }

    const dir = document.documentElement.getAttribute('data-textdirection') || 'ltr';
    config.dir = dir;

    // Initialize Select2
    const $select = $(selector);
    $select.select2(config);

    // --- Professional Reset Logic ---
    const $wrapper = $select.closest('.premium-input-wrapper');
    if ($wrapper.length) {
        // Remove any existing reset button first
        $wrapper.find('.select2-custom-reset').remove();

        // Create the reset button as a span to avoid global <i> tag CSS overrides
        const $resetBtn = $('<span class="la la-times select2-custom-reset"></span>');
        $wrapper.append($resetBtn);

        // Function to toggle visibility
        const toggleReset = () => {
            if ($select.val()) {
                $resetBtn.addClass('visible');
            } else {
                $resetBtn.removeClass('visible');
            }
        };

        // Event listeners
        $select.on('change.select2-reset select2:select.select2-reset select2:unselect.select2-reset select2:clear.select2-reset', toggleReset);
        
        $resetBtn.on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $select.val(null).trigger('change');
        });

        // Initial check
        toggleReset();
    }
}

// Auto-initialize elements with .select2-autocomplete class on page load
$(document).ready(function() {
    $('.select2-autocomplete').each(function() {
        var $el = $(this);
        var url = $el.data('url');
        var placeholder = $el.data('placeholder') || 'Select...';
        if (url) {
            initGenericSelect2($el, url, placeholder);
        }
    });
});
