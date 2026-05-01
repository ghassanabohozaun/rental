<div class="modal modal-pop fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="{!! route('dashboard.maintenances.store') !!}" method="POST" id='create_form' novalidate
            data-success-msg="{!! __('general.add_success_message') !!}" data-success-action="reload-table" data-table-id="#table_data">
            @csrf
            <div class="modal-content border-0">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-dark" id="createModalLabel">
                        <i class="la la-plus-circle mr-1 text-primary" style="font-size: 22px;"></i>
                        {!! __('maintenances.add_maintenance') !!}
                    </h5>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="la la-times"></i>
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
                                    <label for="company_id_create">{!! __('companies.company') !!} <span
                                            class="text-danger">*</span></label>
                                    <div class="premium-input-wrapper">
                                        <select
                                            class="form-control premium-input shadow-none js-select2 js-autocomplete"
                                            id='company_id_create' name="company_id" data-url="{!! route('dashboard.companies.autocomplete') !!}"
                                            data-placeholder="{!! __('general.select_company') !!}" data-parent="#createModal">
                                            <option></option>
                                        </select>
                                    </div>
                                    <span class="error-text company_id_error text-danger small"></span>
                                </div>
                            </div>
                        @endif

                        <!-- Property -->
                        <div class="col-md-6 mb-3">
                            <div class="premium-form-group">
                                <label for="property_id_create">{!! __('maintenances.property') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none js-select2 js-autocomplete"
                                        id="property_id_create" name="property_id" data-url="{!! route('dashboard.properties.autocomplete') !!}"
                                        data-simple="true" data-placeholder="{!! __('general.select_from_list') !!}"
                                        data-parent="#createModal">
                                        <option value="" disabled selected></option>
                                    </select>
                                    <i class="la la-building text-primary"></i>
                                </div>
                                <span class="error-text property_id_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <div class="premium-form-group">
                                <label for="status_create">{!! __('maintenances.status') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none js-select2" id="status_create"
                                        name="status" data-parent="#createModal">
                                        <option value="pending" selected>{!! __('maintenances.pending') !!}</option>
                                        <option value="in_progress">{!! __('maintenances.in_progress') !!}</option>
                                        <option value="done">{!! __('maintenances.done') !!}</option>
                                    </select>
                                    <i class="la la-check-circle text-primary"></i>
                                </div>
                                <span class="error-text status_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="col-md-6 mb-3">
                            <div class="premium-form-group">
                                <label for="date_create">{!! __('maintenances.date') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text"
                                        class="form-control premium-input shadow-none text-left ptc-datepicker"
                                        id="date_create" name="date" placeholder="{!! __('maintenances.date') !!}"
                                        autocomplete="off">
                                    <i class="la la-calendar text-primary"></i>
                                </div>
                                <span class="error-text date_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Cost -->
                        <div class="col-md-6 mb-3">
                            <div class="premium-form-group">
                                <label for="cost_create">{!! __('maintenances.cost') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="number" step="0.01" class="form-control premium-input shadow-none"
                                        id="cost_create" name="cost" placeholder="{!! __('maintenances.cost') !!}"
                                        autocomplete="off">
                                    <i class="la la-money text-primary"></i>
                                </div>
                                <span class="error-text cost_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Description AR -->
                        <div class="col-md-6 mb-3">
                            <div class="premium-form-group">
                                <label for="description_ar_create">{!! __('maintenances.description') !!}
                                    ({!! __('general.ar') !!})</label>
                                <div class="premium-input-wrapper no-icon">
                                    <textarea class="form-control premium-input shadow-none" id="description_ar_create" name="description_ar"
                                        rows="4" placeholder="{!! __('maintenances.description') !!} ({!! __('general.ar') !!})"></textarea>
                                </div>
                                <span class="error-text description_ar_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Description EN -->
                        <div class="col-md-6 mb-3">
                            <div class="premium-form-group">
                                <label for="description_en_create">{!! __('maintenances.description') !!}
                                    ({!! __('general.en') !!})</label>
                                <div class="premium-input-wrapper no-icon">
                                    <textarea class="form-control premium-input shadow-none" id="description_en_create" name="description_en"
                                        rows="4" placeholder="{!! __('maintenances.description') !!} ({!! __('general.en') !!})"></textarea>
                                </div>
                                <span class="error-text description_en_error text-danger small"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <div class="modal-footer border-0 pt-0">
                    <button type="submit" id="saveBtn"
                        class="btn btn-premium-add px-4 font-weight-bold h-42 radius-10">
                        <i class="la la-save mr-1"></i> {{ __('general.save') }}
                        <i class="la la-refresh la-spin spinner_loading d-none ml-1"></i>
                    </button>

                    <button type="button" class="btn btn-premium-secondary px-4 font-weight-bold h-42 radius-10"
                        data-dismiss="modal">
                        <i class="la la-times-circle mr-1"></i> {{ __('general.cancel') }}
                    </button>
                </div>
                <!--end::modal footer-->

            </div>
        </form>
    </div>
</div>
