<div class="modal fade text-left" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content premium-modal">
            <div class="modal-header bg-premium-blue text-white">
                <h5 class="modal-title" id="showModalLabel">
                    <i class="la la-user-shield"></i> {{ __('guarantors.guarantor_details') }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body p-0">
                <div class="table-responsive">
                    <table class="table premium-table mb-0">
                        <tbody>
                            @if(user()->company_id == 1)
                            <tr>
                                <th class="bg-light" style="width: 30%;">{{ __('companies.company') }}</th>
                                <td id="show_company"></td>
                            </tr>
                            @endif
                            <tr>
                                <th class="bg-light" style="width: 30%;">{{ __('guarantors.name') }}</th>
                                <td id="show_name" class="font-weight-bold"></td>
                            </tr>
                            <tr>
                                <th class="bg-light">{{ __('guarantors.phone') }}</th>
                                <td id="show_phone"></td>
                            </tr>
                            <tr>
                                <th class="bg-light">{{ __('guarantors.id_number') }}</th>
                                <td id="show_id_number"></td>
                            </tr>
                            <tr>
                                <th class="bg-light">{{ __('guarantors.relationship') }}</th>
                                <td id="show_relationship"></td>
                            </tr>
                            <tr>
                                <th class="bg-light">{{ __('guarantors.address') }}</th>
                                <td id="show_address"></td>
                            </tr>
                            <tr>
                                <th class="bg-light">{{ __('guarantors.notes') }}</th>
                                <td id="show_notes"></td>
                            </tr>
                            <tr>
                                <th class="bg-light">{{ __('guarantors.created_by') }}</th>
                                <td id="show_creator"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer bg-light border-top-0">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                    <i class="la la-times"></i> {{ __('general.close') }}
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Handle show button click
        $(document).on('click', '.js-show-btn', function() {
            var name = $(this).data('name');
            var phone = $(this).data('phone') || '<span class="text-muted">-</span>';
            var id_number = $(this).data('id_number') || '<span class="text-muted">-</span>';
            var address = $(this).data('address') || '<span class="text-muted">-</span>';
            var relationship = $(this).data('relationship') || '<span class="text-muted">-</span>';
            var notes = $(this).data('notes') || '<span class="text-muted">-</span>';
            var creator = $(this).data('creator');

            $('#show_name').html(name);
            $('#show_phone').html(phone !== '<span class="text-muted">-</span>' ? '<span class="badge badge-light-primary"><i class="la la-phone"></i> ' + phone + '</span>' : phone);
            $('#show_id_number').html(id_number);
            $('#show_address').html(address);
            $('#show_relationship').html(relationship);
            $('#show_notes').html(notes);
            $('#show_creator').html('<span class="badge badge-light-info"><i class="la la-user"></i> ' + creator + '</span>');
            
            @if(user()->company_id == 1)
                var company = $(this).data('company') || '<span class="badge badge-light-secondary">{{ __('general.all_companies') }}</span>';
                if ($(this).data('company')) {
                    company = '<span class="badge badge-light-info">' + company + '</span>';
                }
                $('#show_company').html(company);
            @endif
        });
    });
</script>
@endpush
