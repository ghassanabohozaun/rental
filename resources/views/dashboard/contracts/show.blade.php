@extends('layouts.dashboard.app')

@section('title')
    {!! $title !!}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/contract-show.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/contracts-premium.css') }}">
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
                <!-- Header Premium Card -->
                @php
                    $isRtl = app()->getLocale() === 'ar';
                    $dir = $isRtl ? 'right' : 'left';
                    $flex = $isRtl ? 'flex-end' : 'flex-start';
                @endphp
                <div class="contract-header-premium">
                    <div class="header-bg-shape"></div>
                    <div class="premium-header-flex">
                        <div class="header-profile-box">
                            <div class="header-icon-wrapper shadow-lg text-primary mr-2">
                                <i class="fas fa-file-contract icon-size-36"></i>
                            </div>
                            <div>
                                <h1 class="text-white font-weight-bold mb-1 header-title-lg">
                                    {!! optional($contract->property)->name !!}
                                </h1>
                                <p class="text-white-50 mb-0 header-subtitle-md">
                                    <i class="fas fa-user-circle mr-2"></i>
                                    <span>{!! optional($contract->customer)->name !!}</span>
                                    <span class="mx-2">|</span>
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span>{!! $contract->duration_label !!}</span>
                                </p>
                            </div>
                        </div>
                        <div class="header-price-side text-center">
                            <div class="price-hero-box">
                                <div class="small text-white-50 text-uppercase letter-spacing-1">{!! __('contracts.rent_amount') !!}</div>
                                <h2 class="text-white font-weight-bold mb-0 price-hero-val">
                                    {!! number_format($contract->rent_amount, 2) !!}
                                </h2>
                            </div>
                            @php
                                $statusColor = 'primary';
                                $statusIcon = 'fa-check-circle';
                                if ($contract->status == 'ended') {
                                    $statusColor = 'warning';
                                    $statusIcon = 'fa-clock';
                                }
                                if ($contract->status == 'cancelled') {
                                    $statusColor = 'danger';
                                    $statusIcon = 'fa-times-circle';
                                }
                            @endphp
                            <div class="mt-2">
                                <span class="status-pill-premium badge-glass-{!! $statusColor !!} px-3 py-1" style="font-size: 14px; display: inline-flex; align-items: center;">
                                    <i class="fas {!! $statusIcon !!} mr-2"></i>
                                    {!! __('contracts.status_' . $contract->status) !!}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                @if($contract->remaining_amount <= 0)
                <div class="alert alert-premium-success border-0 shadow-sm mb-4 d-flex align-items-center justify-content-between p-2 animate__animated animate__pulse" style="border-radius: 20px; background: linear-gradient(135deg, #28d094 0%, #13855c 100%); color: white;">
                    <div class="d-flex align-items-center ml-3">
                        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mr-3 shadow-lg" style="width: 55px; height: 55px;">
                            <i class="fas fa-check-double text-success font-large-1"></i>
                        </div>
                        <div class="text-white">
                            <h4 class="font-weight-bolder mb-1 text-white" style="letter-spacing: 0.5px;">{!! __('payments.contract_fully_paid') !!}</h4>
                            <p class="mb-0 opacity-80" style="font-size: 15px;">{!! __('payments.no_further_payments_required') !!}</p>
                        </div>
                    </div>
                    <div class="d-none d-md-block mr-3">
                        <div class="glass-badge px-4 py-2 shadow-sm" style="background: rgba(255,255,255,0.2); border-radius: 50px; font-size: 14px; font-weight: bold;">
                            <i class="fas fa-certificate mr-1"></i> {!! __('general.verified') !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Stats Overview -->
            <div class="row mb-4">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card border-0 shadow-sm overflow-hidden h-100" style="border-radius: 15px;">
                        <div class="card-body p-2 d-flex align-items-center">
                            <div class="bg-light-primary p-2 rounded mr-2">
                                <i class="fas fa-file-invoice-dollar text-primary font-large-1"></i>
                            </div>
                            <div>
                                <h4 class="font-weight-bolder mb-0 text-dark">{!! number_format($contract->total_amount, 2) !!}</h4>
                                <p class="card-text text-muted font-small-3 mb-0">{!! __('contracts.total_amount') !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card border-0 shadow-sm overflow-hidden h-100" style="border-radius: 15px;">
                        <div class="card-body p-2 d-flex align-items-center">
                            <div class="bg-light-success p-2 rounded mr-2">
                                <i class="fas fa-wallet text-success font-large-1"></i>
                            </div>
                            <div>
                                <h4 class="font-weight-bolder mb-0 text-success">{!! number_format($contract->paid_amount, 2) !!}</h4>
                                <p class="card-text text-muted font-small-3 mb-0">{!! __('payments.paid_amount') !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="card border-0 shadow-sm overflow-hidden h-100" style="border-radius: 15px;">
                        <div class="card-body p-2 d-flex align-items-center">
                            <div class="bg-light-danger p-2 rounded mr-2">
                                <i class="fas fa-hand-holding-usd text-danger font-large-1"></i>
                            </div>
                            <div>
                                <h4 class="font-weight-bolder mb-0 text-danger">{!! number_format($contract->remaining_amount, 2) !!}</h4>
                                <p class="card-text text-muted font-small-3 mb-0">{!! __('payments.remaining_amount') !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <!-- Master Tabs Navigation -->
                <div class="text-center w-100 mb-4">
                    <ul class="nav nav-pills premium-segmented-control" id="contractTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link premium-tab-btn active" id="contract-tab" data-toggle="tab" href="#contract" role="tab">
                                <i class="fas fa-info-circle"></i> {!! __('contracts.contract_details') !!}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link premium-tab-btn" id="payments-tab" data-toggle="tab" href="#payments" role="tab">
                                <i class="fas fa-money-bill-wave"></i> {!! __('payments.payments') !!}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link premium-tab-btn" id="cheques-tab" data-toggle="tab" href="#cheques" role="tab">
                                <i class="fas fa-money-check-alt"></i> {!! __('cheques.cheques') !!}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link premium-tab-btn" id="terms-tab" data-toggle="tab" href="#terms" role="tab">
                                <i class="fas fa-file-alt"></i> {!! __('contracts.contract_text') !!}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link premium-tab-btn" id="property-tab" data-toggle="tab" href="#property" role="tab">
                                <i class="fas fa-building"></i> {!! __('properties.property') !!}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link premium-tab-btn" id="customer-tab" data-toggle="tab" href="#customer" role="tab">
                                <i class="fas fa-user-tie"></i> {!! __('contracts.customer') !!}
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" id="contractTabsContent">
                    @include('dashboard.contracts.show._details')
                    @include('dashboard.contracts.show._payments')
                    @include('dashboard.contracts.show._cheques')
                    @include('dashboard.contracts.show._terms')
                    @include('dashboard.contracts.show._property')
                    @include('dashboard.contracts.show._customer')
                </div>
            </div>
        </div>
    </div>
@endsection
