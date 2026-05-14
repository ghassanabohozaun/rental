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

                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-dark" id="editModalLabel">
                        <i class="fas fa-edit mr-1 text-primary" style="font-size: 22px;"></i> {!! __('payments.edit_payment') !!}
                    </h5>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="modal-body my-2">
                    <div class="row">
                        <!-- Company -->
                        @if(user()->company_id == 1)
                            <div class="col-md-12 mb-1">
                                <div class="premium-form-group">
                                    <label for="company_id_edit">{!! __('companies.company') !!} <span class="text-danger">*</span></label>
                                    <div class="premium-input-wrapper">
                                        <i class="fas fa-briefcase text-primary"></i>
                                        <select class="form-control premium-input shadow-none js-select2 js-autocomplete" id='company_id_edit' name="company_id"
                                            data-url="{!! route('dashboard.companies.autocomplete') !!}"
                                            data-placeholder="{!! __('general.select_company') !!}"
                                            data-parent="#editModal">
                                            <option></option>
                                        </select>
                                    </div>
                                    <span class="error-text company_id_error text-danger"></span>
                                </div>
                            </div>
                        @endif

                        <!-- Contract -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="contract_id_edit">{!! __('payments.contract') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <i class="fas fa-file-invoice text-primary"></i>
                                    <select class="form-control premium-input shadow-none js-select2 js-autocomplete" id='contract_id_edit' name="contract_id"
                                        data-url="{!! route('dashboard.contracts.autocomplete') !!}"
                                        data-placeholder="{!! __('contracts.contract') !!}"
                                        data-parent="#editModal">
                                        <option></option>
                                    </select>
                                </div>
                                <span class="error-text contract_id_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Amount -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="amount_edit">{!! __('payments.amount') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <i class="fas fa-dollar-sign text-primary"></i>
                                    <input type="number" step="0.01" class="form-control premium-input shadow-none" id="amount_edit"
                                    name="amount" placeholder="{!! __('payments.amount') !!}" autocomplete="off">
                                </div>
                                <span class="error-text amount_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Payment Date -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="payment_date_edit">{!! __('payments.payment_date') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <i class="fas fa-calendar-check text-primary"></i>
                                    <input type="date" class="form-control premium-input shadow-none" id="payment_date_edit"
                                    name="payment_date" autocomplete="off">
                                </div>
                                <span class="error-text payment_date_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Method -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="method_edit">{!! __('payments.method') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <i class="fas fa-wallet text-primary"></i>
                                    <select class="form-control premium-input shadow-none js-method-select-edit" id="method_edit" name="method">
                                        @foreach(__('payments.methods') as $key => $value)
                                            <option value="{!! $key !!}">{!! $value !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="error-text method_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Cheque (Visible if method is cheque) -->
                        <div class="col-md-6 mb-3 js-cheque-wrapper-edit d-none">
                            <div class="premium-form-group">
                                <label for="cheque_id_edit">{!! __('payments.cheque') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <i class="fas fa-money-check text-primary"></i>
                                    <select class="form-control premium-input shadow-none js-select2 js-autocomplete" id='cheque_id_edit' name="cheque_id"
                                        data-url="{!! route('dashboard.cheques.autocomplete') !!}"
                                        data-placeholder="{!! __('cheques.cheque') !!}"
                                        data-parent="#editModal">
                                        <option></option>
                                    </select>
                                </div>
                                <span class="error-text cheque_id_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Reference Number -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="reference_number_edit">{!! __('payments.reference_number') !!}</label>
                                <div class="premium-input-wrapper">
                                    <i class="fas fa-hashtag text-primary"></i>
                                    <input type="text" class="form-control premium-input shadow-none" id="reference_number_edit"
                                    name="reference_number" placeholder="{!! __('payments.reference_number') !!}" autocomplete="off">
                                </div>
                                <span class="error-text reference_number_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="status_edit">{!! __('payments.status') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <i class="fas fa-info-circle text-primary"></i>
                                    <select class="form-control premium-input shadow-none" id="status_edit" name="status">
                                        @foreach(__('payments.statuses') as $key => $value)
                                            <option value="{!! $key !!}">{!! $value !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="error-text status_error text-danger"></span>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="col-md-12 mb-1">
                            <div class="premium-form-group">
                                <label for="notes_edit">{!! __('payments.notes') !!}</label>
                                <div class="premium-input-wrapper">
                                    <textarea class="form-control premium-input shadow-none" id="notes_edit" name="notes" rows="3" placeholder="{!! __('payments.notes') !!}"></textarea>
                                    <i class="fas fa-sticky-note text-primary"></i>
                                </div>
                                <span class="error-text notes_error text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0">
                    <button type="submit" id="updateBtn" class="btn btn-premium-add px-4 font-weight-bold h-42 radius-10">
                        <i class="fas fa-save mr-1"></i> {{ __('general.save') }}
                        <i class="fas fa-sync fa-spin spinner_loading d-none ml-1"></i>
                    </button>

                    <button type="button" class="btn btn-premium-secondary px-4 font-weight-bold h-42 radius-10"
                        data-dismiss="modal">
                        <i class="fas fa-times-circle mr-1"></i> {{ __('general.cancel') }}
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.js-method-select-edit').on('change', function() {
                var wrapper = $(this).closest('.modal-body').find('.js-cheque-wrapper-edit');
                if ($(this).val() === 'cheque') {
                    wrapper.removeClass('d-none');
                } else {
                    wrapper.addClass('d-none');
                }
            });

            $('body').on('click', '.edit-control', function() {
                var id = $(this).data('id');
                var url = "{!! route('dashboard.payments.update', ':id') !!}";
                url = url.replace(':id', id);
                $('#edit_form').attr('action', url);

                // Populate fields
                $('#amount_edit').val($(this).data('amount'));
                $('#payment_date_edit').val($(this).data('payment_date'));
                $('#method_edit').val($(this).data('method')).trigger('change');
                $('#status_edit').val($(this).data('status')).trigger('change');
                $('#reference_number_edit').val($(this).data('reference_number'));
                $('#notes_edit').val($(this).data('notes'));
                
                // Trigger method change to show/hide cheque wrapper
                $('.js-method-select-edit').trigger('change');
            });
        });
    </script>
@endpush


