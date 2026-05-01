<div class="modal modal-pop fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="" method="POST" id='edit_form' novalidate
            data-success-msg="{!! __('general.update_success_message') !!}" data-success-action="reload-table" data-row-prefix="row">
            @csrf
            @method('PUT')
            <div class="modal-content border-0">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-dark" id="editModalLabel">
                        <i class="la la-edit mr-1 text-primary" style="font-size: 22px;"></i> {!! __('customers.edit_customer') !!}
                    </h5>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="la la-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body my-2">
                    <div class="row">
                        <!-- Company -->
                        @if (user()->company_id == 1)
                            <div class="col-md-12 mb-1">
                                <div class="premium-form-group">
                                    <label for="company_id_edit">{!! __('companies.company') !!} <span
                                            class="text-danger">*</span></label>
                                    <div class="premium-input-wrapper">
                                        <select
                                            class="form-control premium-input shadow-none js-select2 js-autocomplete"
                                            id='company_id_edit' name="company_id" data-url="{!! route('dashboard.companies.autocomplete') !!}"
                                            data-placeholder="{!! __('general.select_company') !!}" data-parent="#editModal">
                                            <option></option>
                                        </select>
                                    </div>
                                    <span class="error-text company_id_error text-danger small"></span>
                                </div>
                            </div>
                        @endif

                        <!-- Name AR -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="name_ar_edit">{!! __('customers.name_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none"
                                        id="name_ar_edit" name="name[ar]" placeholder="{!! __('customers.name_ar') !!}"
                                        autocomplete="off">
                                    <i class="la la-user text-primary"></i>
                                </div>
                                <span class="error-text name_ar_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Name EN -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="name_en_edit">{!! __('customers.name_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none"
                                        id="name_en_edit" name="name[en]" placeholder="{!! __('customers.name_en') !!}"
                                        autocomplete="off">
                                    <i class="la la-user text-primary"></i>
                                </div>
                                <span class="error-text name_en_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="phone_edit">{!! __('customers.phone') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none text-left"
                                        id="phone_edit" name="phone" placeholder="{!! __('customers.phone') !!}"
                                        dir="ltr" autocomplete="off">
                                    <i class="la la-phone text-primary"></i>
                                </div>
                                <span class="error-text phone_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="email_edit">{!! __('customers.email') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="email" class="form-control premium-input shadow-none text-left"
                                        id="email_edit" name="email" placeholder="{!! __('customers.email') !!}"
                                        dir="ltr" autocomplete="off">
                                    <i class="la la-at text-primary"></i>
                                </div>
                                <span class="error-text email_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- ID Number -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="id_number_edit">{!! __('customers.id_number') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none"
                                        id="id_number_edit" name="id_number" placeholder="{!! __('customers.id_number') !!}"
                                        autocomplete="off">
                                    <i class="la la-credit-card text-primary"></i>
                                </div>
                                <span class="error-text id_number_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Nationality -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="nationality_edit">{!! __('customers.nationality') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none"
                                        id="nationality_edit" name="nationality"
                                        placeholder="{!! __('customers.nationality') !!}" autocomplete="off">
                                    <i class="la la-flag text-primary"></i>
                                </div>
                                <span class="error-text nationality_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Tenant Type -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="tenant_type_edit">{!! __('customers.tenant_type') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none" id="tenant_type_edit"
                                        name="tenant_type">
                                        <option value="individual">{!! __('customers.individual') !!}</option>
                                        <option value="company">{!! __('customers.company') !!}</option>
                                    </select>
                                    <i class="la la-tags text-primary"></i>
                                </div>
                                <span class="error-text tenant_type_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Guarantor -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="guarantor_id_edit">{!! __('customers.guarantor') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper no-icon">
                                    <select class="form-control premium-input shadow-none select2-autocomplete"
                                        id='guarantor_id_edit' name="guarantor_id"
                                        data-placeholder="{!! __('general.select_from_list') !!}"
                                        data-url="{!! route('dashboard.guarantors.autocomplete') !!}"
                                        data-simple="true"
                                        required>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <span class="error-text guarantor_id_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-md-12 mb-1">
                            <div class="premium-form-group">
                                <label for="address_edit">{!! __('customers.address') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none"
                                        id="address_edit" name="address" placeholder="{!! __('customers.address') !!}"
                                        autocomplete="off">
                                    <i class="la la-map-marker text-primary"></i>
                                </div>
                                <span class="error-text address_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="col-md-12 mb-1">
                            <div class="premium-form-group">
                                <label for="notes_edit">{!! __('customers.notes') !!}</label>
                                <div class="premium-input-wrapper no-icon">
                                    <textarea class="form-control premium-input shadow-none" id="notes_edit" name="notes" rows="1"
                                        placeholder="{!! __('customers.notes') !!}"></textarea>
                                </div>
                                <span class="error-text notes_error text-danger small"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <div class="modal-footer border-0 pt-0">
                    <button type="submit" id="saveBtn"
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
    <script>
        $(document).ready(function() {
            // Handle edit button click
            $(document).on('click', '.js-edit-btn', function() {
                var id = $(this).data('id');
                var name_ar = $(this).data('name_ar');
                var name_en = $(this).data('name_en');
                var phone = $(this).data('phone');
                var email = $(this).data('email');
                var id_number = $(this).data('id_number');
                var address = $(this).data('address');
                var nationality = $(this).data('nationality');
                var tenant_type = $(this).data('tenant_type');
                var notes = $(this).data('notes');
                var url = $(this).data('url');

                // Populate inputs
                $('#edit_id').val(id);
                $('#name_ar_edit').val(name_ar);
                $('#name_en_edit').val(name_en);
                $('#phone_edit').val(phone);
                $('#email_edit').val(email);
                $('#id_number_edit').val(id_number);
                $('#address_edit').val(address);
                $('#nationality_edit').val(nationality);
                $('#tenant_type_edit').val(tenant_type);
                $('#notes_edit').val(notes);

                // Set form action
                $('#edit_form').attr('action', url);

                // Handle Guarantor Select2
                var guarantor_id = $(this).data('guarantor_id');
                var guarantor_name = $(this).data('guarantor');
                var guarantorSelect = $('#guarantor_id_edit');
                guarantorSelect.empty();
                if (guarantor_id) {
                    var option = new Option(guarantor_name, guarantor_id, true, true);
                    guarantorSelect.append(option).trigger('change');
                } else {
                    guarantorSelect.trigger('change');
                }

                // Handle Company Select2 for Super Admin
                @if (user()->company_id == 1)
                    var company_id = $(this).data('company_id');
                    var company_name = $(this).data('company');
                    var select = $('#company_id_edit');
                    select.empty();
                    if (company_id) {
                        var option = new Option(company_name, company_id, true, true);
                        select.append(option).trigger('change');
                    } else {
                        select.trigger('change');
                    }
                @endif
            });
        });
    </script>
@endpush
