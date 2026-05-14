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
            <div class="modal-content border-0">

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
                <div class="modal-body my-2">
                    <input type="hidden" name="id" id="edit_id">

                    <div class="row">
                        <!-- Company -->
                        @if(user()->company_id == 1)
                            <div class="col-md-12 mb-1">
                                <div class="premium-form-group">
                                    <label for="edit_company_id">{!! __('companies.company') !!} <span class="text-danger">*</span></label>
                                    <div class="premium-input-wrapper">
                                        <select class="form-control premium-input shadow-none" id='edit_company_id' name="company_id">
                                            <option value="">{!! __('general.select_from_list') !!}</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                        <i class="fas fa-briefcase text-primary"></i>
                                    </div>
                                    <span class="text-danger error-text company_id_error"></span>
                                </div>
                            </div>
                        @endif

                        <!-- Name AR -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="edit_name_ar">{!! __('owners.name') !!} ({!! __('general.ar') !!}) <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="edit_name_ar"
                                    name="name[ar]" placeholder="{!! __('owners.name') !!} ({!! __('general.ar') !!})" autocomplete="off">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <span class="text-danger error-text name_ar_error"></span>
                            </div>
                        </div>

                        <!-- Name EN -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="edit_name_en">{!! __('owners.name') !!} ({!! __('general.en') !!}) <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="edit_name_en"
                                    name="name[en]" placeholder="{!! __('owners.name') !!} ({!! __('general.en') !!})" autocomplete="off">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <span class="text-danger error-text name_en_error"></span>
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="edit_type">{!! __('owners.type') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none" id="edit_type" name="type">
                                        <option value="" disabled>{!! __('general.select_from_list') !!}</option>
                                        @foreach(__('owners.owner_types') as $key => $value)
                                            <option value="{!! $key !!}">{!! $value !!}</option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-tags text-primary"></i>
                                </div>
                                <span class="text-danger error-text type_error"></span>
                            </div>
                        </div>

                        <!-- Identification Number -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="edit_identification_number">{!! __('owners.identification_number') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="edit_identification_number"
                                    name="identification_number" placeholder="{!! __('owners.identification_number') !!}" autocomplete="off">
                                    <i class="fas fa-id-card text-primary"></i>
                                </div>
                                <span class="text-danger error-text identification_number_error"></span>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-12 mb-1">
                            <div class="premium-form-group">
                                <label for="edit_phone">{!! __('owners.phone') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none text-left" id="edit_phone"
                                    name="phone" placeholder="{!! __('owners.phone') !!}" dir="ltr" autocomplete="off">
                                    <i class="fas fa-phone text-primary"></i>
                                </div>
                                <span class="text-danger error-text phone_error"></span>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="edit_email">{!! __('owners.email') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="email" class="form-control premium-input shadow-none" id="edit_email"
                                    name="email" placeholder="{!! __('owners.email') !!}" autocomplete="off">
                                    <i class="fas fa-envelope text-primary"></i>
                                </div>
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="edit_address">{!! __('owners.address') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="edit_address"
                                    name="address" placeholder="{!! __('owners.address') !!}" autocomplete="off">
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                </div>
                                <span class="text-danger error-text address_error"></span>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="col-md-12 mb-1">
                            <div class="premium-form-group">
                                <label for="edit_notes">{!! __('owners.notes') !!}</label>
                                <div class="premium-input-wrapper">
                                    <textarea class="form-control premium-input shadow-none" id="edit_notes" name="notes" rows="4" placeholder="{!! __('owners.notes') !!}"></textarea>
                                    <i class="fas fa-info-circle text-primary"></i>
                                </div>
                                <span class="text-danger error-text notes_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <div class="modal-footer border-0 pt-0">
                    <button type="submit" id="editSaveBtn" class="btn btn-premium-save shadow-pulse px-4 font-weight-bold h-42 radius-10" style="min-width: 120px;">
                        <i class="fas fa-save"></i> {{ __('general.save') }}
                        <i class="fas fa-sync fa-spin spinner_loading d-none ml-1"></i>
                    </button>

                    <button type="button" class="btn btn-premium-secondary px-4 font-weight-bold h-42 radius-10"
                        data-dismiss="modal" style="min-width: 120px;">
                        <i class="fas fa-times-circle mr-1"></i> {{ __('general.cancel') }}
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
        if ($('#edit_company_id').length) {
            $('#edit_company_id').select2({
                dropdownParent: $('#editModal'),
                width: '100%',
                dir: $('html').attr('data-textdirection') || 'ltr'
            });
        }
        if ($('#edit_type').length) {
            $('#edit_type').select2({
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
            $('#edit_name_ar').val(name_ar);
            $('#edit_name_en').val(name_en);
            $('#edit_phone').val(phone);
            $('#edit_identification_number').val(identification_number);
            $('#edit_type').val(type).trigger('change');
            $('#edit_email').val(email);
            $('#edit_address').val(address);
            $('#edit_notes').val(notes);
            
            // Set form action
            $('#edit_form').attr('action', url);

            // Handle Company Select2 for Super Admin
            @if(user()->company_id == 1)
                var company_id = $(this).data('company_id');
                var select = $('#edit_company_id');
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


