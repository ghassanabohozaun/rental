<div class="card premium-card mt-2">
    <div class="premium-mandatory-header py-2">
        <div class="title-wrapper">
            <i class="fas fa-columns text-info"></i>
            <span class="font-weight-bold">{!! __('reports.select_columns') !!}</span>
        </div>
        <div class="heading-elements">
            <ul class="list-inline mb-0 d-flex align-items-center">
                <li><a data-action="collapse"><i class="fas fa-minus"></i></a></li>
                <li><a data-action="expand"><i class="fas fa-expand"></i></a></li>
            </ul>
        </div>
    </div>

    <div class="card-content collapse show">
        <div class="card-body pt-2">

            <div class="d-flex justify-content-start mb-3">
                <div class="custom-control custom-switch custom-switch-info" style="margin-left: 15px; margin-right: 15px;">
                    <input type="checkbox" class="custom-control-input" id="check_all_columns">
                    <label class="custom-control-label font-weight-bold cursor-pointer text-nowrap px-3" for="check_all_columns" style="white-space: nowrap;">
                        {!! __('reports.select_all') !!}
                    </label>
                </div>
            </div>

            <!-- Cheque Columns -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <h5 class="premium-section-title premium-section-title-blue">
                        <i class="fas fa-money-check-alt"></i> {!! __('cheques.cheques') !!}
                    </h5>
                </div>
                @foreach ($chequeColumns as $column)
                    <div class="col-md-3 mb-2">
                        <div class="premium-switch-box shadow-sm">
                            <span class="premium-switch-label">
                                {!! __('reports.' . $column) !!}
                            </span>
                            <label class="modern-switch">
                                <input type="checkbox" name="columns[]" value="{{ $column }}"
                                    id="column_{{ $column }}" class="column-checkbox"
                                    @if(in_array($column, ['cheque_number', 'amount', 'used_amount', 'remaining_amount', 'bank_name', 'due_date', 'status'])) checked @endif>
                                <span class="modern-slider"></span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            <hr class="my-2" style="border-top: 1px dashed #E5E7EB;" />

            <!-- Contract Columns -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <h5 class="premium-section-title premium-section-title-blue" style="border-left-color: #10B981;">
                        <i class="fas fa-file-contract text-success"></i> {!! __('contracts.contracts') !!}
                    </h5>
                </div>
                @foreach ($contractColumns as $column)
                    <div class="col-md-3 mb-2">
                        <div class="premium-switch-box shadow-sm">
                            <span class="premium-switch-label">
                                {!! __('reports.' . $column) !!}
                            </span>
                            <label class="modern-switch">
                                <input type="checkbox" name="columns[]" value="{{ $column }}"
                                    id="column_{{ $column }}" class="column-checkbox"
                                    @if(in_array($column, ['customer_name', 'property_name'])) checked @endif>
                                <span class="modern-slider"></span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            <hr class="my-2" style="border-top: 1px dashed #E5E7EB;" />

            <!-- Bank Account Columns -->
            <div class="row">
                <div class="col-md-12">
                    <h5 class="premium-section-title premium-section-title-blue" style="border-left-color: #F59E0B;">
                        <i class="fas fa-university text-warning"></i> {!! __('bank_accounts.bank_accounts') !!}
                    </h5>
                </div>
                @foreach ($bankAccountColumns as $column)
                    <div class="col-md-3 mb-2">
                        <div class="premium-switch-box shadow-sm">
                            <span class="premium-switch-label">
                                {!! __('reports.' . $column) !!}
                            </span>
                            <label class="modern-switch">
                                <input type="checkbox" name="columns[]" value="{{ $column }}"
                                    id="column_{{ $column }}" class="column-checkbox">
                                <span class="modern-slider"></span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            // Master switch for all columns
            $('#check_all_columns').on('change', function() {
                var isChecked = $(this).is(':checked');
                $('.column-checkbox').prop('checked', isChecked);
            });

            // If any single column is unchecked, uncheck the master switch
            $('.column-checkbox').on('change', function() {
                if (!$(this).is(':checked')) {
                    $('#check_all_columns').prop('checked', false);
                } else {
                    // Check if all are checked to check the master switch
                    if ($('.column-checkbox:checked').length === $('.column-checkbox').length) {
                        $('#check_all_columns').prop('checked', true);
                    }
                }
            });

            // Check the master switch initially if all defaults are checked
            if ($('.column-checkbox:checked').length === $('.column-checkbox').length) {
                $('#check_all_columns').prop('checked', true);
            }
        });
    </script>
@endpush
