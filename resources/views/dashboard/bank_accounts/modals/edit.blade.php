<div class="modal modal-pop" id="editBankAccountModal" tabindex="-1" role="dialog" data-backdrop="static"
    data-keyboard="false" aria-labelledby="editBankAccountModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="" method="POST" enctype="multipart/form-data"
            id='edit_bank_account_form' novalidate data-success-msg="{!! __('general.update_success_message') !!}"
            data-success-action="reload-table" data-table-id="#table_data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit_id">

            <div class="modal-content shadow-lg premium-modal-content">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center"
                        id="editBankAccountModalLabel">
                        <i class="fas fa-edit text-primary mr-2 icon-size-18"></i> {!! __('bank_accounts.update_bank_account') !!}
                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body my-2">
                    @if (isset($companies))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="premium-form-group">
                                    <label for="company_id_bank_edit">{!! __('companies.company') !!} <span
                                            class="text-danger">*</span></label>
                                    <div class="premium-input-wrapper">
                                        <select class="form-control premium-input shadow-none" id='company_id_bank_edit'
                                            name="company_id">
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
                        </div>
                    @endif

                    <div class="row">
                        <!-- Bank Name Arabic -->
                        <div class="col-md-6">
                            <div class="premium-form-group">
                                <label for="bank_name_ar_edit">{!! __('bank_accounts.bank_name_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="bank_name_ar_edit" name="bank_name[ar]"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="{!! __('bank_accounts.enter_bank_name_ar') !!}">
                                    <i class="fas fa-university text-primary"></i>
                                </div>
                                <span class="text-danger error-text bank_name_ar_error"></span>
                            </div>
                        </div>

                        <!-- Bank Name English -->
                        <div class="col-md-6">
                            <div class="premium-form-group">
                                <label for="bank_name_en_edit">{!! __('bank_accounts.bank_name_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="bank_name_en_edit" name="bank_name[en]"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="{!! __('bank_accounts.enter_bank_name_en') !!}">
                                    <i class="fas fa-university text-primary"></i>
                                </div>
                                <span class="text-danger error-text bank_name_en_error"></span>
                            </div>
                        </div>

                        <!-- Account Holder Arabic -->
                        <div class="col-md-6">
                            <div class="premium-form-group">
                                <label for="account_holder_name_ar_edit">{!! __('bank_accounts.account_holder_name_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="account_holder_name_ar_edit"
                                        name="account_holder_name[ar]" class="form-control premium-input shadow-none"
                                        autocomplete="off" placeholder="{!! __('bank_accounts.enter_account_holder_name_ar') !!}">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <span class="text-danger error-text account_holder_name_ar_error"></span>
                            </div>
                        </div>

                        <!-- Account Holder English -->
                        <div class="col-md-6">
                            <div class="premium-form-group">
                                <label for="account_holder_name_en_edit">{!! __('bank_accounts.account_holder_name_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="account_holder_name_en_edit"
                                        name="account_holder_name[en]" class="form-control premium-input shadow-none"
                                        autocomplete="off" placeholder="{!! __('bank_accounts.enter_account_holder_name_en') !!}">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <span class="text-danger error-text account_holder_name_en_error"></span>
                            </div>
                        </div>

                        <!-- Account Number -->
                        <div class="col-md-6">
                            <div class="premium-form-group">
                                <label for="account_number_edit">{!! __('bank_accounts.account_number') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="account_number_edit" name="account_number"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="{!! __('bank_accounts.enter_account_number') !!}">
                                    <i class="fas fa-hashtag text-primary"></i>
                                </div>
                                <span class="text-danger error-text account_number_error"></span>
                            </div>
                        </div>

                        <!-- IBAN -->
                        <div class="col-md-6">
                            <div class="premium-form-group">
                                <label for="iban_edit">{!! __('bank_accounts.iban') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="iban_edit" name="iban"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="{!! __('bank_accounts.enter_iban') !!}">
                                    <i class="fas fa-barcode text-primary"></i>
                                </div>
                                <span class="text-danger error-text iban_error"></span>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <label for="is_default_edit" class="premium-switch-container"
                                style="display: flex !important; justify-content: space-between !important; align-items: center !important; flex-direction: row !important; width: 100% !important;">
                                <div class="premium-switch-content"
                                    style="display: flex !important; align-items: center !important; gap: 1rem !important;">
                                    <div class="premium-switch-icon-circle text-warning shadow-sm">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="premium-switch-texts">
                                        <h6 class="premium-switch-title mb-1">{!! __('bank_accounts.is_default') !!}</h6>
                                        <span class="premium-switch-subtitle">{!! __('bank_accounts.set_as_default') !!}</span>
                                    </div>
                                </div>
                                <label class="modern-switch" style="flex-shrink: 0 !important;">
                                    <input type="checkbox" id="is_default_edit" name="is_default">
                                    <span class="modern-slider"></span>
                                </label>
                            </label>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <!--begin::modal footer-->
                <div class="modal-footer border-0 pt-0 mt-3">
                    <button type="submit" id="updateBtn"
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
            if ($('#company_id_bank_edit').length) {
                $('#company_id_bank_edit').select2({
                    dropdownParent: $('#editBankAccountModal'),
                    width: '100%',
                    dir: $('html').attr('data-textdirection') || 'ltr'
                });
            }

            $(document).on('click', '.editBankAccountBtn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var bank_name_ar = $(this).data('bank_name_ar');
                var bank_name_en = $(this).data('bank_name_en');
                var account_holder_name_ar = $(this).data('account_holder_name_ar');
                var account_holder_name_en = $(this).data('account_holder_name_en');
                var account_number = $(this).data('account_number');
                var iban = $(this).data('iban');
                var is_default = $(this).data('is_default');
                var company_id = $(this).data('company_id');
                var company_name = $(this).data('company_name');

                $('#edit_id').val(id);
                $('#bank_name_ar_edit').val(bank_name_ar);
                $('#bank_name_en_edit').val(bank_name_en);
                $('#account_holder_name_ar_edit').val(account_holder_name_ar);
                $('#account_holder_name_en_edit').val(account_holder_name_en);
                $('#account_number_edit').val(account_number);
                $('#iban_edit').val(iban);

                if (is_default == 1) {
                    $('#is_default_edit').prop('checked', true);
                } else {
                    $('#is_default_edit').prop('checked', false);
                }

                if ($('#company_id_bank_edit').length) {
                    if (company_id) {
                        $('#company_id_bank_edit').val(company_id).trigger('change');
                    } else {
                        $('#company_id_bank_edit').val(null).trigger('change');
                    }
                }

                var actionUrl = "{!! route('dashboard.bank-accounts.update', ':id') !!}";
                actionUrl = actionUrl.replace(':id', id);
                $('#edit_bank_account_form').attr('action', actionUrl);

                $('#editBankAccountModal').modal('show');
            });
        });
    </script>
@endpush
