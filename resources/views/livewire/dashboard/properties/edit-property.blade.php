<div class="content-wrapper">



    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb premium-breadcrumb">
                        <li class="breadcrumb-item"><a href="{!! route('dashboard.index') !!}"><i class="fas fa-home"></i>
                                {!! __('dashboard.home') !!}</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('dashboard.properties.index') !!}">{!! __('properties.properties') !!}</a></li>
                        <li class="breadcrumb-item active font-weight-bold">{!! __('properties.update_property') !!}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12 text-md-right mb-2">
            <div class="d-flex justify-content-md-end justify-content-center gap-2">
                <a href="{!! route('dashboard.properties.index') !!}" class="btn-premium-back">
                    <i class="fas fa-arrow-left"></i> {!! __('general.back') !!}
                </a>
                <button type="button" wire:click="update" class="btn btn-premium-save">
                    <i wire:loading.remove wire:target="update" class="fas fa-save mr-2"></i>
                    <i wire:loading wire:target="update" class="fas fa-sync fa-spin mr-2"></i>
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
                <!-- Main Container for all sections -->
                <div class="col-12">
                    <!-- Section 1: Basic Information -->
                    <div class="card premium-card mb-2 premium-card-anim">
                        <div class="premium-mandatory-header py-2 border-bottom-0">
                            <div class="font-weight-bold text-dark">{!! __('properties.basic_info') !!}</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Row 1: Company Selection (Admin Only, Locked in Edit) -->
                                @if (user()->company_id == 1)
                                    <div class="col-md-12 mb-2">
                                        <div class="premium-form-group">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <label class="premium-label mb-0">{!! __('companies.company') !!} <span
                                                        class="text-danger">*</span></label>
                                                <span class="badge badge-light-warning py-1 px-2"
                                                    style="font-size: 0.75rem; border: 1px dashed #ffc107; border-radius: 6px;">
                                                    <i class="fas fa-lock mr-1"></i> {!! __('properties.company_locked_help') !!}
                                                </span>
                                            </div>
                                            <div class="@if ($errors->has('company_id')) is-invalid-premium @endif">
                                                <div wire:ignore>
                                                    <select id="company_id" wire:model.defer="company_id"
                                                        class="form-control premium-input shadow-none select2" disabled>
                                                        <option value="">{!! __('general.select_company') !!}</option>
                                                        @foreach ($companies as $company)
                                                            <option value="{{ $company->id }}">{{ $company->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @error('company_id')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <!-- Row 2: Dependency, Name AR, Name EN, Description -->
                                <!-- Row 1: Identity & File -->
                                <div class="row w-100 m-0 p-0">
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('properties.parent_property') !!}</label>
                                            <div class="@if ($errors->has('parent_id')) is-invalid-premium @endif">
                                                <div wire:ignore>
                                                    <select id="parent_id" wire:model.defer="parent_id"
                                                        data-simple="true"
                                                        class="form-control premium-input shadow-none select2 ajax-select">
                                                        <option value="">{!! __('properties.standalone_property') !!}</option>
                                                        @foreach ($parent_properties as $p)
                                                            <option value="{{ $p->id }}">{{ $p->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @error('parent_id')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('properties.name_ar') !!} <span
                                                    class="text-danger">*</span></label>
                                            <div
                                                class="premium-input-wrapper @if ($errors->has('name.ar')) is-invalid-premium @endif">
                                                <input type="text" wire:model.defer="name.ar"
                                                    class="form-control premium-input shadow-none" autocomplete="off"
                                                    placeholder="{!! __('properties.enter_name_ar') !!}">

                                            </div>
                                            @error('name.ar')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('properties.name_en') !!} <span
                                                    class="text-danger">*</span></label>
                                            <div
                                                class="premium-input-wrapper @if ($errors->has('name.en')) is-invalid-premium @endif">
                                                <input type="text" wire:model.defer="name.en"
                                                    class="form-control premium-input shadow-none" autocomplete="off"
                                                    placeholder="{!! __('properties.enter_name_en') !!}">

                                            </div>
                                            @error('name.en')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('properties.file_number') !!}</label>
                                            <div
                                                class="premium-input-wrapper @if ($errors->has('file_number')) is-invalid-premium @endif">
                                                <input type="text" wire:model.defer="file_number"
                                                    class="form-control premium-input shadow-none" autocomplete="off"
                                                    placeholder="{!! __('properties.enter_file_number') !!}">

                                            </div>
                                            @error('file_number')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 2: Categorization & Description -->
                                <div class="row w-100 m-0 p-0">
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('properties.type') !!} <span
                                                    class="text-danger">*</span></label>
                                            <div
                                                class="premium-input-wrapper @if ($errors->has('property_type_id')) is-invalid-premium @endif">
                                                <div wire:ignore>
                                                    <select wire:model.defer="property_type_id"
                                                        class="form-control premium-input shadow-none select2"
                                                        id="property_type_id">
                                                        <option value="">{!! __('general.select_from_list') !!}</option>
                                                        @foreach ($property_types as $type)
                                                            <option value="{{ $type->id }}">{{ $type->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @error('property_type_id')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('properties.status') !!} <span
                                                    class="text-danger">*</span></label>
                                            <div
                                                class="premium-input-wrapper @if ($errors->has('property_status_id')) is-invalid-premium @endif">
                                                <div wire:ignore>
                                                    <select wire:model.defer="property_status_id"
                                                        class="form-control premium-input shadow-none select2"
                                                        id="property_status_id">
                                                        <option value="">{!! __('general.select_from_list') !!}</option>
                                                        @foreach ($property_statuses as $status)
                                                            <option value="{{ $status->id }}">{{ $status->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @error('property_status_id')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('properties.description') !!}</label>
                                            <div class="premium-input-wrapper">
                                                <input type="text" wire:model.defer="description"
                                                    class="form-control premium-input shadow-none" autocomplete="off"
                                                    placeholder="{!! __('properties.enter_description') !!}">

                                            </div>
                                            @error('description')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 3: Financial & Location -->
                                <div class="row w-100 m-0 p-0">
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('properties.price') !!}</label>
                                            <div
                                                class="premium-input-wrapper @if ($errors->has('price')) is-invalid-premium @endif">
                                                <input type="number" step="0.01" wire:model.defer="price"
                                                    class="form-control premium-input shadow-none" autocomplete="off"
                                                    placeholder="{!! __('properties.enter_price') !!}">

                                            </div>
                                            @error('price')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('properties.area') !!}</label>
                                            <div
                                                class="premium-input-wrapper @if ($errors->has('area')) is-invalid-premium @endif">
                                                <input type="number" step="0.01" wire:model.defer="area"
                                                    class="form-control premium-input shadow-none" autocomplete="off"
                                                    placeholder="{!! __('properties.enter_area') !!}">

                                            </div>
                                            @error('area')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('properties.location') !!}</label>
                                            <div
                                                class="premium-input-wrapper @if ($errors->has('location')) is-invalid-premium @endif">
                                                <input type="text" wire:model.defer="location"
                                                    class="form-control premium-input shadow-none" autocomplete="off"
                                                    placeholder="{!! __('properties.enter_location') !!}">

                                            </div>
                                            @error('location')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 4: Technical Numbers -->
                                <div class="row w-100 m-0 p-0">
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('properties.property_number') !!}</label>
                                            <div
                                                class="premium-input-wrapper @if ($errors->has('property_number')) is-invalid-premium @endif">
                                                <input type="text" wire:model.defer="property_number"
                                                    class="form-control premium-input shadow-none" autocomplete="off"
                                                    placeholder="{!! __('properties.enter_property_number') !!}">

                                            </div>
                                            @error('property_number')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('properties.title_deed_number') !!}</label>
                                            <div
                                                class="premium-input-wrapper @if ($errors->has('title_deed_number')) is-invalid-premium @endif">
                                                <input type="text" wire:model.defer="title_deed_number"
                                                    class="form-control premium-input shadow-none" autocomplete="off"
                                                    placeholder="{!! __('properties.enter_title_deed_number') !!}">

                                            </div>
                                            @error('title_deed_number')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('properties.electricity_account_number') !!} <span
                                                    class="text-danger">*</span></label>
                                            <div
                                                class="premium-input-wrapper @if ($errors->has('electricity_account_number')) is-invalid-premium @endif">
                                                <input type="text" wire:model.defer="electricity_account_number"
                                                    class="form-control premium-input shadow-none" autocomplete="off"
                                                    placeholder="{!! __('properties.enter_electricity_account') !!}">

                                            </div>
                                            @error('electricity_account_number')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('properties.water_account_number') !!} <span
                                                    class="text-danger">*</span></label>
                                            <div
                                                class="premium-input-wrapper @if ($errors->has('water_account_number')) is-invalid-premium @endif">
                                                <input type="text" wire:model.defer="water_account_number"
                                                    class="form-control premium-input shadow-none" autocomplete="off"
                                                    placeholder="{!! __('properties.enter_water_account') !!}">

                                            </div>
                                            @error('water_account_number')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: Owners & Ownership (Repeater) -->
                    <div class="card premium-card mb-2 premium-card-anim @if ($errors->has('property_owners') || $errors->has('property_owners_total') || $errors->has('property_owners_primary')) premium-card-error-glow pulse-error @endif"
                        wire:key="owners-card-wrapper-{{ $validation_fail_nonce }}">
                        <div
                            class="premium-mandatory-header py-1 border-bottom-0 d-flex justify-content-between align-items-center position-relative">
                            <div class="font-weight-bold text-dark">{!! __('properties.owners_and_ownership') !!}</div>

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
                                <span
                                    class="badge badge-pill {{ $badgeClass }} font-14 py-1 px-2">{{ $total }}%</span>
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
                                            <th class="align-middle py-3 border-top-0">
                                                {!! __('properties.owner_name_ar') !!}</th>
                                            <th class="align-middle py-3 border-top-0">
                                                {!! __('properties.owner_name_en') !!}</th>
                                            <th class="align-middle py-3 border-top-0">
                                                {!! __('properties.id_number_or_record') !!}</th>
                                            <th class="align-middle py-3 border-top-0">
                                                {!! __('properties.phone') !!}</th>
                                            <th class="align-middle py-3 border-top-0 text-center">
                                                {!! __('properties.percentage') !!}</th>
                                            <th class="align-middle py-3 border-top-0 text-center">
                                                {!! __('properties.is_primary') !!}</th>
                                            <th class="align-middle py-3 border-top-0 text-center">
                                                <i class="fas fa-trash-alt header-trash-icon"></i>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($property_owners as $index => $owner)
                                            <tr class="owner-row"
                                                wire:key="owner-row-{{ $index }}-{{ $validation_fail_nonce }}">
                                                <td class="align-middle">
                                                    <div class="user-info-cell">
                                                        <span class="user-name-text">
                                                            {{ $owner['name_ar'] ?: '---' }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="text-muted small">
                                                        {{ $owner['name_en'] ?: '---' }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="text-muted font-weight-bold">
                                                        {{ $owner['identification_number'] ?? '---' }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="text-dark font-weight-bold text-left ltr-text">
                                                        {{ $owner['phone'] ?? '---' }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="premium-form-group mb-0 mx-auto"
                                                        style="max-width: 100px;">
                                                        <div
                                                            class="premium-input-wrapper @if ($errors->has("property_owners.$index.percentage")) is-invalid-premium @endif">
                                                            <input type="number" step="0.01"
                                                                wire:model.live="property_owners.{{ $index }}.percentage"
                                                                class="form-control premium-input shadow-none text-center compact-input"
                                                                autocomplete="off"
                                                                style="height: 32px !important; font-size: 0.9rem;"
                                                                placeholder="0.00 %">
                                                        </div>
                                                        @error("property_owners.$index.percentage")
                                                            <span class="text-danger error-text d-block mt-1"
                                                                style="font-size: 0.7rem;">{{ $message }}</span>
                                                        @enderror
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



                    <!-- Row for Attachments -->
                    <div class="card premium-card mb-2 premium-card-anim">
                        <div class="premium-mandatory-header py-2 border-bottom-0">
                            <div class="font-weight-bold text-dark">{!! __('properties.attachments') !!}</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- Original Rental Contract --}}
                                <div class="col-md-4 mb-2">
                                    <div class="premium-form-group">
                                        <div class="premium-label d-flex align-items-center">
                                            <span class="mr-1">{!! __('properties.rental_contract_original') !!}</span>
                                            <div class="file-action-buttons">
                                                @if ($existing_rental_contract_original)
                                                    <a href="{{ asset('uploads/properties/' . $existing_rental_contract_original) }}"
                                                        target="_blank" class="btn-file-action btn-view-file"
                                                        title="{!! __('general.view') !!}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endif
                                                @if ($rental_contract_original || $existing_rental_contract_original)
                                                    <button type="button"
                                                        wire:click="resetFile('{{ $rental_contract_original ? 'rental_contract_original' : 'existing_rental_contract_original' }}')"
                                                        class="btn-file-action btn-delete-file"
                                                        title="{!! __('general.remove') !!}">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                        <div
                                            class="premium-file-upload-wrapper @if ($errors->has('rental_contract_original')) is-invalid-premium @endif">
                                            <input type="file" wire:model="rental_contract_original"
                                                class="d-none" id="rental_contract_original">
                                            <label for="rental_contract_original"
                                                class="premium-file-label w-100 mb-0">
                                                <div
                                                    class="premium-file-box d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="file-icon-box"><i
                                                                class="fas fa-file-contract text-primary"></i></div>
                                                        <span class="file-name text-muted">
                                                            @if ($rental_contract_original)
                                                                {{ $rental_contract_original->getClientOriginalName() }}
                                                            @elseif($existing_rental_contract_original)
                                                                <span
                                                                    class="text-success font-weight-bold">{{ basename($existing_rental_contract_original) }}</span>
                                                            @else
                                                                {!! __('general.choose_file') !!}
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <span
                                                        class="browse-badge browse-badge-primary">{!! __('general.browse') !!}</span>
                                                </div>
                                            </label>
                                        </div>
                                        @error('rental_contract_original')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Building Completion Certificate --}}
                                <div class="col-md-4 mb-2">
                                    <div class="premium-form-group">
                                        <div class="premium-label d-flex align-items-center">
                                            <span class="mr-1">{!! __('properties.building_completion_certificate') !!}</span>
                                            <div class="file-action-buttons">
                                                @if ($existing_building_completion_certificate)
                                                    <a href="{{ asset('uploads/properties/' . $existing_building_completion_certificate) }}"
                                                        target="_blank" class="btn-file-action btn-view-file"
                                                        title="{!! __('general.view') !!}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endif
                                                @if ($building_completion_certificate || $existing_building_completion_certificate)
                                                    <button type="button"
                                                        wire:click="resetFile('{{ $building_completion_certificate ? 'building_completion_certificate' : 'existing_building_completion_certificate' }}')"
                                                        class="btn-file-action btn-delete-file"
                                                        title="{!! __('general.remove') !!}">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                        <div
                                            class="premium-file-upload-wrapper @if ($errors->has('building_completion_certificate')) is-invalid-premium @endif">
                                            <input type="file" wire:model="building_completion_certificate"
                                                class="d-none" id="building_completion_certificate">
                                            <label for="building_completion_certificate"
                                                class="premium-file-label w-100 mb-0">
                                                <div
                                                    class="premium-file-box d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="file-icon-box"><i
                                                                class="fas fa-file-pdf text-danger"></i></div>
                                                        <span class="file-name text-muted">
                                                            @if ($building_completion_certificate)
                                                                {{ $building_completion_certificate->getClientOriginalName() }}
                                                            @elseif($existing_building_completion_certificate)
                                                                <span
                                                                    class="text-success font-weight-bold">{{ basename($existing_building_completion_certificate) }}</span>
                                                            @else
                                                                {!! __('general.choose_file') !!}
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <span
                                                        class="browse-badge browse-badge-danger">{!! __('general.browse') !!}</span>
                                                </div>
                                            </label>
                                        </div>
                                        @error('building_completion_certificate')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Other Documents --}}
                                <div class="col-md-4 mb-2">
                                    <div class="premium-form-group">
                                        <div class="premium-label d-flex align-items-center">
                                            <span class="mr-1">{!! __('properties.other_documents') !!}</span>
                                            <div class="file-action-buttons">
                                                @if ($existing_other_documents)
                                                    <a href="{{ asset('uploads/properties/' . $existing_other_documents) }}"
                                                        target="_blank" class="btn-file-action btn-view-file"
                                                        title="{!! __('general.view') !!}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endif
                                                @if ($other_documents || $existing_other_documents)
                                                    <button type="button"
                                                        wire:click="resetFile('{{ $other_documents ? 'other_documents' : 'existing_other_documents' }}')"
                                                        class="btn-file-action btn-delete-file"
                                                        title="{!! __('general.remove') !!}">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                        <div
                                            class="premium-file-upload-wrapper @if ($errors->has('other_documents')) is-invalid-premium @endif">
                                            <input type="file" wire:model="other_documents" class="d-none"
                                                id="other_documents">
                                            <label for="other_documents" class="premium-file-label w-100 mb-0">
                                                <div
                                                    class="premium-file-box d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="file-icon-box"><i
                                                                class="fas fa-file-alt text-info"></i></div>
                                                        <span class="file-name text-muted">
                                                            @if ($other_documents)
                                                                {{ $other_documents->getClientOriginalName() }}
                                                            @elseif($existing_other_documents)
                                                                <span
                                                                    class="text-success font-weight-bold">{{ basename($existing_other_documents) }}</span>
                                                            @else
                                                                {!! __('general.choose_file') !!}
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <span
                                                        class="browse-badge browse-badge-info">{!! __('general.browse') !!}</span>
                                                </div>
                                            </label>
                                        </div>
                                        @error('other_documents')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
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
                    dropdownParent: $(this).parent()
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
                    dropdownParent: $parentSelect.parent(),
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

            // Re-init Select2 on every morph update to catch validation refreshes
            Livewire.hook('morph.updated', (el, component) => {
                if ($(el).is('select.select2') || $(el).find('select.select2').length > 0) {
                    initSelect2();
                }
            });
        });
        $(function() {
            initSelect2();
        });
    </script>
@endpush
