<!-- Old Inputs Hidden as requested -->
<div class="d-none">
    <div class="row">
        <div class="col-md-12">
            <div class="premium-form-group">
                <label for="contract_text" class="premium-label">{!! __('contracts.contract_text') !!}</label>
                <textarea id="contract_text" name="contract_text" class="form-control shadow-none" rows="10">{!! old('contract_text', $contract->contract_text ?? '') !!}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="premium-form-group">
                <label for="notes" class="premium-label">{!! __('contracts.notes') !!}</label>
                <textarea id="notes" name="notes" class="form-control shadow-none" rows="3">{!! old('notes', $contract->notes ?? '') !!}</textarea>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="premium-form-group">
            <label for="grace_period" class="premium-label">{!! __('contracts.grace_period') !!}</label>
            <input type="text" id="grace_period" name="contract_detail[grace_period]"
                class="form-control shadow-none" value="{!! old('contract_detail.grace_period', $contract->contractDetail->grace_period ?? '') !!}" placeholder="{!! __('contracts.grace_period_placeholder') !!}">
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="text-primary"><i class="fas fa-list-ol mr-1"></i> {!! __('contracts.contract_clauses_builder_title') !!}</h5>
            <button type="button" class="btn btn-sm btn-success" onclick="openClauseLibraryModal()">
                <i class="fas fa-plus"></i> {!! __('contracts.add_clause_from_library') !!}
            </button>
        </div>

        <div id="clauses-container" class="sortable-clauses mb-3">
            <!-- Clauses will be rendered here via JS -->
        </div>

        <div class="d-flex justify-content-start mb-4">
            <button type="button" class="btn btn-outline-primary" onclick="addNewEmptyClause()">
                <i class="fas fa-plus-circle"></i> {!! __('contracts.add_empty_custom_clause') !!}
            </button>
        </div>

        @include('dashboard.contracts.partials._smart_tags_hint')
    </div>
</div>

<!-- Modal for Clause Library -->
<div class="modal modal-pop" id="clauseLibraryModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="clauseLibraryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center" id="clauseLibraryModalLabel">
                    <i class="fas fa-book text-primary mr-2 icon-size-18"></i> {!! __('contracts.contract_clauses_library') !!}
                </h6>
                <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body mt-2 mb-0">
                <div class="text-center" id="library-loading" style="display: none;">
                    <i class="fas fa-spinner fa-spin fa-2x text-primary"></i> <span class="ml-2 font-weight-bold">{!! __('contracts.loading') !!}</span>
                </div>
                <div id="library-content">
                    <!-- Library items will be populated via AJAX -->
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 premium-modal-footer">
                <button type="button" class="btn btn-premium-secondary px-4 font-weight-bold" data-dismiss="modal">
                    <i class="fas fa-times-circle mr-2"></i> {!! __('contracts.close') !!}
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        let clausesCount = 0;

        @php
            $existingClauses = old('contract_detail.contract_clauses', isset($contract) && $contract->contractDetail && is_array($contract->contractDetail->contract_clauses) ? $contract->contractDetail->contract_clauses : []);
            // If it's a string (old summernote), let's wrap it in an array to not break UI
            if (is_string($existingClauses)) {
                $existingClauses = [['title' => __('contracts.previous_clauses'), 'content' => $existingClauses]];
            }
        @endphp

        let initialClauses = {!! json_encode($existingClauses) !!};

        function renderClause(title, content) {
            let index = clausesCount++;
            let html = `
            <div class="card border mb-2 clause-item" id="clause-${index}">
                <div class="card-header bg-light d-flex justify-content-between align-items-center py-1 cursor-move">
                    <div class="w-100 mr-2">
                        <input type="text" name="contract_detail[contract_clauses][${index}][title]" 
                               class="form-control form-control-sm font-weight-bold premium-input shadow-none bg-white" style="padding: 0.25rem 0.5rem;"
                               placeholder="{!! __('contracts.clause_title_placeholder') !!}" value="${title || ''}">
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-icon btn-danger" onclick="removeClause(${index})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-2">
                    <textarea name="contract_detail[contract_clauses][${index}][content]" 
                              class="form-control shadow-none" rows="3" 
                              placeholder="{!! __('contracts.clause_content_placeholder') !!}">${content || ''}</textarea>
                </div>
            </div>
        `;
            $('#clauses-container').append(html);
        }

        function removeClause(index) {
            if (confirm('{!! __('contracts.confirm_delete_clause') !!}')) {
                $(`#clause-${index}`).remove();
            }
        }

        function addNewEmptyClause() {
            renderClause('', '');
        }

        function openClauseLibraryModal() {
            $('#clauseLibraryModal').appendTo("body").modal('show');
            $('#library-loading').show();
            $('#library-content').html('');

            let requestData = {};
            if ($('#company_id').length > 0 && $('#company_id').val()) {
                requestData.company_id = $('#company_id').val();
            }

            $.ajax({
                url: '{{ route('dashboard.contract_clauses.api') }}',
                type: 'GET',
                data: requestData,
                success: function(res) {
                    $('#library-loading').hide();
                    if (res.length === 0) {
                        $('#library-content').html(
                            '<div class="alert alert-warning">{!! __('contracts.empty_library_message') !!}</div>');
                        return;
                    }

                    let html = '<div class="list-group">';
                    res.forEach(function(clause) {
                        let safeTitle = clause.title ? clause.title.replace(/"/g, '&quot;').replace(/'/g, '&#39;').replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';
                        let safeContent = clause.content ? clause.content.replace(/"/g, '&quot;').replace(/'/g, '&#39;').replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';
                        
                        html += `
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1 text-primary">${safeTitle}</h5>
                                <button type="button" class="btn btn-sm btn-success insert-clause-btn" data-title="${safeTitle}" data-content="${safeContent}">
                                    <i class="fas fa-plus"></i> {!! __('contracts.insert_clause') !!}
                                </button>
                            </div>
                            <p class="mb-1 text-muted small">${safeContent.substring(0, 100)}...</p>
                        </div>
                    `;
                    });
                    html += '</div>';
                    $('#library-content').html(html);
                }
            });
        }

        function addClauseFromLibrary(title, content) {
            renderClause(title, content);
            $('#clauseLibraryModal').modal('hide');
            toastr.success('{!! __('contracts.clause_inserted_success') !!}');
        }

        $(document).ready(function() {
            // Ensure modal is moved to body directly on load so it avoids z-index issues
            $('#clauseLibraryModal').appendTo("body");

            // Delegated click event for insert buttons
            $(document).on('click', '.insert-clause-btn', function() {
                let title = $(this).attr('data-title');
                let content = $(this).attr('data-content');
                addClauseFromLibrary(title, content);
            });

            // Initialize existing clauses
            if (initialClauses && initialClauses.length > 0) {
                initialClauses.forEach(function(clause) {
                    renderClause(clause.title, clause.content);
                });
            }

            // Initialize Sortable
            var el = document.getElementById('clauses-container');
            if (el) {
                Sortable.create(el, {
                    handle: '.cursor-move',
                    animation: 150
                });
            }
        });
    </script>
@endpush
