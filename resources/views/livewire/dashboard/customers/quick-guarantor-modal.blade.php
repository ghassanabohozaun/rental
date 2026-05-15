<div>
    <div wire:ignore.self class="modal  premium-modal" id="quick-guarantor-modal" role="dialog" data-backdrop="static"
        data-keyboard="false" aria-labelledby="quick-guarantor-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center"
                        id="quick-guarantor-modal-label">
                        {{ __('guarantors.add_guarantor') }}
                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form wire:submit.prevent="saveQuickGuarantor">
                    <div class="modal-body py-3">
                        <div class="row rounded py-2 px-1 mx-0 border shadow-sm premium-quick-search-area"
                            style="margin-bottom: 11px !important;">
                            <div class="col-md-12">
                                <div class="premium-form-group mb-0">
                                    <label class="font-weight-bold text-primary">
                                        {!! __('guarantors.search_existing_guarantor') !!}</label>
                                    <div class="position-relative w-100">
                                        <input type="text" wire:model.live.debounce.300ms="searchTerm"
                                            class="form-control premium-input shadow-none"
                                            placeholder="{!! __('guarantors.search_by_id_name_phone') !!}" autocomplete="off">

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
                                                                            wire:click="selectGuarantor({{ $result['id'] }})"
                                                                            onmouseover="this.classList.add('select2-results__option--highlighted')"
                                                                            onmouseout="this.classList.remove('select2-results__option--highlighted')">
                                                                            {{ is_array($result['name']) ? $result['name'][app()->getLocale()] ?? $result['name']['en'] : $result['name'] }}
                                                                            - {{ $result['phone'] ?? '' }}
                                                                        </li>
                                                                    @endforeach
                                                                @else
                                                                    <li class="select2-results__option select2-results__message"
                                                                        role="option">
                                                                        {{ __('guarantors.no_guarantors_found') }}
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </span>
                                                    </span>
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <small class="text-muted d-block mt-1">{!! __('guarantors.search_hint_or_add_new') !!}</small>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <!-- Name AR -->
                            <div class="col-md-6 mb-2">
                                <div class="premium-form-group @error('quick_name.ar') is-invalid-premium @enderror">
                                    <label class="font-weight-bold">{!! __('guarantors.name_ar') !!}
                                        <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="quick_name.ar"
                                        class="form-control premium-input shadow-none"
                                        placeholder="{{ __('guarantors.enter_name_ar') }}"
                                        {{ $is_existing ? 'readonly' : '' }}>
                                    @error('quick_name.ar')
                                        <span class="text-danger error-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Name EN -->
                            <div class="col-md-6 mb-2">
                                <div class="premium-form-group @error('quick_name.en') is-invalid-premium @enderror">
                                    <label class="font-weight-bold">{!! __('guarantors.name_en') !!}
                                        <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="quick_name.en"
                                        class="form-control premium-input shadow-none"
                                        placeholder="{{ __('guarantors.enter_name_en') }}"
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
                                    <label class="font-weight-bold">{!! __('guarantors.id_number') !!} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="quick_id_number"
                                        class="form-control premium-input shadow-none"
                                        placeholder="{{ __('guarantors.enter_id_number') }}"
                                        {{ $is_existing ? 'readonly' : '' }}>
                                    @error('quick_id_number')
                                        <span class="text-danger error-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Phone -->
                            <div class="col-md-6 mb-1">
                                <div class="premium-form-group @error('quick_phone') is-invalid-premium @enderror">
                                    <label class="font-weight-bold">{!! __('guarantors.phone') !!}</label>
                                    <input type="text" wire:model.defer="quick_phone"
                                        class="form-control premium-input shadow-none"
                                        placeholder="{{ __('guarantors.enter_phone') }}"
                                        {{ $is_existing ? 'readonly' : '' }}>
                                    @error('quick_phone')
                                        <span class="text-danger error-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Relationship -->
                            <div class="col-md-4 mb-1">
                                <div class="premium-form-group @error('quick_relationship') is-invalid-premium @enderror">
                                    <label class="font-weight-bold">{!! __('guarantors.relationship') !!}</label>
                                    <select wire:model.live="quick_relationship"
                                        class="form-control premium-input shadow-none">
                                        <option value="">{{ __('general.select_from_list') }}</option>
                                        @foreach (__('guarantors.relationships') as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('quick_relationship')
                                        <span class="text-danger error-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            @if ($quick_relationship == self::RELATIONSHIP_OTHER)
                                <!-- Relationship Details -->
                                <div class="col-md-8 mb-1">
                                    <div class="premium-form-group @error('quick_relationship_details') is-invalid-premium @enderror">
                                        <label class="font-weight-bold">{!! __('guarantors.relationship_details') !!} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" wire:model.defer="quick_relationship_details"
                                            class="form-control premium-input shadow-none"
                                            placeholder="{{ __('guarantors.relationship_details') }}">
                                        @error('quick_relationship_details')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <!-- Address -->
                            <div class="col-md-12 mb-1">
                                <div class="premium-form-group @error('quick_address') is-invalid-premium @enderror">
                                    <label class="font-weight-bold">{!! __('guarantors.address') !!}</label>
                                    <input type="text" wire:model.defer="quick_address"
                                        class="form-control premium-input shadow-none"
                                        placeholder="{{ __('guarantors.enter_address') }}"
                                        {{ $is_existing ? 'readonly' : '' }}>
                                    @error('quick_address')
                                        <span class="text-danger error-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Notes -->
                            <div class="col-md-12 mb-0">
                                <div class="premium-form-group mb-0 @error('quick_notes') is-invalid-premium @enderror">
                                    <label class="font-weight-bold">{!! __('guarantors.notes') !!}</label>
                                    <input type="text" wire:model.defer="quick_notes"
                                        class="form-control premium-input shadow-none"
                                        placeholder="{{ __('guarantors.enter_notes') }}"
                                        {{ $is_existing ? 'readonly' : '' }}>
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
                            <i wire:loading.remove wire:target="saveQuickGuarantor" class="fas fa-check-circle mr-2"></i>
                            <i wire:loading wire:target="saveQuickGuarantor" class="fas fa-sync fa-spin mr-2"></i>
                            {{ __('guarantors.add_guarantor') }}
                        </button>
                        <button type="button" class="btn btn-premium-secondary px-4 font-weight-bold"
                            data-dismiss="modal">
                            <i class="fas fa-times-circle mr-2"></i> {{ __('general.cancel') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@endpush
