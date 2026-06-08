@extends('layouts.dashboard.app')
@section('title', $title)
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
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
                            <li class="breadcrumb-item active font-weight-bold">
                                {!! $title !!}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12 text-md-right">
                <div class="mb-1">
                    @can('contract_clauses_create')
                    <a href="{{ route('dashboard.contract_clause_templates.create') }}" class="btn btn-premium-add shadow-pulse">
                        <i class="fas fa-plus-circle"></i> 
                        {!! __('contracts.add_new_clause') !!}
                    </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card premium-card premium-card-anim">
                            <div class="premium-mandatory-header py-2">
                                <div class="title-wrapper">
                                    <i class="fas fa-file-invoice"></i> 
                                    <span class="font-weight-bold">{!! $title !!}</span>
                                </div>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="fas fa-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="fas fa-sync"></i></a></li>
                                        <li><a data-action="expand"><i class="fas fa-expand"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="table-loader-container">
                                        <div class="table-loader-overlay" id="tableLoader">
                                            <span class="premium-loader"></span>
                                        </div>
                                        <div id="table_data">
                                            @include('dashboard.contract_clause_templates.partials._table')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @include('dashboard.contracts.modals.details')
</div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/dashbaord/js/ajax-table.js') }}"></script>
    <script>
        $(document).ready(function() {
            if (typeof initIndexTable === "function") {
                initIndexTable();
            }
        });
    </script>
@endpush
