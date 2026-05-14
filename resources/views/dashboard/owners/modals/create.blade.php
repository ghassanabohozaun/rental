<div class="modal modal-pop" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="{!! route('dashboard.owners.store') !!}" method="POST"
            id='create_form' novalidate
            data-success-msg="{!! __('general.add_success_message') !!}"
            data-success-action="reload-table"
            data-table-id="#table_data">
            @csrf
            <div class="modal-content border-0">

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
                <div class="modal-body my-2">
                    <div class="row">
                        <!-- Company -->
                        @if(user()->company_id == 1)
                            <div class="col-md-12 mb-1">
                                <div class="premium-form-group">
                                    <label for="company_id_create">{!! __('companies.company') !!} <span class="text-danger">*</span></label>
                                    <div class="premium-input-wrapper">
                                        <select class="form-control premium-input shadow-none select2" id='company_id_create' name="company_id">
                                            <option value="" selected>{!! __('general.select_from_list') !!}</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                        <i class="fas fa-building text-primary"></i>
                                    </div>
                                    <span class="text-danger error-text company_id_error"></span>
                                </div>
                            </div>
                        @endif

                        <!-- Name AR -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="name_ar_create">{!! __('owners.name') !!} ({!! __('general.ar') !!}) <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="name_ar_create"
                                    name="name[ar]" placeholder="{!! __('owners.name') !!} ({!! __('general.ar') !!})" autocomplete="off">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <span class="text-danger error-text name_ar_error"></span>
                            </div>
                        </div>

                        <!-- Name EN -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="name_en_create">{!! __('owners.name') !!} ({!! __('general.en') !!}) <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="name_en_create"
                                    name="name[en]" placeholder="{!! __('owners.name') !!} ({!! __('general.en') !!})" autocomplete="off">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <span class="text-danger error-text name_en_error"></span>
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="type_create">{!! __('owners.type') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none select2" id="type_create" name="type">
                                        <option value="" selected>{!! __('general.select_from_list') !!}</option>
                                        @foreach(__('owners.owner_types') as $key => $value)
                                            <option value="{!! $key !!}">{!! $value !!}</option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-tags text-primary"></i>
                                </div>
                                <span class="text-danger error-text type_error"></span>
                            </div>
                        </div>

                        <!-- Identification Number -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="identification_number_create">{!! __('owners.identification_number') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="identification_number_create"
                                    name="identification_number" placeholder="{!! __('owners.identification_number') !!}" autocomplete="off">
                                    <i class="fas fa-id-card text-primary"></i>
                                </div>
                                <span class="text-danger error-text identification_number_error"></span>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-12 mb-1">
                            <div class="premium-form-group">
                                <label for="phone_create">{!! __('owners.phone') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none text-left" id="phone_create"
                                    name="phone" placeholder="{!! __('owners.phone') !!}" dir="ltr" autocomplete="off">
                                    <i class="fas fa-phone text-primary"></i>
                                </div>
                                <span class="text-danger error-text phone_error"></span>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="email_create">{!! __('owners.email') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="email" class="form-control premium-input shadow-none" id="email_create"
                                    name="email" placeholder="{!! __('owners.email') !!}" autocomplete="off">
                                    <i class="fas fa-envelope text-primary"></i>
                                </div>
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label for="address_create">{!! __('owners.address') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="address_create"
                                    name="address" placeholder="{!! __('owners.address') !!}" autocomplete="off">
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                </div>
                                <span class="text-danger error-text address_error"></span>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="col-md-12 mb-1">
                            <div class="premium-form-group">
                                <label for="notes_create">{!! __('owners.notes') !!}</label>
                                <div class="premium-input-wrapper">
                                    <textarea class="form-control premium-input shadow-none" id="notes_create" name="notes" rows="4" placeholder="{!! __('owners.notes') !!}"></textarea>
                                    <i class="fas fa-info-circle text-primary"></i>
                                </div>
                                <span class="text-danger error-text notes_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <div class="modal-footer border-0 pt-0">
                    <button type="submit" id="saveBtn" class="btn btn-premium-save shadow-pulse px-4 font-weight-bold h-42 radius-10" style="min-width: 120px;">
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


