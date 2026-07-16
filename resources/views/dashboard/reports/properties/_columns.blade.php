<div class="card premium-card mt-2">
    <div class="premium-mandatory-header py-2">
        <div class="title-wrapper">
            <i class="fas fa-columns text-info"></i>
            <span class="font-weight-bold">{!! __('reports.select_columns') !!}</span>
        </div>
        <div class="heading-elements">
            <ul class="list-inline mb-0 d-flex align-items-center">
                <li><a data-action="collapse"><i class="fas fa-minus"></i></a></li>
                <li><a data-action="expand"><i class="fas fa-expand"></i></a></li>
            </ul>
        </div>
    </div>

    <div class="card-content collapse show">
        <div class="card-body pt-2">

            <div class="d-flex justify-content-start mb-2">
                <div class="d-flex align-items-center" style="margin: 0 15px; gap: 10px;">
                    <label class="modern-switch mb-0">
                        <input type="checkbox" id="check_all_columns">
                        <span class="modern-slider"></span>
                    </label>
                    <label for="check_all_columns" class="font-weight-bold cursor-pointer mb-0" style="white-space: nowrap;">
                        {!! __('reports.select_all') !!}
                    </label>
                </div>
            </div>

            <!-- Property Columns -->
            <div class="row">
                <div class="col-md-12">
                    <h5 class="premium-section-title premium-section-title-blue">
                        <i class="la la-building"></i> {!! __('properties.properties') !!}
                    </h5>
                </div>
                @foreach ($propertyColumnNames as $column)
                    <div class="col-md-3 mb-2">
                        <div class="premium-switch-box shadow-sm">
                            <span class="premium-switch-label">
                                @if ($column == 'owner')
                                    {!! __('reports.owner') !!}
                                @else
                                    {!! __('properties.' . $column) !!}
                                @endif
                            </span>
                            <label class="modern-switch">
                                <input type="checkbox" name="columns[]" value="{{ $column }}"
                                    id="column_{{ $column }}" class="column-checkbox"
                                    @if(in_array($column, ['id', 'name', 'property_number', 'property_type_id', 'property_status_id', 'area', 'price', 'location', 'owner'])) checked @endif>
                                <span class="modern-slider"></span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            // Master switch for all columns
            $('#check_all_columns').on('change', function() {
                var isChecked = $(this).is(':checked');
                $('.column-checkbox').prop('checked', isChecked);
            });

            // If any single column is unchecked, uncheck the master switch
            $('.column-checkbox').on('change', function() {
                if (!$(this).is(':checked')) {
                    $('#check_all_columns').prop('checked', false);
                } else {
                    // Check if all are checked to check the master switch
                    if ($('.column-checkbox:checked').length === $('.column-checkbox').length) {
                        $('#check_all_columns').prop('checked', true);
                    }
                }
            });

            // Check the master switch initially if all defaults are checked
            if ($('.column-checkbox:checked').length === $('.column-checkbox').length) {
                $('#check_all_columns').prop('checked', true);
            }
        });
    </script>
@endpush
