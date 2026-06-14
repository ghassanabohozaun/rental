<div>

    <div class="card premium-card premium-card-anim">
        <!-- begin: card header -->
        <div class="premium-mandatory-header py-2">
            <div class="title-wrapper">
                <i class="fas fa-file-import"></i>
                <span class="font-weight-bold">{!! __('cheques.import_cheques') !!}</span>
            </div>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="fas fa-minus"></i></a></li>
                    <li><a data-action="reload"><i class="fas fa-sync"></i></a></li>
                    <li><a data-action="expand"><i class="fas fa-expand"></i></a></li>
                </ul>
            </div>
        </div>
        <!-- end: card header -->
        <div class="card-content collapse show">
            <div class="card-body">

                <div class="row">
                    @if (user()->company_id == 1)
                        <div class="col-md-12 mb-1" wire:key="company-select-container">
                            <div class="premium-form-group @error('company_id') is-invalid-premium @enderror">
                                <label for="company_id">{!! __('companies.company') !!} <span
                                        class="text-danger">*</span></label>
                                <div wire:ignore>
                                    <select class="form-control premium-input shadow-none js-select2" id='company_id'
                                        wire:model.live="company_id">
                                        <option value="">{!! __('general.select_from_list') !!}</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('company_id')
                                    <span class="premium-field-error">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <span>{{ $message }}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="col-md-12 mb-1" wire:key="contract-select-container-{{ $company_id }}">
                        <div class="premium-form-group @error('contract_id') is-invalid-premium @enderror">
                            <label for="contract_id">{!! __('contracts.contract') !!} <span class="text-danger">*</span></label>
                            <div wire:ignore
                                wire:key="contract-id-wrapper-{{ $company_id ? $company_id : 'disabled' }}">
                                <select class="form-control premium-input shadow-none js-select2" id='contract_id'
                                    wire:model.live="contract_id">
                                    <option value="">
                                        @if (user()->company_id == 1 && !$company_id)
                                            {!! __('cheques.select_company_first') !!}
                                        @else
                                            {!! __('contracts.select_contract') !!}
                                        @endif
                                    </option>
                                    @foreach ($contracts as $contract)
                                        <option value="{{ $contract->id }}">
                                            {{ __('contracts.contract') . ' #' . $contract->id . ' - ' . optional($contract->customer)->name . ' (' . optional($contract->property)->name . ')' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('contract_id')
                                <span class="premium-field-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>{{ $message }}</span>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12 mb-1">
                        <div class="premium-form-group mb-0 @error('excelFile') is-invalid-premium @enderror">
                            <label>{!! __('cheques.excel_file') !!} <span class="text-danger">*</span></label>
                            <div class="premium-file-upload-wrapper mt-0">
                                <input type="file" wire:model.live="excelFile" class="d-none file-upload-input"
                                    id="excelFile" accept=".xlsx,.csv,.xls">
                                <label for="excelFile" class="premium-file-label w-100 mb-0">
                                    <div
                                        class="premium-file-box premium-file-box-match w-100 d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center"
                                            style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            <div class="file-icon-box" style="margin-inline-end: 10px;"><i
                                                    class="fas fa-file-excel text-success"
                                                    style="font-size: 1.2rem;"></i></div>
                                            <span class="file-name text-muted text-truncate d-inline-block">
                                                {{ $excelFile ? $excelFile->getClientOriginalName() : __('cheques.choose_file') }}
                                            </span>
                                        </div>
                                        <span class="browse-badge browse-badge-primary"
                                            style="white-space: nowrap;">{!! __('general.browse') !!}</span>
                                    </div>
                                </label>
                            </div>
                            @error('excelFile')
                                <span class="premium-field-error d-flex">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>{{ $message }}</span>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12 mt-2 text-center">
                        <button class="btn btn-premium-save px-5 py-2 font-weight-bold" wire:click="analyzeFile"
                            wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="analyzeFile">
                                <i class="fas fa-search mr-2"></i> {!! __('cheques.analyze_file') !!}
                            </span>
                            <span wire:loading wire:target="analyzeFile">
                                <i class="fas fa-spinner fa-spin mr-2"></i> {!! __('cheques.analyzing') !!}
                            </span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @if (!empty($previewData))
        <div class="card premium-card mt-3">
            <div class="card-body">
                <!-- Preview Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="premium-section-title mb-0">{!! __('cheques.preview_data') !!}</h5>
                            <button class="btn btn-primary premium-btn" wire:click="saveImportedCheques"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="saveImportedCheques">
                                    <i class="fas fa-check-circle mr-1"></i> {!! __('cheques.import_selected') !!}
                                </span>
                                <span wire:loading wire:target="saveImportedCheques">
                                    <i class="fas fa-spinner fa-spin"></i> {!! __('cheques.saving') !!}
                                </span>
                            </button>
                        </div>

                        @php
                            $selectedSum = 0;
                            foreach ($previewData as $row) {
                                if (
                                    in_array((string) $row['index'], $selectedCheques) ||
                                    in_array($row['index'], $selectedCheques)
                                ) {
                                    $selectedSum += (float) $row['amount'];
                                }
                            }
                        @endphp

                        @error('selectedCheques')
                            <div class="premium-alert-banner">
                                <div class="alert-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="alert-content">
                                    <span>{{ $message }}</span>
                                </div>
                            </div>
                        @else
                            @if ($selectedSum > $availableToCover)
                                <div class="premium-alert-banner">
                                    <div class="alert-icon">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="alert-content">
                                        <span>{{ __('cheques.import_exceeds_available_ui', ['selected' => number_format($selectedSum, 2), 'available' => number_format($availableToCover, 2)]) }}</span>
                                    </div>
                                </div>
                            @endif
                        @enderror

                        <div class="table-responsive excel-table-wrapper">
                            <table class="table premium-table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">
                                            @php
                                                $validRowsCount = collect($previewData)
                                                    ->where('has_errors', false)
                                                    ->count();
                                            @endphp
                                            <div class="premium-checkbox-custom">
                                                <input type="checkbox" id="selectAll"
                                                    wire:click="toggleSelectAll($event.target.checked)"
                                                    @if ($validRowsCount > 0 && count($selectedCheques) == $validRowsCount) checked @endif>
                                            </div>
                                        </th>
                                        <th>{!! __('cheques.row_number') !!}</th>
                                        <th>{!! __('cheques.cheque_number') !!}</th>
                                        <th>{!! __('cheques.due_date_cheque') !!}</th>
                                        <th>{!! __('cheques.amount') !!}</th>
                                        <th>{!! __('cheques.client_bank_name') !!}</th>
                                        <th>{!! __('cheques.deposit_account') !!}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($previewData as $row)
                                        <tr
                                            class="{{ $row['has_errors'] ? 'import-row-error' : ($row['is_duplicate'] ? 'import-row-warning' : '') }}">
                                            <td>
                                                @if ($row['has_errors'])
                                                    <div class="text-center">
                                                        <span class="error-badge-pulse"
                                                            title="{{ __('general.validation_error') ?? 'خطأ في التحقق' }}">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                        </span>
                                                    </div>
                                                @else
                                                    <div class="premium-checkbox-custom">
                                                        <input type="checkbox" id="chk_{{ $row['index'] }}"
                                                            wire:model="selectedCheques" value="{{ $row['index'] }}">
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $row['index'] }}</td>
                                            <td>
                                                <span
                                                    class="premium-badge bg-light-primary">{{ $row['cheque_number'] }}</span>
                                                @if ($row['is_duplicate'])
                                                    <span class="premium-warning-badge">
                                                        <i class="fas fa-exclamation-circle"></i>
                                                        <span>{{ __('cheques.already_exists') }} (مكرر)</span>
                                                    </span>
                                                @endif
                                                @if (!empty($row['errors']['cheque_number']))
                                                    <div class="premium-error-bubble">
                                                        <i class="fas fa-exclamation-circle"></i>
                                                        <span>{{ $row['errors']['cheque_number'] }}</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $row['due_date'] }}</td>
                                            <td>
                                                <span class="excel-amount-badge">
                                                    {{ is_numeric($row['amount']) ? number_format((float) $row['amount'], 2) : ($row['amount'] ?: '0.00') }}
                                                </span>
                                                @if (!empty($row['errors']['amount']))
                                                    <div class="premium-error-bubble">
                                                        <i class="fas fa-exclamation-circle"></i>
                                                        <span>{{ $row['errors']['amount'] }}</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $row['bank_name'] }}</td>
                                            <td>
                                                @if ($row['matched_account_id'])
                                                    <span class="premium-success-chip">
                                                        <i class="fas fa-check-circle"></i>
                                                        {{ $row['matched_account_name'] }}
                                                        ({{ $row['deposit_account'] }})
                                                    </span>
                                                @else
                                                    @if (!empty($row['deposit_account']))
                                                        <span class="premium-warning-chip">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            {{ $row['deposit_account'] }} - {!! __('cheques.bank_account_not_found') !!}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">---</span>
                                                    @endif
                                                @endif

                                                @if (!empty($row['errors']['deposit_account']))
                                                    <div class="premium-error-bubble">
                                                        <i class="fas fa-exclamation-circle"></i>
                                                        <span>{{ $row['errors']['deposit_account'] }}</span>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @push('scripts')
        <script>
            document.addEventListener('livewire:navigated', () => {
                initPlugins();
            });

            function initPlugins() {
                // Select2
                $('.js-select2').each(function() {
                    const $el = $(this);
                    if ($el.hasClass("select2-hidden-accessible")) {
                        $el.prop('disabled', $el.is(':disabled'));
                        $el.trigger('change.select2');
                        return;
                    }
                    $el.select2({
                        width: '100%',
                        dir: $('html').attr('data-textdirection') || 'ltr',
                        dropdownParent: $('body')
                    }).on('change', function(e) {
                        let val = $(this).val();
                        let model = $(this).attr('wire:model.live') || $(this).attr('wire:model') || this.id;
                        if (model) @this.set(model, val);
                    });
                });
            }

            $(document).ready(function() {
                initPlugins();
            });

            window.addEventListener('reinit-plugins', event => {
                setTimeout(initPlugins, 50);
            });
        </script>
    @endpush
