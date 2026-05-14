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
                                <a href="{!! route('dashboard.customers.index') !!}">
                                    {!! __('customers.customers') !!}
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
                        <a href="{!! route('dashboard.customers.index') !!}" class="btn-premium-back mr-1">
                            <i class="fas fa-arrow-right"></i> {!! __('general.back') !!}
                        </a>
                        @can('customers_update')
                            <a href="{{ route('dashboard.customers.edit', $customer->id) }}" class="btn-premium-edit">
                                <i class="fas fa-edit"></i> {!! __('general.edit') !!}
                            </a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="content-body">
                @include('dashboard.customers.show._header')
                
                <div class="row">
                    <!-- Main Content (8) -->
                    <div class="col-lg-8 col-md-12">
                        @include('dashboard.customers.show._tabs')
                        <div class="tab-content mt-1">
                            @include('dashboard.customers.show._details')
                            @include('dashboard.customers.show._contracts')
                            @include('dashboard.customers.show._guarantors')
                        </div>
                    </div>

                    <!-- Sidebar (4) -->
                    <div class="col-lg-4 col-md-12">
                        @include('dashboard.customers.show._sidebar')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.customers.show._modals')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            console.log("Scripts loaded");
            const paymentSkeleton = $('#paymentsModalBody').html();
            const chequeSkeleton = $('#chequesModalBody').html();

            $('.btn-show-payments').on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $('#paymentsModalBody').html(paymentSkeleton);

                // Set dynamic URL for the header "Add" button
                let createUrl = "{{ route('dashboard.payments.create') }}?contract_id=" + id;
                $('#modalAddPaymentBtn').attr('href', createUrl);

                $('#paymentsModal').modal('show');

                let url = "{{ url(app()->getLocale() . '/dashboard/contracts') }}/" + id + "/payments";
                $.get(url, function(data) {
                    $('#paymentsModalBody').html(data);
                    $('#paymentsModalBody').find('.tab-pane').addClass('show active').removeClass(
                        'fade');
                }).fail(function() {
                    $('#paymentsModalBody').html(
                        '<div class="alert alert-danger m-2">Error loading data</div>');
                });
            });

            $('.btn-show-cheques').on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $('#chequesModalBody').html(chequeSkeleton);

                // Set dynamic URL for the header "Add" button
                let createUrl = "{{ route('dashboard.cheques.create') }}?contract_id=" + id +
                    "&is_deposit=0";
                $('#modalAddChequeBtn').attr('href', createUrl);

                $('#chequesModal').modal('show');

                let url = "{{ url(app()->getLocale() . '/dashboard/contracts') }}/" + id + "/cheques";
                $.get(url, function(data) {
                    $('#chequesModalBody').html(data);
                    $('#chequesModalBody').find('.tab-pane').addClass('show active').removeClass(
                        'fade');
                }).fail(function() {
                    $('#chequesModalBody').html(
                        '<div class="alert alert-danger m-2">Error loading data</div>');
                });
            });
        });
    </script>
@endpush
