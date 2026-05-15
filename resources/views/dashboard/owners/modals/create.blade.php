<div class="modal modal-pop" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="{!! route('dashboard.owners.store') !!}" method="POST"
            id='create_form' novalidate
            data-success-msg="{!! __('general.add_success_message') !!}"
            data-success-action="reload-table"
            data-table-id="#table_data">
            @csrf
            <div class="modal-content premium-modal-content">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center" id="createModalLabel">
                        <i class="fas fa-user-plus text-primary mr-2 icon-size-18"></i> {!! __('owners.add_owner') !!}
                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body mt-2 mb-0">
                    <div class="row">
                        <!-- Company -->
                        @if(user()->company_id == 1)
                            <div class="col-md-12 mb-1">
                                <div class="premium-form-group">
                                    <label class="premium-label" for="company_id_create">{!! __('companies.company') !!} <span class="text-danger">*</span></label>
                                    <select class="form-control premium-input shadow-none select2" id='company_id_create' name="company_id">
                                        <option value="" selected>{!! __('general.select_from_list') !!}</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text company_id_error"></span>
                                </div>
                            </div>
                        @endif

                        <!-- Name AR -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="name_ar_create">{!! __('owners.name') !!} ({!! __('general.ar') !!}) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none" id="name_ar_create"
                                    name="name[ar]" placeholder="{!! __('owners.name') !!} ({!! __('general.ar') !!})" autocomplete="off">
                                <span class="text-danger error-text name_ar_error"></span>
                            </div>
                        </div>

                        <!-- Name EN -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="name_en_create">{!! __('owners.name') !!} ({!! __('general.en') !!}) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none" id="name_en_create"
                                    name="name[en]" placeholder="{!! __('owners.name') !!} ({!! __('general.en') !!})" autocomplete="off">
                                <span class="text-danger error-text name_en_error"></span>
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="type_create">{!! __('owners.type') !!} <span class="text-danger">*</span></label>
                                <select class="form-control premium-input shadow-none select2" id="type_create" name="type">
                                    <option value="" selected>{!! __('general.select_from_list') !!}</option>
                                    @foreach(__('owners.owner_types') as $key => $value)
                                        <option value="{!! $key !!}">{!! $value !!}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text type_error"></span>
                            </div>
                        </div>

                        <!-- Identification Number -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="identification_number_create">{!! __('owners.identification_number') !!} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none" id="identification_number_create"
                                    name="identification_number" placeholder="{!! __('owners.identification_number') !!}" autocomplete="off">
                                <span class="text-danger error-text identification_number_error"></span>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-12 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="phone_create">{!! __('owners.phone') !!}</label>
                                <input type="text" class="form-control premium-input shadow-none text-left" id="phone_create"
                                    name="phone" placeholder="{!! __('owners.phone') !!}" dir="ltr" autocomplete="off">
                                <span class="text-danger error-text phone_error"></span>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="email_create">{!! __('owners.email') !!}</label>
                                <input type="email" class="form-control premium-input shadow-none" id="email_create"
                                    name="email" placeholder="{!! __('owners.email') !!}" autocomplete="off">
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="address_create">{!! __('owners.address') !!}</label>
                                <input type="text" class="form-control premium-input shadow-none" id="address_create"
                                    name="address" placeholder="{!! __('owners.address') !!}" autocomplete="off">
                                <span class="text-danger error-text address_error"></span>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="col-md-12 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="notes_create">{!! __('owners.notes') !!}</label>
                                <textarea class="form-control premium-input shadow-none" id="notes_create" name="notes" rows="4" placeholder="{!! __('owners.notes') !!}"></textarea>
                                <span class="text-danger error-text notes_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <div class="modal-footer border-0 pt-0 premium-modal-footer">
                    <button type="submit" id="saveBtn" class="btn btn-premium-save font-weight-bold">
                        <i class="fas fa-save mr-2"></i>
                        <i class="fas fa-spinner fa-spin d-none spinner_loading mr-2"></i>
                        {{ __('general.save') }}
                    </button>

                    <button type="button" class="btn btn-premium-secondary font-weight-bold"
                        data-dismiss="modal">
                        <i class="fas fa-times-circle mr-2"></i> {{ __('general.cancel') }}
                    </button>
                </div>
                <!--end::modal footer-->

            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        if ($('#company_id_create').length) {
            $('#company_id_create').select2({
                dropdownParent: $('#createModal'),
                width: '100%',
                dir: $('html').attr('data-textdirection') || 'ltr'
            });
        }
        if ($('#type_create').length) {
            $('#type_create').select2({
                dropdownParent: $('#createModal'),
                width: '100%',
                dir: $('html').attr('data-textdirection') || 'ltr'
            });
        }
        // Clear state on input
        $(document).on('input change', '#create_form .premium-input, #create_form select', function() {
            const $wrapper = $(this).closest('.premium-input-wrapper');
            if ($wrapper.hasClass('is-invalid-premium')) {
                $wrapper.removeClass('is-invalid-premium');
                // Handle Select2
                if ($(this).hasClass('select2-hidden-accessible')) {
                    $(this).next('.select2-container').find('.select2-selection').removeClass('is-invalid-premium');
                }
            }
        });
    });
</script>
@endpush


