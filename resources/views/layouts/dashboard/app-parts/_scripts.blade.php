    <script src="{!! asset('assets/dashbaord') !!}/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        // PTC Select2 I18N Bridge - Defined early for global access
        window.PTC_I18N = {
            select2: {
                searching: function() {
                    return "{{ __('general.searching') }}";
                },
                noResults: function() {
                    return "{{ __('general.noResults2') }}";
                },
                errorLoading: function() {
                    return "{{ __('general.errorLoading') }}";
                },
                inputTooShort: function(args) {
                    return "{{ __('general.inputTooShort') }}";
                },
                inputTooLong: function(args) {
                    return "{{ __('general.inputTooLong') }}";
                }
            },
            common: {
                access_denied: "{{ __('dashboard.access_denied') }}",
                error: "{{ __('general.error') }}",
                something_went_wrong: "{{ __('general.try_catch_error_message') }}"
            }
        };
    </script>
    <script src="{!! asset('assets/dashbaord') !!}/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>

    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{!! asset('assets/dashbaord/vendors/js/charts/apexcharts.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('assets/dashbaord/vendors/js/charts/raphael-min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('assets/dashbaord/vendors/js/charts/morris.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('assets/dashbaord/vendors/js/timeline/horizontal-timeline.js') !!}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="{!! asset('assets/dashbaord') !!}/js/core/app-menu.js" type="text/javascript"></script>
    <script src="{!! asset('assets/dashbaord') !!}/js/core/app.js" type="text/javascript"></script>
    <script src="{!! asset('assets/dashbaord') !!}/js/scripts/customizer.js" type="text/javascript"></script>
    <!-- END MODERN JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{!! asset('assets/dashbaord') !!}/js/scripts/extensions/sweet-alerts.js" type="text/javascript"></script>
    <script src="{!! asset('assets/dashbaord') !!}/js/scripts/my-scripts.js" type="text/javascript"></script>
    <script src="{!! asset('vendor/flasher/flasher.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('vendor/summernote/summernote.js') !!}"></script>

    <!-- Bootstrap Datepicker JS [NEW SYSTEM STANDARD] -->
    <script src="{{ asset('assets/dashbaord/vendors/js/pickers/bootstrap-datepicker/bootstrap-datepicker.min.js') }}">
    </script>
    @if (Lang() == 'ar')
        <script
            src="{{ asset('assets/dashbaord/vendors/js/pickers/bootstrap-datepicker/locales/bootstrap-datepicker.ar.min.js') }}">
        </script>
    @endif
    <script src="{{ asset('assets/dashbaord/js/datepicker-initializer.js') }}?v={{ time() }}"></script>

    <!-- Select2 Vendor JS -->
    <script src="{{ asset('assets/dashbaord/vendors/js/forms/select/select2.full.min.js') }}"></script>


    {{--  file input --}}
    <script src="{!! asset('vendor/fileInput/js/fileinput.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('vendor/fileInput/themes/fa5/theme.min.js') !!}" type="text/javascript"></script>

    @if (Lang() == 'ar')
        <script src="{!! asset('vendor/fileInput/js/locales/LANG.js') !!}" type="text/javascript"></script>
        <script src="{!! asset('vendor/fileInput/js/locales/ar.js') !!}" type="text/javascript"></script>
    @endif
    <script src="{!! asset('assets/dashbaord/js/ajax-table.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('assets/dashbaord/js/premium-ajax-form.js') !!}?v={{ time() }}" type="text/javascript"></script>
    <script src="{!! asset('assets/dashbaord/js/generic-select2.js') !!}?v={{ time() }}" type="text/javascript"></script>
    {{-- end dataTables --}}
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Global Password Visibility Toggle
        function togglePassword(inputId, icon) {
            var input = document.getElementById(inputId);
            if (!input) return;
            
            var isPassword = input.type === "password";
            input.type = isPassword ? "text" : "password";

            // Update icons in the same wrapper
            var wrapper = icon.parentElement;
            if (wrapper) {
                var icons = wrapper.getElementsByTagName('i');
                for (var i = 0; i < icons.length; i++) {
                    var ico = icons[i];
                    if (ico.classList.contains('la-lock') || ico.classList.contains('la-unlock-alt')) {
                        ico.className = isPassword ? 'la la-unlock-alt text-primary' : 'la la-lock text-primary';
                    } else if (ico.classList.contains('la-eye') || ico.classList.contains('la-eye-slash')) {
                        ico.className = isPassword ? 'la la-eye-slash pointer text-primary premium-icon-opposite' : 'la la-eye pointer text-primary premium-icon-opposite';
                    }
                }
            }
        }
    </script>

    <!-- BFCache Fix: Force reload on browser back button to prevent broken layouts -->
    <script>
        window.addEventListener("pageshow", function(event) {
            var historyTraversal = event.persisted ||
                (typeof window.performance != "undefined" &&
                    window.performance.navigation.type === 2);
            if (historyTraversal) {
                window.location.reload();
            }
        });
    </script>
