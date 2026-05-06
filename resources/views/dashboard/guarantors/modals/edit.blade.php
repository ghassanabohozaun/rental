<div class="modal modal-pop fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">

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
                        <i class="fas fa-edit text-primary mr-2 icon-size-18"></i> {!! __('guarantors.edit_guarantor') !!}
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
                                    <span class="error-text company_id_error text-danger small"></span>
                                </div>
                            </div>
                        @endif

                        <!-- Name AR -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="edit_name_ar">{!! __('guarantors.name') !!} ({!! __('general.ar') !!}) <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="edit_name_ar"
                                    name="name[ar]" placeholder="{!! __('guarantors.name') !!} ({!! __('general.ar') !!})" autocomplete="off">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <span class="error-text name_ar_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Name EN -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="edit_name_en">{!! __('guarantors.name') !!} ({!! __('general.en') !!}) <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="edit_name_en"
                                    name="name[en]" placeholder="{!! __('guarantors.name') !!} ({!! __('general.en') !!})" autocomplete="off">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <span class="error-text name_en_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="edit_phone">{!! __('guarantors.phone') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none text-left" id="edit_phone"
                                    name="phone" placeholder="{!! __('guarantors.phone') !!}" dir="ltr" autocomplete="off">
                                    <i class="fas fa-phone text-primary"></i>
                                </div>
                                <span class="error-text phone_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- ID Number -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="edit_id_number">{!! __('guarantors.id_number') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="edit_id_number"
                                    name="id_number" placeholder="{!! __('guarantors.id_number') !!}" autocomplete="off">
                                    <i class="fas fa-credit-card text-primary"></i>
                                </div>
                                <span class="error-text id_number_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Relationship -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="edit_relationship">{!! __('guarantors.relationship') !!}</label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none" id="edit_relationship" name="relationship">
                                        <option value="" disabled>{!! __('general.select_from_list') !!}</option>
                                        @foreach(__('guarantors.relationships') as $key => $value)
                                            <option value="{!! $value !!}">{!! $value !!}</option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-users text-primary"></i>
                                </div>
                                <span class="error-text relationship_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="edit_address">{!! __('guarantors.address') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="edit_address"
                                    name="address" placeholder="{!! __('guarantors.address') !!}" autocomplete="off">
                                    <i class="fas fa-map-marker text-primary"></i>
                                </div>
                                <span class="error-text address_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="col-md-12 mb-1">
                            <div class="premium-form-group">
                                <label for="edit_notes">{!! __('guarantors.notes') !!}</label>
                                <div class="premium-input-wrapper no-icon">
                                    <textarea class="form-control premium-input shadow-none" id="edit_notes" name="notes" rows="4" placeholder="{!! __('guarantors.notes') !!}"></textarea>
                                </div>
                                <span class="error-text notes_error text-danger small"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <div class="modal-footer border-0 pt-0">
                    <button type="submit" id="editSaveBtn" class="btn btn-premium-save shadow-pulse px-4 font-weight-bold h-42 radius-10">
                        <i class="fas fa-save"></i> {{ __('general.save') }}
                        <i class="fas fa-sync fa-spin spinner_loading d-none ml-1"></i>
                    </button>

                    <button type="button" class="btn btn-premium-secondary px-4 font-weight-bold h-42 radius-10"
                        data-dismiss="modal">
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

        // Handle edit button click
        $(document).on('click', '.js-edit-btn', function() {
            var id = $(this).data('id');
            var name_ar = $(this).data('name_ar');
            var name_en = $(this).data('name_en');
            var phone = $(this).data('phone');
            var id_number = $(this).data('id_number');
            var address = $(this).data('address');
            var relationship = $(this).data('relationship');
            var notes = $(this).data('notes');
            var url = $(this).data('url');

            // Populate inputs
            $('#edit_id').val(id);
            $('#edit_name_ar').val(name_ar);
            $('#edit_name_en').val(name_en);
            $('#edit_phone').val(phone);
            $('#edit_id_number').val(id_number);
            $('#edit_address').val(address);
            $('#edit_relationship').val(relationship);
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
    });
</script>
@endpush
