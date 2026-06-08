@extends('layouts.dashboard.app')

@section('title')
    {!! $title !!}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/vendors/css/forms/selects/select2.min.css') }}">
@endpush

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <!-- begin: content header -->
            <div class="content-header row align-items-center mb-2">
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
                                    <a href="{!! route('dashboard.cheques.index') !!}">
                                        {!! __('cheques.cheques') !!}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active font-weight-bold">
                                    {!! __('cheques.import_cheques') !!}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end: content header -->

            <!-- begin: content body -->
            <div class="content-body">
                <section id="cheques-import-section">
                    <div class="row">
                        <div class="col-12">
                            @livewire('dashboard.cheques.import-cheques')
                        </div>
                    </div>
                </section>
            </div>
            <!-- end: content body -->
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/dashbaord/vendors/js/forms/select/select2.full.min.js') }}"></script>
@endpush
