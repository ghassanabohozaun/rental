<div class="content-wrapper">
    <!-- begin: content header -->
    <div class="content-header row align-items-center mb-2">
        <div class="content-header-left col-md-6 col-12 mb-2 mb-md-0">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb premium-breadcrumb shadow-sm">
                        <li class="breadcrumb-item"><a href="{!! route('dashboard.index') !!}"><i class="fas fa-home"></i>
                                {!! __('dashboard.home') !!}</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('dashboard.properties.index') !!}">{!! __('properties.properties') !!}</a></li>
                        <li class="breadcrumb-item active font-weight-bold">{!! __('properties.create_new_property') !!}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12 text-md-right mb-2">
            <div class="d-flex justify-content-md-end justify-content-center gap-2">
                <a href="{!! route('dashboard.properties.index') !!}" class="btn-premium-back">
                    <i class="fas fa-arrow-left"></i> {!! __('general.back') !!}
                </a>
                <button type="button" wire:click="store" class="btn btn-premium-save">
                    <i wire:loading.remove wire:target="store" class="fas fa-save mr-2"></i>
                    <i wire:loading wire:target="store" class="fas fa-spinner fa-spin mr-2"></i>
                    {!! __('general.save') !!}
                </button>
            </div>
        </div>
    </div>
    <!-- end :content header -->

    <!-- begin: content body -->
    <div class="content-body">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-12">
                    <!-- Section 1: Basic Information -->
                    <!-- Section 1: Basic Information -->
                    <div class="card premium-card mb-2 premium-card-anim">
                        <div class="premium-mandatory-header py-2 border-bottom-0">
                            <div class="title-wrapper">
                                <i class="fas fa-info-circle"></i>
                                <span class="font-weight-bold">{!! __('properties.basic_info') !!}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if (user()->company_id == 1)
                                    <div class="col-md-12 mb-2">
                                        <div
                                            class="premium-form-group @error('company_id') is-invalid-premium @enderror">
                                            <label class="premium-label">{!! __('companies.company') !!} <span
                                                    class="text-danger">*</span></label>
                                            <div wire:ignore>
                                                <select id="company_id" wire:model.defer="company_id"
                                                    class="form-control premium-input shadow-none select2">
                                                    <option value="">{!! __('general.select_company') !!}</option>
                                                    @foreach ($companies as $company)
                                                        <option value="{{ $company->id }}">{{ $company->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('company_id')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <div class="col-xl-3 col-lg-6 mb-2">
                                    <div class="premium-form-group @error('parent_id') is-invalid-premium @enderror">
                                        <label class="premium-label">{!! __('properties.parent_property') !!}</label>
                                        <div wire:ignore>
                                            <select id="parent_id" wire:model.defer="parent_id" data-simple="true"
                                                class="form-control premium-input shadow-none select2 ajax-select">
                                                <option value="">{!! __('properties.standalone_property') !!}</option>
                                                @foreach ($parent_properties as $p)
                                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('parent_id')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-6 mb-2">
                                    <div class="premium-form-group @error('name.ar') is-invalid-premium @enderror">
                                        <label class="premium-label">{!! __('properties.name_ar') !!} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" wire:model.defer="name.ar"
                                            class="form-control premium-input shadow-none" autocomplete="off"
                                            placeholder="{!! __('properties.enter_name_ar') !!}">
                                        @error('name.ar')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-6 mb-2">
                                    <div class="premium-form-group @error('name.en') is-invalid-premium @enderror">
                                        <label class="premium-label">{!! __('properties.name_en') !!} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" wire:model.defer="name.en"
                                            class="form-control premium-input shadow-none" autocomplete="off"
                                            placeholder="{!! __('properties.enter_name_en') !!}">
                                        @error('name.en')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-6 mb-2">
                                    <div class="premium-form-group @error('file_number') is-invalid-premium @enderror">
                                        <label class="premium-label">{!! __('properties.file_number') !!}</label>
                                        <input type="text" wire:model.defer="file_number"
                                            class="form-control premium-input shadow-none" autocomplete="off"
                                            placeholder="{!! __('properties.enter_file_number') !!}">
                                        @error('file_number')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-6 mb-2">
                                    <div
                                        class="premium-form-group @error('property_type_id') is-invalid-premium @enderror">
                                        <label class="premium-label">{!! __('properties.type') !!} <span
                                                class="text-danger">*</span></label>
                                        <div wire:ignore>
                                            <select wire:model.defer="property_type_id"
                                                class="form-control premium-input shadow-none select2"
                                                id="property_type_id">
                                                <option value="">{!! __('general.select_from_list') !!}</option>
                                                @foreach ($property_types as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('property_type_id')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-6 mb-2">
                                    <div
                                        class="premium-form-group @error('property_status_id') is-invalid-premium @enderror">
                                        <label class="premium-label">{!! __('properties.status') !!} <span
                                                class="text-danger">*</span></label>
                                        <div wire:ignore>
                                            <select wire:model.defer="property_status_id"
                                                class="form-control premium-input shadow-none select2"
                                                id="property_status_id">
                                                <option value="">{!! __('general.select_from_list') !!}</option>
                                                @foreach ($property_statuses as $status)
                                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('property_status_id')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-6 mb-2">
                                    <div class="premium-form-group @error('floor') is-invalid-premium @enderror">
                                        <label class="premium-label">{!! __('properties.floor') !!}</label>
                                        <input type="text" wire:model.defer="floor"
                                            class="form-control premium-input shadow-none" autocomplete="off"
                                            placeholder="{!! __('properties.floor') !!}">
                                        @error('floor')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-6 mb-2">
                                    <div class="premium-form-group @error('description') is-invalid-premium @enderror">
                                        <label class="premium-label">{!! __('properties.description') !!}</label>
                                        <input type="text" wire:model.defer="description"
                                            class="form-control premium-input shadow-none" autocomplete="off"
                                            placeholder="{!! __('properties.enter_description') !!}">
                                        @error('description')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-xl-3 col-lg-6 mb-2">
                                    <div class="premium-form-group @error('area') is-invalid-premium @enderror">
                                        <label class="premium-label">{!! __('properties.area') !!}</label>
                                        <input type="number" step="0.01" wire:model.defer="area"
                                            class="form-control premium-input shadow-none" autocomplete="off"
                                            placeholder="{!! __('properties.enter_area') !!}">
                                        @error('area')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-4 mb-2">
                                    <div
                                        class="premium-form-group @error('zone_number') is-invalid-premium @enderror">
                                        <label class="premium-label">{!! __('properties.zone_number') !!}</label>
                                        <input type="text" wire:model.defer="zone_number"
                                            class="form-control premium-input shadow-none" autocomplete="off"
                                            placeholder="{!! __('properties.zone_number') !!}">
                                        @error('zone_number')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-4 mb-2">
                                    <div
                                        class="premium-form-group @error('street_number') is-invalid-premium @enderror">
                                        <label class="premium-label">{!! __('properties.street_number') !!}</label>
                                        <input type="text" wire:model.defer="street_number"
                                            class="form-control premium-input shadow-none" autocomplete="off"
                                            placeholder="{!! __('properties.street_number') !!}">
                                        @error('street_number')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-4 mb-2">
                                    <div
                                        class="premium-form-group @error('building_number') is-invalid-premium @enderror">
                                        <label class="premium-label">{!! __('properties.building_number') !!}</label>
                                        <input type="text" wire:model.defer="building_number"
                                            class="form-control premium-input shadow-none" autocomplete="off"
                                            placeholder="{!! __('properties.building_number') !!}">
                                        @error('building_number')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <!-- Section 2: Important Additional Details (Repeater) -->
                            <div class="premium-mandatory-section mt-4 mb-3">
                                <div class="premium-mandatory-header d-flex justify-content-between align-items-center">
                                    <div class="title-wrapper">
                                        <i class="fas fa-list-ol"></i>
                                        <span class="font-weight-bold">{!! __('properties.important_additional_details') !!}</span>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" wire:click.prevent="addAdditionalNumber" class="btn-premium-add-guarantor" title="{!! __('general.add') !!}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="premium-mandatory-body">
                                    <div id="additional-numbers-container">
                                        @forelse ($additional_numbers as $index => $number)
                                            <div class="maintenance-item-row align-all-items-row row align-items-start mb-2 pb-2 border-bottom" wire:key="additional-number-{{ $index }}">
                                                <div class="col-md-5">
                                                    <div class="premium-form-group mb-0 @error('additional_numbers.'.$index.'.type') is-invalid-premium @enderror">
                                                        <label class="premium-label">{!! __('properties.number_type') !!} <span class="text-danger">*</span></label>
                                                        <select wire:model.defer="additional_numbers.{{ $index }}.type" class="form-control premium-input shadow-none">
                                                            <option value="">{!! __('general.select_from_list') !!}</option>
                                                            <option value="electricity_account">{!! __('properties.electricity_account_number') !!}</option>
                                                            <option value="water_account">{!! __('properties.water_account_number') !!}</option>
                                                            <option value="title_deed">{!! __('properties.title_deed_number') !!}</option>
                                                            <option value="cadastral_number">{!! __('properties.property_number') !!}</option>
                                                            <option value="other">{!! __('general.other') !!}</option>
                                                        </select>
                                                        @error('additional_numbers.'.$index.'.type')
                                                            <span class="text-danger error-text">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="premium-form-group mb-0 @error('additional_numbers.'.$index.'.value') is-invalid-premium @enderror">
                                                        <label class="premium-label">{!! __('properties.number_value') !!} <span class="text-danger">*</span></label>
                                                        <input type="text" wire:model.defer="additional_numbers.{{ $index }}.value" class="form-control premium-input shadow-none" placeholder="{!! __('general.enter_value') !!}">
                                                        @error('additional_numbers.'.$index.'.value')
                                                            <span class="text-danger error-text">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-1 text-center">
                                                    <div class="premium-form-group mb-0">
                                                        <label class="premium-label d-block text-transparent" style="opacity: 0; user-select: none;">Del</label>
                                                        <div class="d-flex align-items-center justify-content-center action-btn-wrapper">
                                                            <button type="button" wire:click.prevent="removeAdditionalNumber({{ $index }})" class="btn-premium-action btn-premium-action-danger remove-item-btn shadow-none" title="{!! __('general.delete') !!}">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center p-3 text-dark font-weight-bold">
                                                <i class="fas fa-info-circle mr-1 text-primary"></i>
                                                {!! __('properties.no_additional_numbers_added') !!}
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Row 3: Owners & Ownership (Repeater) -->
                    <div class="card premium-card mb-2 @if ($errors->has('property_owners') || $errors->has('property_owners_total') || $errors->has('property_owners_primary')) premium-card-error-glow pulse-error @endif"
                        wire:key="owners-card-wrapper">
                        <div
                            class="premium-mandatory-header py-1 border-bottom-0 d-flex justify-content-between align-items-center position-relative">
                            <div class="title-wrapper">
                                <i class="fas fa-users"></i>
                                <span class="font-weight-bold">{!! __('properties.owners_and_ownership') !!}</span>
                            </div>

                            <div class="total-percentage-header-badge d-flex align-items-center position-absolute"
                                style="left: 50%; transform: translateX(-50%); white-space: nowrap;">
                                @php
                                    $total = collect($property_owners)->sum(function ($owner) {
                                        return is_numeric($owner['percentage']) ? (float) $owner['percentage'] : 0;
                                    });
                                    $badgeClass =
                                        $total == 100
                                            ? 'badge-light-success badge-glow-success'
                                            : ($total > 100
                                                ? 'badge-light-danger badge-glow-danger'
                                                : 'badge-light-primary badge-glow-primary');
                                @endphp
                                <span class="mr-1 font-weight-bold text-muted small">{!! __('properties.total_percentage') !!}:</span>
                                <span class="badge badge-pill {{ $badgeClass }} font-14 py-1 px-2">{{ $total }}% ({{ round($total * 24) }} حصة)</span>
                            </div>

                            <div class="text-center">
                                <button type="button" wire:click="openOwnerModal" class="btn-premium-add-guarantor"
                                    title="{{ __('properties.add_owner') }}">
                                    <i class="fas fa-user-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0 pb-3">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light-primary-opacity">
                                        <tr>
                                            <th class="align-middle py-3 border-top-0">{!! __('properties.owner_name_ar') !!}</th>
                                            <th class="align-middle py-3 border-top-0">{!! __('properties.owner_name_en') !!}</th>
                                            <th class="align-middle py-3 border-top-0">{!! __('properties.id_number_or_record') !!}</th>
                                            <th class="align-middle py-3 border-top-0">{!! __('properties.phone') !!}</th>
                                            <th class="align-middle py-3 border-top-0 text-center" style="width: 110px;">
                                                {!! __('properties.percentage') !!}</th>
                                            <th class="align-middle py-3 border-top-0 text-center" style="width: 120px;">
                                                {!! __('properties.shares') !!}</th>
                                            <th class="align-middle py-3 border-top-0 text-center" style="width: 90px;">
                                                {!! __('properties.is_primary') !!}</th>
                                            <th class="align-middle py-3 border-top-0 text-center" style="width: 60px;">
                                                <i class="fas fa-trash-alt header-trash-icon"></i>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($property_owners as $index => $owner)
                                            <tr class="owner-row" wire:key="owner-row-{{ $index }}">
                                                <td class="align-middle">
                                                    <div class="user-info-cell">
                                                        <span
                                                            class="user-name-text">{{ $owner['name_ar'] ?: '---' }}</span>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <span
                                                        class="text-muted small">{{ $owner['name_en'] ?: '---' }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span
                                                        class="text-muted font-weight-bold">{{ $owner['identification_number'] ?? '---' }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span
                                                        class="text-dark font-weight-bold text-left ltr-text">{{ $owner['phone'] ?? '---' }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="premium-form-group mb-0 mx-auto @error("property_owners.$index.percentage") is-invalid-premium @enderror"
                                                        style="max-width: 100px;">
                                                        <input type="number" step="0.01" id="perc_create_{{ $index }}" min="0" max="100"
                                                            wire:model.live.debounce.250ms="property_owners.{{ $index }}.percentage"
                                                            class="form-control premium-input shadow-none text-center compact-input"
                                                            autocomplete="off"
                                                            style="height: 32px !important; font-size: 0.9rem;"
                                                            placeholder="0.00 %">
                                                        @error("property_owners.$index.percentage")
                                                            <span class="text-danger error-text d-block mt-1"
                                                                style="font-size: 0.7rem;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="premium-form-group mb-0 mx-auto" style="max-width: 110px;">
                                                        <input type="number" step="1" id="shares_create_{{ $index }}" min="0" max="2400"
                                                            wire:model.live.debounce.250ms="property_owners.{{ $index }}.shares"
                                                            class="form-control premium-input shadow-none text-center compact-input"
                                                            autocomplete="off"
                                                            style="height: 32px !important; font-size: 0.9rem;"
                                                            placeholder="0">
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div
                                                        class="custom-control custom-radio custom-radio-premium d-inline-block">
                                                        <input type="radio"
                                                            wire:click="setPrimary({{ $index }})"
                                                            @if ($owner['is_primary']) checked @endif
                                                            id="primary_radio_{{ $index }}"
                                                            name="primary_owner_radio" class="custom-control-input">
                                                        <label class="custom-control-label"
                                                            for="primary_radio_{{ $index }}"></label>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <button type="button"
                                                        wire:click="removeOwner({{ $index }})"
                                                        class="btn-premium-action btn-premium-action-danger remove-owner-btn shadow-none btn-trash-cell">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center p-3 text-dark font-weight-bold">
                                                    <i class="fas fa-info-circle mr-1 text-primary"></i>
                                                    {!! __('properties.no_owners_added') !!}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @error('property_owners')
                                <div class="text-danger p-2 font-weight-bold small animated headShake text-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </div>
                            @enderror
                            @error('property_owners_total')
                                <div class="text-danger p-2 font-weight-bold small animated headShake text-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </div>
                            @enderror
                            @error('property_owners_primary')
                                <div class="text-danger p-2 font-weight-bold small animated headShake text-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>



                    <!-- Row for Property Attachments Repeater -->
                    <div class="card premium-card mb-2 premium-card-anim">
                        <div class="premium-mandatory-header py-2 border-bottom-0 d-flex justify-content-between align-items-center">
                            <div class="title-wrapper">
                                <i class="fas fa-paperclip"></i>
                                <span class="font-weight-bold">{!! __('properties.property_attachments') !!}</span>
                            </div>
                            <div class="text-center">
                                <button type="button" wire:click.prevent="addAttachment" class="btn-premium-add-guarantor" title="{{ __('properties.add_attachment') }}">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="attachments-container">
                                @forelse ($property_attachments as $index => $attachment)
                                    <div class="maintenance-item-row align-all-items-row row align-items-start mb-2 pb-2 border-bottom" wire:key="attachment-{{ $index }}">
                                        <div class="col-md-5">
                                            <div class="premium-form-group mb-0 @error('property_attachments.'.$index.'.name') is-invalid-premium @enderror">
                                                <label class="premium-label">{!! __('properties.attachment_name') !!} <span class="text-danger">*</span></label>
                                                <input type="text" wire:model.defer="property_attachments.{{ $index }}.name" class="form-control premium-input shadow-none" placeholder="{!! __('properties.enter_attachment_name') !!}">
                                                @error('property_attachments.'.$index.'.name')
                                                    <span class="text-danger error-text">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="premium-form-group mb-0 @error('property_attachments.'.$index.'.file') is-invalid-premium @enderror">
                                                <label class="premium-label">{!! __('properties.attachment') !!} <span class="text-danger">*</span></label>
                                                <div class="d-flex align-items-center w-100">
                                                    <div class="premium-file-upload-wrapper mt-0">
                                                        <input type="file" wire:model="property_attachments.{{ $index }}.file" class="d-none" id="attachment_{{ $index }}" accept=".jpg,.jpeg,.png,.pdf">
                                                        <label for="attachment_{{ $index }}" class="premium-file-label w-100 mb-0">
                                                            <div class="premium-file-box premium-file-box-match w-100 d-flex align-items-center justify-content-between">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="file-icon-box"><i class="fas fa-paperclip text-primary"></i></div>
                                                                    <span class="file-name text-muted text-truncate d-inline-block">
                                                                        @if (!empty($attachment['file']))
                                                                            {{ $attachment['file']->getClientOriginalName() }}
                                                                        @else
                                                                            {!! __('general.choose_file') !!}
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                                <span class="browse-badge browse-badge-primary">{!! __('general.browse') !!}</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    @if (!empty($attachment['file']) && in_array(strtolower($attachment['file']->extension()), ['png', 'jpg', 'jpeg']))
                                                        <div class="file-preview-container mx-1 d-flex align-items-center">
                                                            <img src="{{ $attachment['file']->temporaryUrl() }}" class="img-thumbnail shadow-sm" style="height: 30px; max-height: 30px; object-fit: cover; border-radius: 4px; margin-top: 0; padding: 1px;">
                                                        </div>
                                                    @elseif(!empty($attachment['file']) && strtolower($attachment['file']->extension()) == 'pdf')
                                                        <div class="file-preview-container mx-1 d-flex align-items-center">
                                                            <span class="browse-badge browse-badge-info" style="height: 24px; line-height: 20px; display: inline-flex; align-items: center; justify-content: center; gap: 4px; font-size: 0.7rem; text-transform: none; letter-spacing: 0; margin-top: 0; padding: 0 8px; border-radius: 4px; font-weight: 600;"><i class="fas fa-file-pdf"></i> PDF</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                @error('property_attachments.'.$index.'.file')
                                                    <span class="text-danger error-text">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-1 text-center">
                                            <div class="premium-form-group mb-0">
                                                <label class="premium-label d-block text-transparent" style="opacity: 0; user-select: none;">Delete</label>
                                                <div class="d-flex align-items-center justify-content-center action-btn-wrapper">
                                                    <button type="button" wire:click.prevent="removeAttachment({{ $index }})" class="btn-premium-action btn-premium-action-danger remove-item-btn shadow-none" title="{!! __('general.delete') !!}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center p-3 text-dark font-weight-bold">
                                        <i class="fas fa-info-circle mr-1 text-primary"></i>
                                        {!! __('properties.no_attachments_added') !!}
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <livewire:dashboard.properties.quick-owner-modal :parent_company_id="$company_id" />
</div>

@push('scripts')
    <script>
        window.addEventListener('close-modal', event => {
            $('#' + event.detail).modal('hide');
        });
        window.addEventListener('open-modal', event => {
            $('#' + event.detail).modal('show');
        });
    </script>
    <script src="{{ asset('assets/dashbaord/js/generic-select2.js') }}"></script>
    <script>
        function initSelect2() {
            $('.select2').each(function() {
                if ($(this).hasClass("select2-hidden-accessible")) {
                    $(this).select2('destroy');
                }
            });
            $('.select2:not(.ajax-select)').each(function() {
                $(this).select2({
                    width: '100%',
                    dir: $('html').attr('data-textdirection') || 'ltr',
                    dropdownParent: $('body')
                }).on('change', function(e) {
                    let wireModel = $(this).attr('wire:model.defer');
                    if (wireModel) {
                        @this.set(wireModel, e.target.value);
                    }
                });
            });
            const $parentSelect = $('#parent_id');
            if ($parentSelect.length && typeof initGenericSelect2 === "function") {
                const companyId = @this.get('company_id');
                initGenericSelect2($parentSelect, "{!! route('dashboard.properties.autocomplete') !!}", "{!! __('properties.standalone_property') !!}");
                const existingConfig = $parentSelect.data('select2').options.options;
                $parentSelect.select2($.extend(true, {}, existingConfig, {
                    width: '100%',
                    dropdownParent: $('body'),
                    ajax: {
                        data: function(params) {
                            return {
                                q: params.term,
                                page: params.page,
                                company_id: companyId
                            };
                        }
                    }
                }));
                $parentSelect.on('change', function(e) {
                    @this.set('parent_id', $(this).val());
                });
            }
        }
        document.addEventListener('livewire:initialized', () => {
            initSelect2();
            Livewire.on('rowAdded', () => {
                setTimeout(initSelect2, 150);
            });
            Livewire.hook('morph.updated', (el, component) => {
                if ($(el).is('select.select2') || $(el).find('select.select2').length > 0) {
                    initSelect2();
                }
            });
        });
        $(function() {
            initSelect2();
            
            // File Preview Logic
            $(document).on('change', '.file-upload-input', function (e) {
                var file = this.files[0];
                var $previewContainer = $(this).closest('.premium-form-group').find('.file-preview-container');
                $previewContainer.empty();
                
                if (file) {
                    var fileType = file.type;
                    if (fileType.match('image.*')) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $previewContainer.html('<img src="' + e.target.result + '" class="img-thumbnail shadow-sm" style="height: 30px; max-height: 30px; object-fit: cover; border-radius: 4px; margin-top: 0; padding: 1px;">');
                        }
                        reader.readAsDataURL(file);
                    } else if (fileType === 'application/pdf') {
                        $previewContainer.html('<span class="browse-badge browse-badge-info" style="height: 24px; line-height: 20px; display: inline-flex; align-items: center; justify-content: center; gap: 4px; font-size: 0.7rem; text-transform: none; letter-spacing: 0; margin-top: 0; padding: 0 8px; border-radius: 4px; font-weight: 600;"><i class="fas fa-file-pdf"></i> PDF</span>');
                    }
                }
            });
        });
    </script>
@endpush
