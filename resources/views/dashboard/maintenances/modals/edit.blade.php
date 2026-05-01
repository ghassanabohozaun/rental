<div class="modal modal-pop fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="" method="POST"
            id='edit_form' novalidate
            data-success-msg="{!! __('general.update_success_message') !!}"
            data-success-action="reload-table"
            data-table-id="#table_data">
            @csrf
            @method('PUT')
            <div class="modal-content border-0">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-dark" id="editModalLabel">
                        <i class="la la-edit mr-1 text-primary" style="font-size: 22px;"></i> {!! __('maintenances.edit_maintenance') !!}
                    </h5>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="la la-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body my-2">
                    <input type="hidden" name="id" id="edit_id">

                    <div class="row">
                        <!-- Company -->
                        @if(user()->company_id == 1)
                            <div class="col-md-12 mb-3">
                                <div class="premium-form-group">
                                    <label for="edit_company_id">{!! __('companies.company') !!} <span class="text-danger">*</span></label>
                                    <div class="premium-input-wrapper">
                                        <select class="form-control premium-input shadow-none js-select2 js-autocomplete" id='edit_company_id' name="company_id"
                                            data-url="{!! route('dashboard.companies.autocomplete') !!}"
                                            data-placeholder="{!! __('general.select_company') !!}"
                                            data-parent="#editModal">
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
                                <label for="edit_property_id">{!! __('maintenances.property') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none js-select2 js-autocomplete" id="edit_property_id" name="property_id"
                                        data-url="{!! route('dashboard.properties.autocomplete') !!}"
                                        data-simple="true"
                                        data-placeholder="{!! __('general.select_from_list') !!}" data-parent="#editModal">
                                        <option value="" disabled></option>
                                    </select>
                                    <i class="la la-building text-primary"></i>
                                </div>
                                <span class="error-text property_id_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <div class="premium-form-group">
                                <label for="edit_status">{!! __('maintenances.status') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none js-select2" id="edit_status" name="status" data-parent="#editModal">
                                        <option value="pending">{!! __('maintenances.pending') !!}</option>
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
                                <label for="edit_date">{!! __('maintenances.date') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none text-left ptc-datepicker" id="edit_date"
                                    name="date" placeholder="{!! __('maintenances.date') !!}" autocomplete="off">
                                    <i class="la la-calendar text-primary"></i>
                                </div>
                                <span class="error-text date_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Cost -->
                        <div class="col-md-6 mb-3">
                            <div class="premium-form-group">
                                <label for="edit_cost">{!! __('maintenances.cost') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="number" step="0.01" class="form-control premium-input shadow-none" id="edit_cost"
                                    name="cost" placeholder="{!! __('maintenances.cost') !!}" autocomplete="off">
                                    <i class="la la-money text-primary"></i>
                                </div>
                                <span class="error-text cost_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Description AR -->
                        <div class="col-md-6 mb-3">
                            <div class="premium-form-group">
                                <label for="edit_description_ar">{!! __('maintenances.description') !!} ({!! __('general.ar') !!})</label>
                                <div class="premium-input-wrapper no-icon">
                                    <textarea class="form-control premium-input shadow-none" id="edit_description_ar" name="description_ar" rows="4" placeholder="{!! __('maintenances.description') !!} ({!! __('general.ar') !!})"></textarea>
                                </div>
                                <span class="error-text description_ar_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Description EN -->
                        <div class="col-md-6 mb-3">
                            <div class="premium-form-group">
                                <label for="edit_description_en">{!! __('maintenances.description') !!} ({!! __('general.en') !!})</label>
                                <div class="premium-input-wrapper no-icon">
                                    <textarea class="form-control premium-input shadow-none" id="edit_description_en" name="description_en" rows="4" placeholder="{!! __('maintenances.description') !!} ({!! __('general.en') !!})"></textarea>
                                </div>
                                <span class="error-text description_en_error text-danger small"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <div class="modal-footer border-0 pt-0">
                    <button type="submit" id="editSaveBtn" class="btn btn-premium-add px-4 font-weight-bold h-42 radius-10">
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

@push('scripts')
<script>
    $(document).ready(function() {
        // Handle edit button click
        $(document).on('click', '.js-edit-btn', function() {
            var id = $(this).data('id');
            var description_ar = $(this).data('description_ar');
            var description_en = $(this).data('description_en');
            var property_id = $(this).data('property_id');
            var date = $(this).data('date');
            var cost = $(this).data('cost');
            var status = $(this).data('status');
            var url = $(this).data('url');

            // Populate inputs
            $('#edit_id').val(id);
            $('#edit_description_ar').val(description_ar);
            $('#edit_description_en').val(description_en);
            $('#edit_date').val(date);
            $('#edit_cost').val(cost);
            
            // Set Select2 values
            var property_name = $(this).data('property_name');
            var select_property = $('#edit_property_id');
            select_property.empty();
            if (property_id) {
                var option = new Option(property_name, property_id, true, true);
                select_property.append(option).trigger('change');
            } else {
                select_property.trigger('change');
            }

            $('#edit_status').val(status).trigger('change');
            // Set form action
            $('#edit_form').attr('action', url);

            // Handle Company Select2 for Super Admin
            @if(user()->company_id == 1)
                var company_id = $(this).data('company_id');
                var company_name = $(this).data('company');
                var select = $('#edit_company_id');
                select.empty();
                if (company_id) {
                    var option = new Option(company_name, company_id, true, true);
                    select.append(option).trigger('change');
                } else {
                    select.trigger('change');
                }
            @endif
        });
    });
</script>
@endpush
