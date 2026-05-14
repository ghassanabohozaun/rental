<div class="modal modal-pop" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="{!! route('dashboard.maintenances.store') !!}" method="POST" id='create_form' novalidate
            data-success-msg="{!! __('general.add_success_message') !!}" data-success-action="reload-table" data-table-id="#table_data">
            @csrf
            <div class="modal-content border-0">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center" id="createModalLabel">
                        <i class="fas fa-plus-circle text-primary mr-2 icon-size-18"></i>
                        {!! __('maintenances.add_maintenance') !!}
                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body my-2">
                    <div class="row">
                        <!-- Company -->
                        @if (user()->company_id == 1)
                            <div class="col-md-12 mb-3">
                                <div class="premium-form-group">
                                    <label class="premium-label" for="company_id_create">{!! __('companies.company') !!} <span
                                            class="text-danger">*</span></label>
                                    <div class="premium-input-wrapper">
                                        <select class="form-control premium-input shadow-none js-select2"
                                            id='company_id_create' name="company_id" data-parent="#createModal">
                                            <option value="">{!! __('general.select_from_list') !!}</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                        <i class="fas fa-briefcase text-primary"></i>
                                    </div>
                                    <span class="text-danger error-text company_id_error"></span>
                                </div>
                            </div>
                        @endif

                        <!-- Property -->
                        <div class="col-md-6 mb-3">
                            <div class="premium-form-group">
                                <label class="premium-label" for="property_id_create">{!! __('maintenances.property') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none js-select2 js-autocomplete"
                                        id="property_id_create" name="property_id" data-url="{!! route('dashboard.properties.autocomplete') !!}"
                                        data-simple="true" data-placeholder="{!! __('general.select_from_list') !!}"
                                        data-parent="#createModal" {{ user()->company_id == 1 ? 'disabled' : '' }}>
                                        <option value="" disabled selected></option>
                                    </select>
                                    <i class="fas fa-building text-primary"></i>
                                </div>
                                <span class="text-danger error-text property_id_error"></span>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <div class="premium-form-group">
                                <label class="premium-label" for="status_create">{!! __('maintenances.status') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none js-select2" id="status_create"
                                        name="status" data-parent="#createModal">
                                        <option value="">{!! __('general.select_from_list') !!}</option>
                                        <option value="pending">{!! __('maintenances.pending') !!}</option>
                                        <option value="in_progress">{!! __('maintenances.in_progress') !!}</option>
                                        <option value="done">{!! __('maintenances.done') !!}</option>
                                    </select>
                                    <i class="fas fa-check-circle text-primary"></i>
                                </div>
                                <span class="text-danger error-text status_error"></span>
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="col-md-6 mb-3">
                            <div class="premium-form-group">
                                <label class="premium-label" for="date_create">{!! __('maintenances.date') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text"
                                        class="form-control premium-input shadow-none text-left ptc-datepicker"
                                        id="date_create" name="date" placeholder="{!! __('maintenances.date') !!}"
                                        autocomplete="off">
                                    <i class="fas fa-calendar-alt text-primary"></i>
                                </div>
                                <span class="text-danger error-text date_error"></span>
                            </div>
                        </div>

                        <!-- Cost -->
                        <div class="col-md-6 mb-3">
                            <div class="premium-form-group">
                                <label class="premium-label" for="cost_create">{!! __('maintenances.cost') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="number" step="0.01" class="form-control premium-input shadow-none"
                                        id="cost_create" name="cost" placeholder="{!! __('maintenances.cost') !!}"
                                        autocomplete="off">
                                    <i class="fas fa-money-bill-wave text-primary"></i>
                                </div>
                                <span class="text-danger error-text cost_error"></span>
                            </div>
                        </div>

                        <!-- Description AR -->
                        <div class="col-md-6 mb-3">
                            <div class="premium-form-group">
                                <label class="premium-label" for="description_ar_create">{!! __('maintenances.description') !!}
                                    ({!! __('general.ar') !!})</label>
                                <div class="premium-input-wrapper">
                                    <textarea class="form-control premium-input shadow-none radius-15" id="description_ar_create" name="description_ar"
                                        rows="3" placeholder="{!! __('maintenances.description') !!} ({!! __('general.ar') !!})"></textarea>
                                    <i class="fas fa-info-circle text-primary"></i>
                                </div>
                                <span class="text-danger error-text description_ar_error"></span>
                            </div>
                        </div>

                        <!-- Description EN -->
                        <div class="col-md-6 mb-3">
                            <div class="premium-form-group">
                                <label class="premium-label" for="description_en_create">{!! __('maintenances.description') !!}
                                    ({!! __('general.en') !!})</label>
                                <div class="premium-input-wrapper">
                                    <textarea class="form-control premium-input shadow-none radius-15" id="description_en_create" name="description_en"
                                        rows="3" placeholder="{!! __('maintenances.description') !!} ({!! __('general.en') !!})"></textarea>
                                    <i class="fas fa-info-circle text-primary"></i>
                                </div>
                                <span class="text-danger error-text description_en_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <div class="modal-footer border-0 pt-0">
                    <button type="submit" id="saveBtn"
                        class="btn btn-premium-save shadow-pulse px-4 font-weight-bold h-42 radius-10"
                        style="min-width: 120px;">
                        <i class="fas fa-save"></i> {{ __('general.save') }}
                        <i class="fas fa-sync fa-spin spinner_loading d-none ml-1"></i>
                    </button>

                    <button type="button" class="btn btn-premium-secondary px-4 font-weight-bold h-42 radius-10"
                        data-dismiss="modal" style="min-width: 120px;">
                        <i class="fas fa-times-circle mr-1"></i> {{ __('general.cancel') }}
                    </button>
                </div>
                <!--end::modal footer-->

            </div>
        </form>
    </div>
</div>
