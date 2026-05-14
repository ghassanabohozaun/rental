@extends('layouts.dashboard.app')

@section('title')
    {!! $title !!}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/contract-show.css') }}">
    
@endpush

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row mb-2">
            <div class="col-md-6 col-12">
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb premium-breadcrumb">
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
                            {!! __('general.details') !!}
                        </li>
                    </ol>
                </div>
            </div>
            <div class="col-md-6 col-12 text-md-right">
                <div class="d-flex align-items-center justify-content-end">
                    <a href="{!! route('dashboard.properties.index') !!}" class="btn-premium-back mr-1">
                        <i class="fas fa-arrow-right"></i> {!! __('general.back') !!}
                    </a>
                    @can('properties_update')
                    <a href="{!! route('dashboard.properties.edit', $property->id) !!}" class="btn-premium-edit">
                        <i class="fas fa-edit"></i> {!! __('general.edit') !!}
                    </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="content-body">
            @include('dashboard.properties.show._header')
            
                <div class="row">
                    <!-- Tab Content Cards (8) -->
                    <div class="col-lg-8 col-md-12">
                        @include('dashboard.properties.show._tabs')
                        <div class="tab-content mt-1">
                            @include('dashboard.properties.show._details')
                            @include('dashboard.properties.show._owners')
                            @include('dashboard.properties.show._contracts')
                            @include('dashboard.properties.show._maintenances')
                            @if($property->units->count() > 0)
                                @include('dashboard.properties.show._units')
                            @endif
                        </div>
                    </div>

                <!-- Sidebar Stats (4) - Aligned with Cards -->
                <div class="col-lg-4 col-md-12">
                    @include('dashboard.properties.show._sidebar')
                </div>
            </div>
        </div>
    </div>
</div>

@include('dashboard.properties.show._modals')

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        console.log("Property Scripts loaded");
        
        // Handle showing payments for contracts in the property contracts tab
        $('.btn-show-payments').on('click', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            
            // Set dynamic URL for the header "Add" button
            let createUrl = "{{ route('dashboard.payments.create') }}?contract_id=" + id;
            $('#modalAddPaymentBtn').attr('href', createUrl);

            $('#paymentsModalBody').html('<div class="text-center p-3"><i class="fas fa-spinner fa-spin fa-2x"></i></div>');
            $('#paymentsModal').modal('show');
            
            let url = "{{ url(app()->getLocale() . '/dashboard/contracts') }}/" + id + "/payments";
            $.get(url, function(data) {
                $('#paymentsModalBody').html(data);
                // Ensure the tab-pane is visible
                $('#paymentsModalBody').find('.tab-pane').addClass('show active').removeClass('fade');
            });
        });

        $('.btn-show-cheques').on('click', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

            // Set dynamic URL for the header "Add" button
            let createUrl = "{{ route('dashboard.cheques.create') }}?contract_id=" + id + "&is_deposit=0";
            $('#modalAddChequeBtn').attr('href', createUrl);

            $('#chequesModalBody').html('<div class="text-center p-3"><i class="fas fa-spinner fa-spin fa-2x"></i></div>');
            $('#chequesModal').modal('show');
            
            let url = "{{ url(app()->getLocale() . '/dashboard/contracts') }}/" + id + "/cheques";
            $.get(url, function(data) {
                $('#chequesModalBody').html(data);
                // Ensure the tab-pane is visible
                $('#chequesModalBody').find('.tab-pane').addClass('show active').removeClass('fade');
            });
        });
    });
</script>
@endpush


