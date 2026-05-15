<div>
    <div wire:ignore.self class="modal premium-modal" id="quick-owner-modal" role="dialog"
        data-backdrop="static" data-keyboard="false"
        aria-labelledby="quick-owner-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center"
                        id="quick-owner-modal-label">
                        {{ __('owners.add_owner') }}
                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form wire:submit.prevent="saveQuickOwner" autocomplete="off">
                    <div class="modal-body py-3">
                        <!-- Search Area -->
                        <div class="row rounded py-2 px-1 mx-0 border shadow-sm premium-quick-search-area"
                            style="margin-bottom: 11px !important;">
                            <div class="col-md-12">
                                <div class="premium-form-group mb-0">
                                    <label class="font-weight-bold text-primary">
                                        {!! __('owners.search_existing_owner') !!}</label>
                                    <div class="position-relative w-100">
                                        <input type="text" wire:model.live.debounce.300ms="searchTerm"
                                            class="form-control premium-input shadow-none"
                                            placeholder="{!! __('owners.search_by_id_name_phone') !!}" autocomplete="off">

                                        @if (strlen($searchTerm) > 0)
                                            <div class="position-absolute w-100 mt-1" style="z-index: 9999;">
                                                <span
                                                    class="select2-container select2-container--default select2-container--open w-100">
                                                    <span class="select2-dropdown select2-dropdown--below"
                                                        dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                                                        <span class="select2-results">
                                                            <ul class="select2-results__options" role="listbox">
                                                                @if (count($searchResults) > 0)
                                                                    @foreach ($searchResults as $result)
                                                                        <li class="select2-results__option py-2 px-3"
                                                                            role="option"
                                                                            wire:click="selectOwner({{ $result['id'] }})"
                                                                            onmouseover="this.classList.add('select2-results__option--highlighted')"
                                                                            onmouseout="this.classList.remove('select2-results__option--highlighted')">
                                                                            {{ is_array($result['name']) ? $result['name'][app()->getLocale()] ?? $result['name']['en'] : $result['name'] }}
                                                                            - {{ $result['identification_number'] ?? '' }}
                                                                            - {{ $result['phone'] ?? '' }}
                                                                        </li>
                                                                    @endforeach
                                                                @else
                                                                    <li class="select2-results__option select2-results__message"
                                                                        role="option">
                                                                        {{ __('owners.no_owners_found') }}
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </span>
                                                    </span>
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <small class="text-muted d-block mt-1">{!! __('owners.search_hint_or_add_new') !!}</small>
                                </div>
                            </div>
                        </div>

                        <!-- Form Fields -->
                        <div class="row mt-3">
                            <!-- Name AR -->
                            <div class="col-md-6 mb-2">
                                <div class="premium-form-group @error('quick_name.ar') is-invalid-premium @enderror">
                                    <label class="font-weight-bold">{!! __('owners.name_ar') !!}
                                        <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="quick_name.ar"
                                        class="form-control premium-input shadow-none"
                                        placeholder="{{ __('owners.enter_name_ar') }}"
                                        autocomplete="off"
                                        {{ $is_existing ? 'readonly' : '' }}>
                                    @error('quick_name.ar')
                                        <span class="text-danger error-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Name EN -->
                            <div class="col-md-6 mb-2">
                                <div class="premium-form-group @error('quick_name.en') is-invalid-premium @enderror">
                                    <label class="font-weight-bold">{!! __('owners.name_en') !!} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="quick_name.en"
                                        class="form-control premium-input shadow-none"
                                        placeholder="{{ __('owners.enter_name_en') }}"
                                        autocomplete="off"
                                        {{ $is_existing ? 'readonly' : '' }}>
                                    @error('quick_name.en')
                                        <span class="text-danger error-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- ID Number -->
                            <div class="col-md-6 mb-2">
                                <div class="premium-form-group @error('quick_id_number') is-invalid-premium @enderror">
                                    <label class="font-weight-bold">{!! __('owners.identification_number') !!} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="quick_id_number"
                                        class="form-control premium-input shadow-none"
                                        placeholder="{{ __('owners.enter_id_number') }}"
                                        autocomplete="off"
                                        {{ $is_existing ? 'readonly' : '' }}>
                                    @error('quick_id_number')
                                        <span class="text-danger error-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Phone -->
                            <div class="col-md-6 mb-2">
                                <div class="premium-form-group @error('quick_phone') is-invalid-premium @enderror">
                                    <label class="font-weight-bold">{!! __('owners.phone') !!} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="quick_phone"
                                        class="form-control premium-input shadow-none"
                                        placeholder="{{ __('owners.enter_phone') }}"
                                        autocomplete="off"
                                        {{ $is_existing ? 'readonly' : '' }}>
                                    @error('quick_phone')
                                        <span class="text-danger error-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Email -->
                            <div class="col-md-6 mb-2">
                                <div class="premium-form-group @error('quick_email') is-invalid-premium @enderror">
                                    <label class="font-weight-bold">{!! __('owners.email') !!}</label>
                                    <input type="email" wire:model.defer="quick_email"
                                        class="form-control premium-input shadow-none"
                                        placeholder="{{ __('owners.enter_email') }}"
                                        autocomplete="off"
                                        {{ $is_existing ? 'readonly' : '' }}>
                                    @error('quick_email')
                                        <span class="text-danger error-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Address -->
                            <div class="col-md-6 mb-2">
                                <div class="premium-form-group @error('quick_address') is-invalid-premium @enderror">
                                    <label class="font-weight-bold">{!! __('owners.address') !!}</label>
                                    <input type="text" wire:model.defer="quick_address"
                                        class="form-control premium-input shadow-none"
                                        placeholder="{{ __('owners.enter_address') }}"
                                        autocomplete="off"
                                        {{ $is_existing ? 'readonly' : '' }}>
                                    @error('quick_address')
                                        <span class="text-danger error-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <!-- Ownership Percentage -->
                            <div class="col-md-6 mb-2">
                                <div class="premium-form-group @error('quick_percentage') is-invalid-premium @enderror">
                                    <label class="font-weight-bold">{!! __('properties.ownership_percentage') !!}</label>
                                    <input type="number" step="0.01" wire:model.defer="quick_percentage"
                                        class="form-control premium-input shadow-none" placeholder="0.00" autocomplete="off">
                                    @error('quick_percentage')
                                        <span class="text-danger error-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Is Primary -->
                            <div class="col-md-6 mb-2 d-flex align-items-end">
                                <div class="premium-form-group mb-2 w-100">
                                    <div class="d-flex align-items-center h-100 mt-4 px-2">
                                        <div
                                            class="custom-control custom-switch custom-switch-glow custom-switch-primary">
                                            <input type="checkbox" class="custom-control-input" id="quick_is_primary"
                                                wire:model.defer="quick_is_primary">
                                            <label class="custom-control-label" for="quick_is_primary"></label>
                                        </div>
                                        <label class="font-weight-bold text-dark cursor-pointer mb-0"
                                            for="quick_is_primary"
                                            style="font-size: 1.1rem; padding-inline-start: 10px;">
                                            {!! __('properties.is_primary') !!}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Notes -->
                            <div class="col-md-12 mb-0">
                                <div class="premium-form-group mb-0 @error('quick_notes') is-invalid-premium @enderror">
                                    <label class="font-weight-bold">{!! __('owners.notes') !!}</label>
                                    <textarea wire:model.defer="quick_notes" class="form-control premium-input h-80 shadow-none"
                                        placeholder="{{ __('owners.notes') }}" {{ $is_existing ? 'readonly' : '' }}></textarea>
                                    @error('quick_notes')
                                        <span class="text-danger error-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0 premium-modal-footer">
                        <button type="submit"
                            class="btn btn-premium-save px-4 font-weight-bold">
                            <i wire:loading.remove wire:target="saveQuickOwner" class="fas fa-check-circle mr-2"></i>
                            <i wire:loading wire:target="saveQuickOwner" class="fas fa-sync fa-spin mr-2"></i>
                            {!! __('properties.add_owner') !!}
                        </button>
                        <button type="button" class="btn btn-premium-secondary px-4 font-weight-bold"
                            data-dismiss="modal">
                            <i class="fas fa-times-circle mr-2"></i> {!! __('general.cancel') !!}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
