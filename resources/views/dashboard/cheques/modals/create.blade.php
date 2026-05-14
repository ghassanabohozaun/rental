<div class="modal modal-pop" id="createModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"
    aria-labelledby="createModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="{!! route('dashboard.cheques.store') !!}" method="POST"
            id='create_form' novalidate
            data-success-msg="{!! __('general.add_success_message') !!}"
            data-success-action="reload-table"
            data-table-id="#table_data">
            @csrf
            <div class="modal-content border-0">

                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-dark" id="createModalLabel">
                        <i class="fas fa-book mr-1 text-primary" style="font-size: 22px;"></i> {!! __('cheques.add_cheque') !!}
                    </h5>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="modal-body my-2">
                    <!-- Quick Tips Section -->
                    <div class="premium-tips-card mb-4">
                        <div class="premium-tips-header">
                            <i class="fas fa-lightbulb"></i>
                            <span>{!! __('general.quick_tips') !!}</span>
                        </div>
                        <ul class="premium-tips-list">
                            <li><i class="fas fa-check-circle"></i> {!! __('cheques.amount_guidance') !!}</li>
                            <li><i class="fas fa-check-circle"></i> {!! __('cheques.is_deposit_guidance') !!}</li>
                            <li><i class="fas fa-check-circle"></i> {!! __('cheques.cheque_number_guidance') !!}</li>
                            <li><i class="fas fa-check-circle"></i> {!! __('cheques.due_date_guidance') !!}</li>
                        </ul>
                    </div>

                    <div class="row">
                        <!-- Company -->
                        @if(user()->company_id == 1)
                            <div class="col-md-12 mb-1">
                                <div class="premium-form-group">
                                    <label for="company_id_create">{!! __('companies.company') !!} <span class="text-danger">*</span></label>
                                    <div class="premium-input-wrapper">
                                        <select class="form-control premium-input shadow-none js-select2 js-autocomplete" id='company_id_create' name="company_id"
                                            data-url="{!! route('dashboard.companies.autocomplete') !!}"
                                            data-placeholder="{!! __('general.select_company') !!}"
                                            data-parent="#createModal">
                                            <option></option>
                                        </select>
                                    </div>
                                    <span class="error-text company_id_error text-danger"></span>
                                </div>
                            </div>
                        @endif

                        <!-- Contract -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="contract_id_create">{!! __('cheques.contract') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none js-select2 js-autocomplete" id='contract_id_create' name="contract_id"
                                        data-url="{!! route('dashboard.contracts.autocomplete') !!}"
                                        data-placeholder="{!! __('contracts.select_contract') !!}"
                                        data-parent="#createModal">
                                        <option></option>
                                    </select>
                                </div>
                                <span class="error-text contract_id_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Customer -->
                        <div class="col-md-8 mb-1">
                            <div class="premium-form-group">
                                <label for="customer_id_create">{!! __('cheques.customer') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none js-select2 js-autocomplete" id='customer_id_create' name="customer_id"
                                        data-url="{!! route('dashboard.customers.autocomplete') !!}"
                                        data-placeholder="{!! __('customers.customer') !!}"
                                        data-parent="#createModal">
                                        <option></option>
                                    </select>
                                </div>
                                <span class="error-text customer_id_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Cheque Number -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="cheque_number_create">{!! __('cheques.cheque_number') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="cheque_number_create"
                                    name="cheque_number" placeholder="{!! __('cheques.cheque_number') !!}" autocomplete="off">
                                    <i class="fas fa-barcode text-primary"></i>
                                </div>
                                <span class="error-text cheque_number_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Amount -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="amount_create">{!! __('cheques.amount') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="number" step="0.01" class="form-control premium-input shadow-none" id="amount_create"
                                    name="amount" placeholder="{!! __('cheques.amount') !!}" autocomplete="off">
                                    <i class="fas fa-money-bill text-primary"></i>
                                </div>
                                <span class="error-text amount_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="status_create">{!! __('cheques.status') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none" id="status_create" name="status">
                                        @foreach(__('cheques.statuses') as $key => $value)
                                            <option value="{!! $key !!}">{!! $value !!}</option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-info-circle text-primary"></i>
                                </div>
                                <span class="error-text status_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Is Deposit -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="is_deposit_create">{!! __('cheques.is_deposit') !!}</label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none" id="is_deposit_create" name="is_deposit">
                                        <option value="0">{!! __('general.no') !!}</option>
                                        <option value="1">{!! __('general.yes') !!}</option>
                                    </select>
                                    <i class="fas fa-shield-alt text-primary"></i>
                                </div>
                                <span class="error-text is_deposit_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Bank Name AR -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="bank_name_ar_create">{!! __('cheques.bank_name') !!} ({!! __('general.ar') !!}) <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="bank_name_ar_create"
                                    name="bank_name[ar]" placeholder="{!! __('cheques.bank_name') !!}" autocomplete="off">
                                    <i class="fas fa-university text-primary"></i>
                                </div>
                                <span class="error-text bank_name_ar_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Bank Name EN -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="bank_name_en_create">{!! __('cheques.bank_name') !!} ({!! __('general.en') !!}) <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="bank_name_en_create"
                                    name="bank_name[en]" placeholder="{!! __('cheques.bank_name') !!}" autocomplete="off">
                                    <i class="fas fa-university text-primary"></i>
                                </div>
                                <span class="error-text bank_name_en_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Cheque Owner AR -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="cheque_owner_name_ar_create">{!! __('cheques.cheque_owner_name') !!} ({!! __('general.ar') !!}) <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="cheque_owner_name_ar_create"
                                    name="cheque_owner_name[ar]" placeholder="{!! __('cheques.cheque_owner_name') !!}" autocomplete="off">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <span class="error-text cheque_owner_name_ar_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Cheque Owner EN -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="cheque_owner_name_en_create">{!! __('cheques.cheque_owner_name') !!} ({!! __('general.en') !!}) <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="cheque_owner_name_en_create"
                                    name="cheque_owner_name[en]" placeholder="{!! __('cheques.cheque_owner_name') !!}" autocomplete="off">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <span class="error-text cheque_owner_name_en_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Issue Date -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="issue_date_create">{!! __('cheques.issue_date') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none js-datepicker" id="issue_date_create"
                                    name="issue_date" autocomplete="off">
                                    <i class="fas fa-calendar-alt text-primary"></i>
                                </div>
                                <span class="error-text issue_date_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Due Date -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="due_date_create">{!! __('cheques.due_date') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none js-datepicker" id="due_date_create"
                                    name="due_date" autocomplete="off">
                                    <i class="fas fa-calendar-check text-primary"></i>
                                </div>
                                <span class="error-text due_date_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="col-md-12">
                            <div class="premium-form-group">
                                <label for="notes_create">{!! __('cheques.notes') !!}</label>
                                <div class="premium-input-wrapper no-icon">
                                    <textarea class="form-control premium-input shadow-none" id="notes_create" name="notes" rows="3"
                                    placeholder="{!! __('cheques.notes') !!}"></textarea>
                                </div>
                                <span class="error-text notes_error text-danger"></span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-25"></i> {!! __('general.cancel') !!}
                    </button>
                    <button type="submit" class="btn btn-premium-save shadow-pulse">
                        <i class="fas fa-save mr-25"></i> {!! __('general.save') !!}
                        <i class="fas fa-spinner fa-spin spinner_loading d-none ml-25"></i>
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>


