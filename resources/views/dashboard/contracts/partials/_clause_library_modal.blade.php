    <!-- Modal for Clause Library -->
    <div class="modal modal-pop fade" id="clauseLibraryModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                <div class="modal-header border-0 pb-0" style="background: linear-gradient(135deg, rgba(115, 103, 240, 0.05), rgba(115, 103, 240, 0.01)); border-bottom: 1px solid rgba(0,0,0,0.05) !important; padding: 20px;">
                    <h5 class="modal-title font-weight-bold text-dark d-flex align-items-center" id="clauseLibraryModalLabel">
                        <div style="background: #7367f0; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-radius: 10px; margin-left: 12px; box-shadow: 0 4px 10px rgba(115, 103, 240, 0.3);">
                            <i class="fas fa-book text-white icon-size-18"></i>
                        </div>
                        {!! __('contracts.contract_clauses_library') !!}
                    </h5>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close" style="opacity: 1; background: #f8f8f8; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; transition: all 0.2s;">
                        <i class="fas fa-times text-danger"></i>
                    </button>
                </div>
                <div class="modal-body mt-2 mb-0 p-3">
                    <div class="clause-library-container">
                        @forelse($clause_templates as $template)
                            <div class="premium-clause-card">
                                <div class="premium-clause-header">
                                    <h5 class="premium-clause-title">
                                        <i class="fas fa-file-alt premium-clause-icon"></i>
                                        {{ $template->title }}
                                    </h5>
                                    <button type="button" class="premium-clause-btn" wire:click="$dispatch('insert-clause', { id: {{ $template->id }} })" data-dismiss="modal">
                                        <i class="fas fa-plus"></i> {!! __('contracts.insert_clause') !!}
                                    </button>
                                </div>
                                <p class="premium-clause-content">{{ Str::limit($template->content, 180) }}</p>
                            </div>
                        @empty
                            <div class="alert alert-warning d-flex align-items-center border-0 shadow-sm" style="border-radius: 12px;">
                                <i class="fas fa-exclamation-triangle fa-2x text-warning ml-3"></i>
                                <div>
                                    <h6 class="mb-0 font-weight-bold">{!! __('contracts.empty_library_message') !!}</h6>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 premium-modal-footer" style="padding: 15px 20px;">
                    <button type="button" class="btn btn-premium-secondary px-4 font-weight-bold shadow-sm" data-dismiss="modal" style="border-radius: 8px;">
                        <i class="fas fa-times-circle mr-2"></i> {!! __('contracts.close') !!}
                    </button>
                </div>
            </div>
        </div>
    </div>
