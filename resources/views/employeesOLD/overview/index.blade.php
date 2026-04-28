@extends('layouts.employees.app')

@section('title', __('dashboard.dashboard'))

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom pb-2">
                        <ul class="nav nav-tabs premium-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link ps-2 active border-0" id="home-tab" data-bs-toggle="tab" href="#overview"
                                    role="tab" aria-selected="true">
                                    <i class="mdi mdi-view-dashboard-outline me-1"></i>
                                    {!! __('general.overview') !!}
                                </a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more"
                                    role="tab" aria-selected="false" tabindex="-1">
                                    <i class="mdi mdi-account-circle-outline me-1"></i>
                                    {!! __('general.profile') !!}
                                </a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a class="nav-link border-0" id="contracts-tab" data-bs-toggle="tab" href="#contracts"
                                    role="tab" aria-selected="false" tabindex="-1">
                                    <i class="mdi mdi-file-document-outline me-1"></i>
                                    {!! __('employees.contracts') !!}
                                </a>
                            </li>
                        </ul>

                        <div class="header-actions">
                            <div class="btn-wrapper">

                                <a href="javascript:void(0)" class="btn btn-outline-primary btn-sm rounded-pill px-4"
                                    id="employee_change_password_btn">
                                    <i class="fa fa-key me-1"></i>
                                    {!! __('employees.change_password') !!}
                                </a>

                                @include('employees.overview.modals.change-password')


                                <a href="javascript:void(0)"
                                    class="btn btn-primary text-white btn-sm rounded-pill px-4 ms-2">
                                    <i class="mdi mdi-gesture-tap me-1"></i>
                                    {!! __('general.actions') !!}
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="tab-content tab-content-basic">
                        @include('employees.overview.tabs.overview')
                        @include('employees.overview.tabs.more')
                        @include('employees.overview.tabs.contracts')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
