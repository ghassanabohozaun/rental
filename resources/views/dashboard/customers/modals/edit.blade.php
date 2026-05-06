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
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center" id="editModalLabel">
                        <i class="fas fa-edit text-primary mr-2 icon-size-18"></i> {!! __('customers.edit_customer') !!}
                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body my-2">
                    <div class="row">
                        @include('dashboard.customers.modals.parts._personal_info', ['mode' => 'edit'])
                        @include('dashboard.customers.modals.parts._contact_info', ['mode' => 'edit'])
                        @include('dashboard.customers.modals.parts._address_notes', ['mode' => 'edit'])
                    </div>
                </div>
                <!--end::modal body-->

                <div class="modal-footer border-0 pt-0">
                    <button type="submit" id="saveBtn"
                        class="btn btn-premium-save shadow-pulse px-4 font-weight-bold h-42 radius-10">
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
            if ($('#company_id_edit').length) {
                $('#company_id_edit').select2({
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
                var email = $(this).data('email');
                var id_number = $(this).data('id_number');
                var address = $(this).data('address');
                var nationality_id = $(this).data('nationality_id');
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
                $('#nationality_id_edit').val(nationality_id).trigger('change');
                $('#tenant_type_edit').val(tenant_type).trigger('change');
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
                    var select = $('#company_id_edit');
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
