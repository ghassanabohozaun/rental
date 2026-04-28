<div class="modal modal-pop fade" id="updateDepartmentModal" tabindex="-1" role="dialog"
    aria-labelledby="updateDepartmentModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="" method="POST" enctype="multipart/form-data"
            id='update_department_form' data-success-msg="{!! __('general.update_success_message') !!}" data-success-action="reload-table"
            data-table-id="#table_data" novalidate>
            @csrf
            @method('PUT')
            <div class="modal-content shadow-lg border-0" style="border-radius: 20px;">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-dark" id="updateDepartmentModalLabel">
                        <i class="la la-edit mr-1 text-primary" style="font-size: 22px;"></i> {!! __('departments.update_department') !!}
                    </h5>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="la la-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="id_edit" name="id">

                        <!-- Name Arabic -->
                        <div class="col-md-6">
                            <div class="premium-form-group">
                                <label for="name_ar_edit">{!! __('departments.name_ar') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="name_ar_edit" name="name[ar]"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="{!! __('departments.enter_name_ar') !!}">
                                    <i class="la la-building text-primary"></i>
                                </div>
                                <span class="error-text name_ar_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Name English -->
                        <div class="col-md-6">
                            <div class="premium-form-group">
                                <label for="name_en_edit">{!! __('departments.name_en') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="name_en_edit" name="name[en]"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="{!! __('departments.enter_name_en') !!}">
                                    <i class="la la-building text-primary"></i>
                                </div>
                                <span class="error-text name_en_error text-danger small"></span>
                            </div>
                        </div>
                    </div>

                    @if(isset($companies))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="premium-form-group">
                                <label for="company_id_dept_edit">{!! __('companies.company') !!}</label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none" id='company_id_dept_edit' name="company_id">
                                        <option value="">{!! __('roles.global_role') !!}</option>
                                        <!-- Options will be loaded dynamically via AJAX -->
                                    </select>
                                </div>
                                <span class="error-text company_id_error text-danger small"></span>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <!--end::modal body-->

                <!--begin::modal footer-->
                <div class="modal-footer border-0 pt-0">
                    <button type="submit" id="saveBtnEdit"
                        class="btn btn-premium-add px-4 font-weight-bold h-42 radius-10">
                        <i class="la la-save mr-1"></i> {{ __('general.save') }}
                        <i class="la la-refresh la-spin spinner_loading d-none ml-1"></i>
                    </button>

                    <button type="button" class="btn btn-premium-secondary px-4 font-weight-bold h-42 radius-10"
                        data-dismiss="modal">
                        <i class="la la-times-circle mr-1"></i> {{ __('general.cancel') }}
                    </button>
                </div>
                <!--end::modal footer-->

            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Show edit modal and populate data dynamically
            $('body').on('click', '.edit_department_button', function(e) {
                e.preventDefault();
                
                let department_id = $(this).attr('department-id');
                let department_name_ar = $(this).attr('department-name-ar');
                let department_name_en = $(this).attr('department-name-en');
                let department_company_id = $(this).attr('department-company-id');
                let department_company_name = $(this).attr('department-company-name');

                // Populate form fields
                $('#id_edit').val(department_id);
                $('#name_ar_edit').val(department_name_ar);
                $('#name_en_edit').val(department_name_en);

                // Populate Select2 for Company
                if ($('#company_id_dept_edit').length) {
                    if (department_company_id && department_company_name) {
                        var newOption = new Option(department_company_name, department_company_id, true, true);
                        $('#company_id_dept_edit').append(newOption).trigger('change');
                    } else {
                        $('#company_id_dept_edit').val(null).trigger('change');
                    }
                }

                // Update form action URL dynamically
                let url = "{!! route('dashboard.departments.update', 'id') !!}".replace('id', department_id);
                $('#update_department_form').attr('action', url);
                
                // Show modal
                $('#updateDepartmentModal').modal('show');
            });

            // Initialize Select2
            if ($('#company_id_dept_edit').length) {
                initGenericSelect2('#company_id_dept_edit', '{!! route("dashboard.companies.autocomplete") !!}', '{!! __("general.select_from_list") !!}', '#updateDepartmentModal');
            }
        });
    </script>
@endpush
