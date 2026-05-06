<div class="modal modal-pop fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="{!! route('dashboard.customers.store') !!}" method="POST" id='create_form' novalidate
            data-success-msg="{!! __('general.add_success_message') !!}" data-success-action="reload-table" data-table-id="#table_data">
            @csrf
            <div class="modal-content border-0">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center" id="createModalLabel">
                        <i class="fas fa-user-plus text-primary mr-2 icon-size-18"></i>
                        {!! __('customers.add_customer') !!}
                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body my-2">
                    <div class="row">
                        @include('dashboard.customers.modals.parts._personal_info', ['mode' => 'create'])
                        @include('dashboard.customers.modals.parts._contact_info', ['mode' => 'create'])
                        @include('dashboard.customers.modals.parts._address_notes', ['mode' => 'create'])
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
