@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/vendors/css/forms/selects/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/reports.css') }}">
@endpush

@section('content')
    <div class="app-content content">

        <form class="form" action="{!! route('dashboard.reports.properties.export.excel') !!}" method="post" enctype="multipart/form-data"
            id="exportPropertiesForm">
            @csrf
            <div class="content-wrapper">
                <!-- begin: content header -->
                <div class="content-header row align-items-center mb-2">
                    <!-- begin: content header left-->
                <div class="content-header-left col-md-6 col-12 mb-2 mb-md-0">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb premium-breadcrumb shadow-sm">
                                <li class="breadcrumb-item">
                                    <a href="{!! route('dashboard.index') !!}">
                                        <i class="fas fa-home"></i> {!! __('dashboard.home') !!}
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{!! route('dashboard.properties.index') !!}">
                                        {!! __('properties.properties') !!}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active font-weight-bold">
                                    {!! __('reports.properties_reports') !!}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end: content header left-->

                <!-- begin: content header right-->
                <div class="content-header-right col-md-6 col-12">
                    <div class="float-md-right mb-1 d-flex gap-2">
                        <a href="" class="btn btn-outline-danger shadow-sm font-weight-bold" id="properties_reset_btn" style="border-radius: 6px; padding: 8px 16px;">
                            <i class="fas fa-sync-alt"></i> {!! __('reports.reset') !!}
                        </a>

                        <button class="btn btn-success shadow-pulse font-weight-bold" type="submit" style="border-radius: 6px; padding: 8px 16px;">
                            <i class="fas fa-file-excel"></i> {!! __('reports.export_excel') !!}
                        </button>
                    </div>
                </div>
                <!-- end: content header right-->


                </div> <!-- end :content header -->

                <!-- begin: content body -->
                <div class="content-body">

                    <section id="basic-form-layouts">
                        <div class="row match-height">
                            <div class="col-md-12">

                                @include('dashboard.reports.properties._search-report')

                                @include('dashboard.reports.properties._columns')

                            </div> <!-- end: card  -->
                        </div><!-- end: row  -->
                    </section><!-- end: sections  -->
                </div><!-- end: content body  -->
            </div> <!-- end: content wrapper  -->
        </form>
    </div><!-- end: content app  -->
@endsection

@push('scripts')
    <script src="{{ asset('assets/dashbaord/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{!! asset('assets/dashbaord/js/filter-system.js') !!}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize Select2 for normal selects
            $('select:not([multiple])').select2({
                width: '100%',
                placeholder: "{!! __('general.select') !!}"
            });

            // Initialize Multi-select with Tags style for owners
            var $ownerSelect = $('#owner_id');
            $ownerSelect.select2({
                width: '100%',
                placeholder: "{!! __('reports.all_owners') !!}",
                allowClear: true,
                closeOnSelect: false,
                scrollAfterSelect: false,
                dir: $('html').attr('data-textdirection') == 'rtl' ? 'rtl' : 'ltr',
                language: {
                    noResults: function() {
                        return "{!! __('general.noResults2') !!}";
                    }
                }
            });

            // Handle the closeOnSelect: false bug in some versions
            $ownerSelect.on('select2:select', function(e) {
                // This helps ensure it stays open in all environments
                if (e.params.originalEvent) {
                    e.params.originalEvent.stopPropagation();
                }
            });

            // Select All Owners
            $('#select_all_owners').on('click', function() {
                $('#owner_id option').prop('selected', true);
                $('#owner_id').trigger('change');
            });

            // Deselect All Owners
            $('#deselect_all_owners').on('click', function() {
                $('#owner_id').val(null).trigger('change');
            });

            // Reset button
            $('#properties_reset_btn').on('click', function(e) {
                e.preventDefault();
                var $form = $('#exportPropertiesForm');
                $form[0].reset();

                // Properly reset all Select2 elements
                $form.find('select').val(null).trigger('change');

                // Clear all checkboxes/switches
                $form.find('input[type="checkbox"]').prop('checked', false);
            });
        });
    </script>
@endpush
