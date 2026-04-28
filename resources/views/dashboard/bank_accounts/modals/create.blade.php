<div class="modal modal-pop fade" id="createBankAccountModal" tabindex="-1" role="dialog"
    aria-labelledby="createBankAccountModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="{!! route('dashboard.bank-accounts.store') !!}" method="POST" enctype="multipart/form-data"
            id='create_bank_account_form' novalidate
            data-success-msg="{!! __('general.add_success_message') !!}"
            data-success-action="reload-table"
            data-table-id="#table_data">
            @csrf
            <div class="modal-content shadow-lg border-0" style="border-radius: 20px;">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-dark" id="createBankAccountModalLabel">
                        <i class="la la-plus-circle mr-1 text-primary" style="font-size: 22px;"></i> {!! __('bank_accounts.create_new_bank_account') !!}
                    </h5>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="la la-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body">
                    <div class="row">
                        <!-- Bank Name Arabic -->
                        <div class="col-md-6">
                            <div class="premium-form-group">
                                <label for="bank_name_ar_create">{!! __('bank_accounts.bank_name_ar') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="bank_name_ar_create" name="bank_name[ar]"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="{!! __('bank_accounts.enter_bank_name_ar') !!}">
                                    <i class="la la-bank text-primary"></i>
                                </div>
                                <span class="error-text bank_name_ar_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Bank Name English -->
                        <div class="col-md-6">
                            <div class="premium-form-group">
                                <label for="bank_name_en_create">{!! __('bank_accounts.bank_name_en') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="bank_name_en_create" name="bank_name[en]"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="{!! __('bank_accounts.enter_bank_name_en') !!}">
                                    <i class="la la-bank text-primary"></i>
                                </div>
                                <span class="error-text bank_name_en_error text-danger small"></span>
                            </div>
                        </div>
                        
                        <!-- Account Holder Arabic -->
                        <div class="col-md-6">
                            <div class="premium-form-group">
                                <label for="account_holder_name_ar_create">{!! __('bank_accounts.account_holder_name_ar') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="account_holder_name_ar_create" name="account_holder_name[ar]"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="{!! __('bank_accounts.enter_account_holder_name_ar') !!}">
                                    <i class="la la-user text-primary"></i>
                                </div>
                                <span class="error-text account_holder_name_ar_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Account Holder English -->
                        <div class="col-md-6">
                            <div class="premium-form-group">
                                <label for="account_holder_name_en_create">{!! __('bank_accounts.account_holder_name_en') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="account_holder_name_en_create" name="account_holder_name[en]"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="{!! __('bank_accounts.enter_account_holder_name_en') !!}">
                                    <i class="la la-user text-primary"></i>
                                </div>
                                <span class="error-text account_holder_name_en_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Account Number -->
                        <div class="col-md-6">
                            <div class="premium-form-group">
                                <label for="account_number_create">{!! __('bank_accounts.account_number') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="account_number_create" name="account_number"
                                        class="form-control premium-input shadow-none" autocomplete="off" dir="ltr"
                                        placeholder="{!! __('bank_accounts.enter_account_number') !!}">
                                    <i class="la la-hashtag text-primary"></i>
                                </div>
                                <span class="error-text account_number_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- IBAN -->
                        <div class="col-md-6">
                            <div class="premium-form-group">
                                <label for="iban_create">{!! __('bank_accounts.iban') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="iban_create" name="iban"
                                        class="form-control premium-input shadow-none" autocomplete="off" dir="ltr"
                                        placeholder="{!! __('bank_accounts.enter_iban') !!}">
                                    <i class="la la-barcode text-primary"></i>
                                </div>
                                <span class="error-text iban_error text-danger small"></span>
                            </div>
                        </div>
                    </div>

                    @if(isset($companies))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="premium-form-group">
                                <label for="company_id_bank_create">{!! __('companies.company') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none" id='company_id_bank_create' name="company_id">
                                        <option value="">{!! __('general.select_from_list') !!}</option>
                                        <!-- Options will be loaded dynamically via AJAX -->
                                    </select>
                                </div>
                                <span class="error-text company_id_error text-danger small"></span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <label for="is_default_create" class="d-flex align-items-center justify-content-between p-3 w-100 cursor-pointer mb-0" style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px; transition: all 0.3s ease;">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center justify-content-center text-warning shadow-sm bg-white" style="width: 45px; height: 45px; border-radius: 10px; margin-inline-end: 15px;">
                                        <i class="la la-star" style="font-size: 24px;"></i>
                                    </div>
                                    <div>
                                        <h6 class="font-weight-bold mb-1 text-dark" style="font-size: 1rem; cursor: pointer;">{!! __('bank_accounts.is_default') !!}</h6>
                                        <span class="text-muted d-block" style="font-size: 0.85rem;">{!! __('bank_accounts.set_as_default') !!}</span>
                                    </div>
                                </div>
                                <div class="custom-control custom-switch premium-switch mx-4">
                                    <input type="checkbox" class="custom-control-input" id="is_default_create" name="is_default">
                                    <span class="custom-control-label m-0 cursor-pointer" style="width: 3.5rem; height: 1.65rem; display: inline-block;"></span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <!--begin::modal footer-->
                <div class="modal-footer border-0 pt-0 mt-3">
                    <button type="submit" id="saveBtn" class="btn btn-premium-add px-4 font-weight-bold h-42 radius-10">
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
            if ($('#company_id_bank_create').length) {
                initGenericSelect2('#company_id_bank_create', '{!! route("dashboard.companies.autocomplete") !!}', '{!! __("general.select_from_list") !!}', '#createBankAccountModal');
            }
        });
    </script>
@endpush
