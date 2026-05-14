@extends('layouts.dashboard.app')

@section('title')
    {!! $title !!}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/contract-show.css') }}">
@endpush

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <!-- Content Header -->
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
                                <a href="{!! route('dashboard.contracts.index') !!}">
                                    {!! __('contracts.contracts') !!}
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
                        <a href="{!! route('dashboard.contracts.index') !!}" class="btn-premium-back mr-1">
                            <i class="fas fa-arrow-right"></i> {!! __('general.back') !!}
                        </a>
                        @can('contracts_update')
                            <a href="{!! route('dashboard.contracts.edit', $contract->id) !!}" class="btn-premium-edit">
                                <i class="fas fa-edit"></i> {!! __('general.edit') !!}
                            </a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="content-body">
                @php
                    $statusColor = '#28d094'; // success
                    $statusIcon = 'fa-check-circle';
                    if ($contract->status == 'ended') {
                        $statusColor = '#ff9f43'; // warning
                        $statusIcon = 'fa-clock';
                    }
                    if ($contract->status == 'cancelled') {
                        $statusColor = '#ea5455'; // danger
                        $statusIcon = 'fa-times-circle';
                    }
                @endphp
                @include('dashboard.contracts.show._header')

                <div class="row">
                    <!-- Main Content (8 Columns) -->
                    <div class="col-lg-8 col-md-12">

                        @if ($contract->remaining_amount <= 0)
                            <div class="alert alert-premium-success border-0 shadow-sm mb-4 d-flex align-items-center justify-content-between p-2 animate__animated animate__pulse"
                                style="border-radius: 20px; background: linear-gradient(135deg, #28d094 0%, #13855c 100%); color: white;">
                                <div class="d-flex align-items-center ml-3">
                                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mr-3 shadow-lg"
                                        style="width: 55px; height: 55px;">
                                        <i class="fas fa-check-double text-success font-large-1"></i>
                                    </div>
                                    <div class="text-white">
                                        <h4 class="font-weight-bolder mb-1 text-white" style="letter-spacing: 0.5px;">
                                            {!! __('payments.contract_fully_paid') !!}</h4>
                                        <p class="mb-0 opacity-80" style="font-size: 15px;">{!! __('payments.no_further_payments_required') !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Master Tabs Navigation -->
                        <div class="d-flex justify-content-start w-100 mb-2">
                            <ul class="nav premium-nav-tabs" id="contractTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="contract-tab" data-toggle="tab" href="#contract" role="tab">
                                        <i class="fas fa-info-circle"></i> {!! __('contracts.contract_details') !!}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="payments-tab" data-toggle="tab" href="#payments" role="tab">
                                        <i class="fas fa-money-bill-wave"></i> {!! __('payments.payments') !!}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="cheques-tab" data-toggle="tab" href="#cheques" role="tab">
                                        <i class="fas fa-money-check-alt"></i> {!! __('cheques.cheques') !!}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="terms-tab" data-toggle="tab" href="#terms" role="tab">
                                        <i class="fas fa-file-alt"></i> {!! __('contracts.contract_text') !!}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="property-tab" data-toggle="tab" href="#property" role="tab">
                                        <i class="fas fa-building"></i> {!! __('properties.property') !!}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="customer-tab" data-toggle="tab" href="#customer" role="tab">
                                        <i class="fas fa-user-tie"></i> {!! __('contracts.customer') !!}
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content mt-1" id="contractTabsContent">
                            @include('dashboard.contracts.show._details')
                            @include('dashboard.contracts.show._payments')
                            @include('dashboard.contracts.show._cheques')
                            @include('dashboard.contracts.show._terms')
                            @include('dashboard.contracts.show._property')
                            @include('dashboard.contracts.show._customer')
                        </div>
                    </div>

                    <!-- Sidebar Content (4 Columns) -->
                    <div class="col-lg-4 col-md-12">
                        @include('dashboard.contracts.show._sidebar')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
