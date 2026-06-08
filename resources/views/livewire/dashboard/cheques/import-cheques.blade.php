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
                                    <select class="form-control premium-input shadow-none js-select2"
                                        id='company_id' wire:model.live="company_id">
                                        <option value="">{!! __('general.select_from_list') !!}</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('company_id')
                                    <span class="text-danger error-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="col-md-12 mb-1" wire:key="contract-select-container-{{ $company_id }}">
                        <div class="premium-form-group @error('contract_id') is-invalid-premium @enderror">
                            <label for="contract_id">{!! __('contracts.contract') !!} <span
                                    class="text-danger">*</span></label>
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
                                <span class="text-danger error-text">{{ $message }}</span>
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
                                    <div class="premium-file-box premium-file-box-match w-100 d-flex align-items-center justify-content-between">
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
                                <span class="text-danger error-text mt-1 d-block">{{ $message }}</span>
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
                            foreach($previewData as $row) {
                                if (in_array((string)$row['index'], $selectedCheques) || in_array($row['index'], $selectedCheques)) {
                                    $selectedSum += (float)$row['amount'];
                                }
                            }
                        @endphp

                        @error('selectedCheques')
                            <div class="badge badge-light-warning py-2 px-3 d-flex align-items-center w-100 mb-3 text-wrap text-left" style="font-size: 0.95rem; border: 1px dashed #ffc107; border-radius: 8px; line-height: 1.5;">
                                <i class="fas fa-exclamation-triangle mx-2" style="font-size: 1.1rem;"></i> 
                                <span class="font-weight-bold" style="text-align: right; width: 100%;">{{ $message }}</span>
                            </div>
                        @else
                            @if($selectedSum > $availableToCover)
                                <div class="badge badge-light-warning py-2 px-3 d-flex align-items-center w-100 mb-3 text-wrap text-left" style="font-size: 0.95rem; border: 1px dashed #ffc107; border-radius: 8px; line-height: 1.5;">
                                    <i class="fas fa-exclamation-triangle mx-2" style="font-size: 1.1rem;"></i> 
                                    <span class="font-weight-bold" style="text-align: right; width: 100%;">{{ __('cheques.import_exceeds_available_ui', ['selected' => number_format($selectedSum, 2), 'available' => number_format($availableToCover, 2)]) }}</span>
                                </div>
                            @endif
                        @enderror

                        <div class="table-responsive excel-table-wrapper">
                            <table class="table premium-table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="selectAll"
                                                    wire:click="toggleSelectAll($event.target.checked)"
                                                    @if (count($selectedCheques) == count($previewData)) checked @endif>
                                                <label class="custom-control-label" for="selectAll"></label>
                                            </div>
                                        </th>
                                        <th>{!! __('cheques.row_number') !!}</th>
                                        <th>{!! __('cheques.cheque_number') !!}</th>
                                        <th>{!! __('cheques.issue_date') !!}</th>
                                        <th>{!! __('cheques.amount') !!}</th>
                                        <th>{!! __('cheques.bank_name') !!}</th>
                                        <th>{!! __('cheques.deposit_account') !!}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($previewData as $row)
                                        <tr class="{{ $row['is_duplicate'] ? 'bg-light-danger opacity-75' : '' }}">
                                            <td>
                                                @if($row['is_duplicate'])
                                                    <div class="text-center">
                                                        <i class="fas fa-ban text-danger" title="{{ __('cheques.already_exists') }}"></i>
                                                    </div>
                                                @else
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="chk_{{ $row['index'] }}" wire:model="selectedCheques"
                                                            value="{{ $row['index'] }}">
                                                        <label class="custom-control-label"
                                                            for="chk_{{ $row['index'] }}"></label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $row['index'] }}</td>
                                            <td>
                                                <span class="premium-badge bg-light-primary">{{ $row['cheque_number'] }}</span>
                                                @if($row['is_duplicate'])
                                                    <span class="badge badge-danger ml-1" style="font-size: 0.75rem;">{{ __('cheques.already_exists') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $row['issue_date'] }}</td>
                                            <td><span
                                                    class="excel-amount-badge">{{ number_format((float) $row['amount'], 2) }}</span>
                                            </td>
                                            <td>{{ $row['bank_name'] }}</td>
                                            <td>
                                                @if ($row['matched_account_id'])
                                                    <span class="badge badge-success"><i class="fas fa-check"></i>
                                                        {{ $row['matched_account_name'] }}</span>
                                                @else
                                                    @if (!empty($row['deposit_account']))
                                                        <span class="badge badge-warning text-dark"><i
                                                                class="fas fa-exclamation-triangle"></i>
                                                            {{ $row['deposit_account'] }} -
                                                            {!! __('cheques.bank_account_not_found') !!}</span>
                                                    @else
                                                        <span class="text-muted">---</span>
                                                    @endif
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
