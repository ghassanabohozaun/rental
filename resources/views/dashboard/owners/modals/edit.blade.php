<div class="modal modal-pop" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="" method="POST"
            id='edit_form' novalidate
            data-success-msg="{!! __('general.update_success_message') !!}"
            data-success-action="reload-table"
            data-table-id="#table_data">
            @csrf
            @method('PUT')
            <div class="modal-content premium-modal-content">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center" id="editModalLabel">
                        <i class="fas fa-edit text-primary mr-2 icon-size-18"></i> {!! __('owners.edit_owner') !!}
                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body mt-2 mb-0">
                    <input type="hidden" name="id" id="edit_id">

                    <div class="row">
                        <!-- Company -->
                        @if(user()->company_id == 1)
                            <div class="col-md-12 mb-1">
                                <div class="premium-form-group">
                                    <label class="premium-label" for="company_id_edit"><i class="fas fa-building mr-1 text-primary"></i> {!! __('companies.company') !!} <span class="text-danger">*</span></label>
                                    <select class="form-control premium-input shadow-none select2" id='company_id_edit' name="company_id">
                                        <option value="" selected>{!! __('general.select_from_list') !!}</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text company_id_error"></span>
                                </div>
                            </div>
                        @endif

                        <!-- Name AR -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="name_ar_edit"><i class="fas fa-user mr-1 text-primary"></i> {!! __('owners.name') !!} ({!! __('general.ar') !!}) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none" id="name_ar_edit"
                                    name="name[ar]" placeholder="{!! __('owners.name') !!} ({!! __('general.ar') !!})" autocomplete="off">
                                <span class="text-danger error-text name_ar_error"></span>
                            </div>
                        </div>

                        <!-- Name EN -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="name_en_edit"><i class="fas fa-user mr-1 text-primary"></i> {!! __('owners.name') !!} ({!! __('general.en') !!}) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none" id="name_en_edit"
                                    name="name[en]" placeholder="{!! __('owners.name') !!} ({!! __('general.en') !!})" autocomplete="off">
                                <span class="text-danger error-text name_en_error"></span>
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="type_edit"><i class="fas fa-tags mr-1 text-primary"></i> {!! __('owners.type') !!} <span class="text-danger">*</span></label>
                                <select class="form-control premium-input shadow-none select2" id="type_edit" name="type">
                                    <option value="" selected>{!! __('general.select_from_list') !!}</option>
                                    @foreach(__('owners.owner_types') as $key => $value)
                                        <option value="{!! $key !!}">{!! $value !!}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text type_error"></span>
                            </div>
                        </div>

                        <!-- Identification Number -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="identification_number_edit"><i class="fas fa-id-card mr-1 text-primary"></i> {!! __('owners.identification_number') !!} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none" id="identification_number_edit"
                                    name="identification_number" placeholder="{!! __('owners.identification_number') !!}" autocomplete="off">
                                <span class="text-danger error-text identification_number_error"></span>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-12 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="phone_edit"><i class="fas fa-phone mr-1 text-primary"></i> {!! __('owners.phone') !!}</label>
                                <input type="text" class="form-control premium-input shadow-none text-left" id="phone_edit"
                                    name="phone" placeholder="{!! __('owners.phone') !!}" dir="ltr" autocomplete="off">
                                <span class="text-danger error-text phone_error"></span>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="email_edit"><i class="fas fa-envelope mr-1 text-primary"></i> {!! __('owners.email') !!}</label>
                                <input type="email" class="form-control premium-input shadow-none" id="email_edit"
                                    name="email" placeholder="{!! __('owners.email') !!}" autocomplete="off">
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="address_edit"><i class="fas fa-map-marker-alt mr-1 text-primary"></i> {!! __('owners.address') !!}</label>
                                <input type="text" class="form-control premium-input shadow-none" id="address_edit"
                                    name="address" placeholder="{!! __('owners.address') !!}" autocomplete="off">
                                <span class="text-danger error-text address_error"></span>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="col-md-12 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="notes_edit"><i class="fas fa-sticky-note mr-1 text-primary"></i> {!! __('owners.notes') !!}</label>
                                <textarea class="form-control premium-input shadow-none" id="notes_edit" name="notes" rows="4" placeholder="{!! __('owners.notes') !!}"></textarea>
                                <span class="text-danger error-text notes_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <div class="modal-footer border-0 pt-0 premium-modal-footer">
                    <button type="submit" id="editSaveBtn" class="btn btn-premium-save font-weight-bold">
                        <i class="fas fa-save mr-2"></i>
                        <i class="fas fa-spinner fa-spin d-none spinner_loading mr-2"></i>
                        {{ __('general.save') }}
                    </button>

                    <button type="button" class="btn btn-premium-secondary font-weight-bold"
                        data-dismiss="modal">
                        <i class="fas fa-times-circle mr-2"></i> {{ __('general.cancel') }}
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
        if ($('#company_id_edit').length) {
            $('#company_id_edit').select2({
                dropdownParent: $('#editModal'),
                width: '100%',
                dir: $('html').attr('data-textdirection') || 'ltr'
            });
        }
        if ($('#type_edit').length) {
            $('#type_edit').select2({
                dropdownParent: $('#editModal'),
                width: '100%',
                dir: $('html').attr('data-textdirection') || 'ltr'
            });
        }

        // Handle edit button click
        $(document).on('click', '.js-edit-btn', function() {
            var id = $(this).data('id');
            var name_ar = $(this).data('name_ar');
            var name_en = $(this).data('name_en');
            var phone = $(this).data('phone');
            var identification_number = $(this).data('identification_number');
            var type = $(this).data('type');
            var type = $(this).data('type');
            var email = $(this).data('email');
            var address = $(this).data('address');
            var notes = $(this).data('notes');
            var url = $(this).data('url');

            // Populate inputs
            $('#edit_id').val(id);
            $('#name_ar_edit').val(name_ar);
            $('#name_en_edit').val(name_en);
            $('#phone_edit').val(phone);
            $('#identification_number_edit').val(identification_number);
            $('#type_edit').val(type).trigger('change');
            $('#email_edit').val(email);
            $('#address_edit').val(address);
            $('#notes_edit').val(notes);
            
            // Set form action
            $('#edit_form').attr('action', url);

            // Handle Company Select2 for Super Admin
            @if(user()->company_id == 1)
                var company_id = $(this).data('company_id');
                var select = $('#company_id_edit');
                if (company_id) {
                    select.val(company_id).trigger('change');
                } else {
                    select.val('').trigger('change');
                }
            @endif
        });
        // Clear state on input
        $(document).on('input change', '#edit_form .premium-input, #edit_form select', function() {
            const $wrapper = $(this).closest('.premium-input-wrapper');
            if ($wrapper.hasClass('is-invalid-premium')) {
                $wrapper.removeClass('is-invalid-premium');
                // Handle Select2
                if ($(this).hasClass('select2-hidden-accessible')) {
                    $(this).next('.select2-container').find('.select2-selection').removeClass('is-invalid-premium');
                }
            }
        });
    });
</script>
@endpush


