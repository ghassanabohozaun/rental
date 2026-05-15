<div class="content-wrapper">

    <!-- begin: content header -->
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb premium-breadcrumb">
                        <li class="breadcrumb-item"><a href="{!! route('dashboard.index') !!}"><i class="fas fa-home"></i>
                                {!! __('dashboard.home') !!}</a></li>
                        <li class="breadcrumb-item"><a href="{!! route('dashboard.customers.index') !!}">{!! __('customers.customers') !!}</a></li>
                        <li class="breadcrumb-item active font-weight-bold">{!! __('customers.add_customer') !!}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12 text-md-right mb-2">
            <div class="d-flex justify-content-md-end justify-content-center gap-2">
                <a href="{!! route('dashboard.customers.index') !!}" class="btn-premium-back">
                    <i class="fas fa-arrow-left"></i> {!! __('general.back') !!}
                </a>
                <button type="button" wire:click="store" class="btn btn-premium-save shadow-pulse">
                    <i class="fas fa-save"></i> {!! __('general.save') !!}
                    <span wire:loading wire:target="store" class="fas fa-sync fa-spin ml-1"></span>
                </button>
            </div>
        </div>
    </div>
    <!-- end :content header -->

    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card premium-card mb-2 premium-card-anim">
                    <div class="premium-mandatory-header py-2 border-bottom-0">
                        <div class="font-weight-bold text-dark">{!! __('customers.personal_info') !!}</div>
                    </div>
                    <div class="card-body">
                        @if (user()->company_id == 1)
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <div class="premium-form-group">
                                        <label class="premium-label">{!! __('companies.company') !!} <span
                                                class="text-danger">*</span></label>
                                        <div wire:ignore>
                                            <select id="company_id_header" wire:model.defer="company_id"
                                                class="form-control premium-input shadow-none select2 @error('company_id') is-invalid-premium @enderror">
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
                            </div>
                        @endif

                        <div class="row mt-1">
                            <div class="col-md-12">
                                <div class="premium-form-group">
                                    <label class="premium-label">{!! __('customers.tenant_type') !!} <span
                                            class="text-danger">*</span></label>
                                    <div wire:ignore>
                                        <select id="tenant_type" wire:model.live="tenant_type"
                                            class="form-control premium-input shadow-none select2 @error('tenant_type') is-invalid-premium @enderror">
                                            <option value="">{!! __('customers.select_tenant_type') !!}</option>
                                            <option value="individual">{!! __('customers.individual') !!}</option>
                                            <option value="company">{!! __('customers.company') !!}</option>
                                        </select>
                                    </div>
                                    @error('tenant_type')
                                        <span class="text-danger error-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if ($tenant_type)
                            <div>
                                @if ($tenant_type == 'company')
                                    <div class="row mt-1 animate__animated animate__fadeIn">
                                        <div class="col-md-3">
                                            <div class="premium-form-group">
                                                <label class="premium-label">{!! __('customers.customer_company_name') !!} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" wire:model.defer="company_name"
                                                    class="form-control premium-input shadow-none @error('company_name') is-invalid-premium @enderror"
                                                    placeholder="{!! __('customers.customer_company_name') !!}">
                                                @error('company_name')
                                                    <span class="text-danger error-text">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="premium-form-group">
                                                <label class="premium-label">{!! __('customers.establishment_number') !!} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" wire:model.defer="establishment_number"
                                                    class="form-control premium-input shadow-none @error('establishment_number') is-invalid-premium @enderror"
                                                    placeholder="{!! __('customers.establishment_number') !!}">
                                                @error('establishment_number')
                                                    <span class="text-danger error-text">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="premium-form-group">
                                                <label class="premium-label">{!! __('customers.cr_number') !!} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" wire:model.defer="cr_number"
                                                    class="form-control premium-input shadow-none @error('cr_number') is-invalid-premium @enderror"
                                                    placeholder="{!! __('customers.cr_number') !!}">
                                                @error('cr_number')
                                                    <span class="text-danger error-text">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="premium-form-group">
                                                <label class="premium-label">{!! __('customers.license_number') !!} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" wire:model.defer="license_number"
                                                    class="form-control premium-input shadow-none @error('license_number') is-invalid-premium @enderror"
                                                    placeholder="{!! __('customers.license_number') !!}">
                                                @error('license_number')
                                                    <span class="text-danger error-text">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row mt-1">
                                    <div class="col-md-3">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('customers.name_ar') !!} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" wire:model.defer="name.ar"
                                                class="form-control premium-input shadow-none @error('name.ar') is-invalid-premium @enderror"
                                                placeholder="{!! __('customers.name_ar') !!}">
                                            @error('name.ar')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('customers.name_en') !!} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" wire:model.defer="name.en"
                                                class="form-control premium-input shadow-none @error('name.en') is-invalid-premium @enderror"
                                                placeholder="{!! __('customers.name_en') !!}">
                                            @error('name.en')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('customers.phone') !!} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" wire:model.defer="phone"
                                                class="form-control premium-input shadow-none text-left @error('phone') is-invalid-premium @enderror"
                                                dir="ltr" placeholder="{!! __('customers.phone') !!}">
                                            @error('phone')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('customers.id_number') !!} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" wire:model.defer="id_number"
                                                class="form-control premium-input shadow-none @error('id_number') is-invalid-premium @enderror"
                                                placeholder="{!! __('customers.id_number') !!}">
                                            @error('id_number')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-3">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('customers.nationality') !!} <span
                                                    class="text-danger">*</span></label>
                                            <div wire:ignore
                                                wire:key="nationality-select-wrapper-{{ $tenant_type }}">
                                                <select id="nationality_id" wire:model.defer="nationality_id"
                                                    class="form-control premium-input shadow-none select2 @error('nationality_id') is-invalid-premium @enderror">
                                                    <option value="">{!! __('general.select_from_list') !!}</option>
                                                    @foreach ($nationalities as $nationality)
                                                        <option value="{{ $nationality->id }}">
                                                            {{ $nationality->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('nationality_id')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('customers.email') !!} <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" wire:model.defer="email"
                                                class="form-control premium-input shadow-none text-left @error('email') is-invalid-premium @enderror"
                                                dir="ltr" placeholder="{!! __('customers.email') !!}">
                                            @error('email')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="premium-form-group">
                                            <label class="premium-label">{!! __('customers.address') !!} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" wire:model.defer="address"
                                                class="form-control premium-input shadow-none @error('address') is-invalid-premium @enderror"
                                                placeholder="{!! __('customers.address') !!}">
                                            @error('address')
                                                <span class="text-danger error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif

                    </div>
                </div>
            </div>

            <!-- Section 2: Guarantors (Repeater) -->
            <div class="col-12">
                <div class="card premium-card mb-2 @error('customer_guarantors') premium-card-error-glow pulse-error @enderror"
                    wire:key="guarantors-card-wrapper-{{ $validation_fail_nonce }}">
                    <div
                        class="premium-mandatory-header py-1 border-bottom-0 d-flex justify-content-between align-items-center">
                        <div class="font-weight-bold text-dark">{!! __('customers.guarantors') !!}</div>
                        <div class="text-center">
                            <button type="button" wire:click="openGuarantorModal" class="btn-premium-add-guarantor"
                                title="{{ __('guarantors.add_guarantor') }}">
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
                                            {!! __('guarantors.name_ar') !!}</th>
                                        <th class="align-middle py-3 border-top-0">
                                            {!! __('guarantors.name_en') !!}</th>
                                        <th class="align-middle py-3 border-top-0">
                                            {!! __('customers.id_number') !!}</th>
                                        <th class="align-middle py-3 border-top-0">
                                            {!! __('customers.phone') !!}</th>
                                        <th class="align-middle py-3 border-top-0 text-center">
                                            {!! __('guarantors.relationship') !!}</th>
                                        <th class="align-middle py-3 border-top-0 text-center">
                                            <i class="fas fa-trash-alt header-trash-icon"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($customer_guarantors as $index => $guarantor)
                                        <tr class="owner-row" wire:key="guarantor-row-{{ $index }}">
                                            <!-- Name AR -->
                                            <td class="align-middle">
                                                <div class="user-info-cell">
                                                    <span class="user-name-text">
                                                        {{ $guarantor['name_ar'] ?: '---' }}
                                                    </span>
                                                </div>
                                            </td>
                                            <!-- Name EN -->
                                            <td class="align-middle">
                                                <span class="text-muted small">
                                                    {{ $guarantor['name_en'] ?: '---' }}
                                                </span>
                                            </td>
                                            <!-- ID Number -->
                                            <td class="align-middle">
                                                <span class="text-dark font-weight-bold">
                                                    {{ $guarantor['id_number'] ?: '---' }}
                                                </span>
                                            </td>
                                            <!-- Phone -->
                                            <td class="align-middle">
                                                <span class="text-dark font-weight-bold text-left ltr-text">
                                                    {{ $guarantor['phone'] ?? '---' }}
                                                </span>
                                            </td>
                                            <!-- Relationship -->
                                            <td class="align-middle text-center">
                                                @php
                                                    $relKey = $guarantor['relationship'] ?? '';
                                                    $relName = __('guarantors.relationships.' . $relKey);
                                                    if (strpos($relName, 'guarantors.relationships') !== false) {
                                                        $relName = $relKey;
                                                    }
                                                @endphp
                                                <span
                                                    class="badge badge-light-info-opacity text-info badge-pill border-0 px-2 font-weight-bold">
                                                    {{ $relName ?: '---' }}
                                                </span>
                                                @if (($guarantor['relationship'] ?? '') == 10 && !empty($guarantor['relationship_details']))
                                                    <div class="small text-muted mt-1">
                                                        ({{ $guarantor['relationship_details'] }})
                                                    </div>
                                                @endif
                                            </td>
                                            <!-- Actions -->
                                            <td class="align-middle text-center">
                                                <button type="button"
                                                    wire:click="removeGuarantor({{ $index }})"
                                                    class="btn-premium-action btn-premium-action-danger remove-guarantor-btn shadow-none btn-trash-cell">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center p-3 text-dark font-weight-bold">
                                                <i class="fas fa-info-circle mr-1 text-primary"></i>
                                                {!! __('customers.no_guarantors_added') !!}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @error('customer_guarantors')
                            <div class="text-danger p-2 font-weight-bold small animated headShake text-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Row 4: Notes -->
            <div class="col-12">
                <div class="card premium-card mb-2 premium-card-anim">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="premium-form-group mb-0">
                                    <label class="premium-label">{!! __('customers.notes') !!}</label>
                                    <textarea wire:model.defer="notes" class="form-control premium-input shadow-none" rows="5"
                                        placeholder="{!! __('customers.notes') !!}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <livewire:dashboard.customers.quick-guarantor-modal :parent_company_id="$company_id" />
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
        $(document).ready(function() {
            function initSelects() {
                $('.select2:not(.ajax-select)').each(function() {
                    let $this = $(this);
                    let model = $this.attr('wire:model.defer') || $this.attr('wire:model.lazy') || $this
                        .attr('wire:model.live') || $this.attr('wire:model');

                    $this.select2({
                        width: '100%',
                        dir: $('html').attr('data-textdirection') || 'ltr',
                        dropdownParent: $this.parent()
                    }).on('change', function(e) {
                        if (model) {
                            @this.set(model, e.target.value);
                        }
                    });
                });
            }

            initSelects();

            // Targeted listener for guarantor updates
            Livewire.on('guarantorUpdated', (data) => {
                let index = data[0].index;
                let companyId = data[0].company_id;
                let $companySelect = $('#company_select_' + index);

                if ($companySelect.length) {
                    $companySelect.val(companyId).trigger('change');
                    $companySelect.trigger('change.select2');
                }
            });

            window.addEventListener('reinitSelect2', event => {
                setTimeout(() => {
                    initSelects();
                }, 50);
            });
        });
    </script>
@endpush
