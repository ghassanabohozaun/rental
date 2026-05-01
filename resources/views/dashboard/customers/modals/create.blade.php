<div class="modal modal-pop fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="{!! route('dashboard.customers.store') !!}" method="POST" id='create_form' novalidate
            data-success-msg="{!! __('general.add_success_message') !!}" data-success-action="reload-table" data-table-id="#table_data">
            @csrf
            <div class="modal-content border-0">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-dark" id="createModalLabel">
                        <i class="la la-user-plus mr-1 text-primary" style="font-size: 22px;"></i>
                        {!! __('customers.add_customer') !!}
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
                            <div class="col-md-12 mb-1">
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

                        <!-- Name AR -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="name_ar_create">{!! __('customers.name_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none"
                                        id="name_ar_create" name="name[ar]" placeholder="{!! __('customers.name_ar') !!}"
                                        autocomplete="off">
                                    <i class="la la-user text-primary"></i>
                                </div>
                                <span class="error-text name_ar_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Name EN -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="name_en_create">{!! __('customers.name_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none"
                                        id="name_en_create" name="name[en]" placeholder="{!! __('customers.name_en') !!}"
                                        autocomplete="off">
                                    <i class="la la-user text-primary"></i>
                                </div>
                                <span class="error-text name_en_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="phone_create">{!! __('customers.phone') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none text-left"
                                        id="phone_create" name="phone" placeholder="{!! __('customers.phone') !!}"
                                        dir="ltr" autocomplete="off">
                                    <i class="la la-phone text-primary"></i>
                                </div>
                                <span class="error-text phone_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="email_create">{!! __('customers.email') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="email" class="form-control premium-input shadow-none text-left"
                                        id="email_create" name="email" placeholder="{!! __('customers.email') !!}"
                                        dir="ltr" autocomplete="off">
                                    <i class="la la-at text-primary"></i>
                                </div>
                                <span class="error-text email_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- ID Number -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="id_number_create">{!! __('customers.id_number') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none"
                                        id="id_number_create" name="id_number" placeholder="{!! __('customers.id_number') !!}"
                                        autocomplete="off">
                                    <i class="la la-credit-card text-primary"></i>
                                </div>
                                <span class="error-text id_number_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Nationality -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="nationality_create">{!! __('customers.nationality') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none"
                                        id="nationality_create" name="nationality"
                                        placeholder="{!! __('customers.nationality') !!}" autocomplete="off">
                                    <i class="la la-flag text-primary"></i>
                                </div>
                                <span class="error-text nationality_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Tenant Type -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="tenant_type_create">{!! __('customers.tenant_type') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none" id="tenant_type_create"
                                        name="tenant_type">
                                        <option value="individual">{!! __('customers.individual') !!}</option>
                                        <option value="company">{!! __('customers.company') !!}</option>
                                    </select>
                                    <i class="la la-tags text-primary"></i>
                                </div>
                                <span class="error-text tenant_type_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Guarantor -->
                        <div class="col-md-4 mb-1">
                            <div class="premium-form-group">
                                <label for="guarantor_id_create">{!! __('customers.guarantor') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper no-icon">
                                    <select class="form-control premium-input shadow-none select2-autocomplete"
                                        id='guarantor_id_create' name="guarantor_id"
                                        data-placeholder="{!! __('general.select_from_list') !!}"
                                        data-url="{!! route('dashboard.guarantors.autocomplete') !!}"
                                        data-simple="true"
                                        required>
                                        <option value=""></option>
                                    </select>
                                </div>    <span class="error-text guarantor_id_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-md-12 mb-1">
                            <div class="premium-form-group">
                                <label for="address_create">{!! __('customers.address') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none"
                                        id="address_create" name="address" placeholder="{!! __('customers.address') !!}"
                                        autocomplete="off">
                                    <i class="la la-map-marker text-primary"></i>
                                </div>
                                <span class="error-text address_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="col-md-12 mb-1">
                            <div class="premium-form-group">
                                <label for="notes_create">{!! __('customers.notes') !!}</label>
                                <div class="premium-input-wrapper no-icon">
                                    <textarea class="form-control premium-input shadow-none" id="notes_create" name="notes" rows="1"
                                        placeholder="{!! __('customers.notes') !!}"></textarea>
                                </div>
                                <span class="error-text notes_error text-danger small"></span>
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
