<div class="modal modal-pop" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="{!! route('dashboard.guarantors.store') !!}" method="POST" id='create_form' novalidate
            data-success-msg="{!! __('general.add_success_message') !!}" data-success-action="reload-table" data-table-id="#table_data">
            @csrf
            <div class="modal-content border-0">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center" id="createModalLabel">
                        <i class="fas fa-user-plus text-primary mr-2 icon-size-18"></i> {!! __('guarantors.add_guarantor') !!}
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
                            <div class="col-md-12 mb-1">
                                <div class="premium-form-group" id="company_id_create_group">
                                    <label class="font-weight-bold">{!! __('companies.company') !!} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control premium-input shadow-none select2" id='company_id_create'
                                        name="company_id">
                                        <option value="">{!! __('general.select_from_list') !!}</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text company_id_error"></span>
                                </div>
                            </div>
                        @endif

                        <!-- Name AR -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label class="font-weight-bold">{!! __('guarantors.name') !!} ({!! __('general.ar') !!}) <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none"
                                    id="name_ar_create" name="name[ar]"
                                    placeholder="{!! __('guarantors.name') !!} ({!! __('general.ar') !!})"
                                    autocomplete="off">
                                <span class="text-danger error-text name_ar_error"></span>
                            </div>
                        </div>

                        <!-- Name EN -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label class="font-weight-bold">{!! __('guarantors.name') !!} ({!! __('general.en') !!}) <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none"
                                    id="name_en_create" name="name[en]"
                                    placeholder="{!! __('guarantors.name') !!} ({!! __('general.en') !!})"
                                    autocomplete="off">
                                <span class="text-danger error-text name_en_error"></span>
                            </div>
                        </div>

                        <!-- ID Number -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label class="font-weight-bold">{!! __('guarantors.id_number') !!} <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none"
                                    id="id_number_create" name="id_number" placeholder="{!! __('guarantors.id_number') !!}"
                                    autocomplete="off">
                                <span class="text-danger error-text id_number_error"></span>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6 mb-1">
                            <div class="premium-form-group">
                                <label class="font-weight-bold">{!! __('guarantors.phone') !!} <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none text-left"
                                    id="phone_create" name="phone" placeholder="{!! __('guarantors.phone') !!}"
                                    dir="ltr" autocomplete="off">
                                <span class="text-danger error-text phone_error"></span>
                            </div>
                        </div>




                        <!-- Address -->
                        <div class="col-md-12 mb-1">
                            <div class="premium-form-group">
                                <label class="font-weight-bold">{!! __('guarantors.address') !!}</label>
                                <input type="text" class="form-control premium-input shadow-none"
                                    id="address_create" name="address" placeholder="{!! __('guarantors.address') !!}"
                                    autocomplete="off">
                                <span class="text-danger error-text address_error"></span>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="col-md-12 mb-1">
                            <div class="premium-form-group">
                                <label class="font-weight-bold">{!! __('guarantors.notes') !!}</label>
                                <textarea class="form-control premium-input shadow-none" id="notes_create" name="notes" rows="4"
                                    placeholder="{!! __('guarantors.notes') !!}"></textarea>
                                <span class="text-danger error-text notes_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <div class="modal-footer border-0 pt-0">
                    <button type="submit" id="saveBtn"
                        class="btn btn-premium-save shadow-pulse px-4 font-weight-bold h-42 radius-10">
                        <i class="fas fa-save"></i> {{ __('general.save') }}
                        <i class="fas fa-sync fa-spin spinner_loading d-none ml-1"></i>
                    </button>

                    <button type="button" class="btn btn-premium-secondary px-4 font-weight-bold h-42 radius-10"
                        data-dismiss="modal">
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

        });
    </script>
@endpush


