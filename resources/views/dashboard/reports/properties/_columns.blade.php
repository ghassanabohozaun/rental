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
                <div class="custom-control custom-switch custom-switch-info" style="margin-left: 15px; margin-right: 15px;">
                    <input type="checkbox" class="custom-control-input" id="check_all_columns">
                    <label class="custom-control-label font-weight-bold cursor-pointer text-nowrap px-3" for="check_all_columns" style="white-space: nowrap;">
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
                                    id="column_{{ $column }}" class="column-checkbox">
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
        });
    </script>
@endpush
