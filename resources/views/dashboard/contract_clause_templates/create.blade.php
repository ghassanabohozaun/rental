@extends('layouts.dashboard.app')
@section('title', $title)
@section('content')
<div class="app-content content">
    <form class="form ajax-form" action="{{ route('dashboard.contract_clause_templates.store') }}" method="post" data-success-action="redirect" data-redirect-url="{{ route('dashboard.contract_clause_templates.index') }}">
        @csrf
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 mb-md-0">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb premium-breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{!! route('dashboard.index') !!}">
                                        <i class="fas fa-home"></i> {!! __('dashboard.home') !!}
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{!! route('dashboard.contract_clause_templates.index') !!}">
                                        {!! __('contracts.contract_clauses_library') !!}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active font-weight-bold">
                                    {!! $title !!}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 text-md-right mb-2">
                    <div class="d-flex justify-content-md-end justify-content-center gap-2">
                        <a href="{{ route('dashboard.contract_clause_templates.index') }}" class="btn-premium-back">
                            <i class="fas fa-arrow-left"></i> {!! __('contracts.back') !!}
                        </a>
                        <button type="submit" class="btn btn-premium-save">
                            <i class="fas fa-save mr-2"></i> {!! __('contracts.save') !!}
                        </button>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="card premium-card shadow-lg border-0 premium-card-anim">
                    <div class="premium-mandatory-header">
                        <div class="title-wrapper">
                            <i class="fas fa-plus-circle"></i>
                            <span class="font-weight-bold">{!! $title !!}</span>
                        </div>
                    </div>
                    <div class="card-body pt-3">
                        @if(auth()->user()->role_id == 1)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{!! __('companies.company') !!}</label>
                                    <select name="company_id" class="form-control select2">
                                        <option value="">{!! __('companies.choose_company') !!}</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-8">
                                <div class="premium-form-group">
                                    <label class="premium-label">{!! __('contracts.clause_title_hint') !!} <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control premium-input shadow-none" placeholder="{!! __('contracts.clause_title_placeholder') !!}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="premium-form-group">
                                    <label class="premium-label">{!! __('contracts.order_num_hint') !!} <span class="text-danger">*</span></label>
                                    <input type="number" name="order_num" class="form-control premium-input shadow-none" value="0">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                @include('dashboard.contracts.partials._smart_tags_hint')
                                <div class="premium-form-group">
                                    <label class="premium-label">{!! __('contracts.clause_content_placeholder') !!} <span class="text-danger">*</span></label>
                                    <textarea name="content" class="form-control premium-input shadow-none" rows="10"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group d-flex align-items-center">
                                    <div class="custom-control custom-switch mr-2" style="margin-left: 10px;">
                                        <input type="checkbox" class="custom-control-input" id="is_default" name="is_default" value="1">
                                        <label class="custom-control-label" for="is_default"></label>
                                    </div>
                                    <label for="is_default" class="mb-0 cursor-pointer font-weight-bold text-dark-premium">{!! __('contracts.is_default_clause_hint') !!}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group d-flex align-items-center">
                                    <div class="custom-control custom-switch mr-2" style="margin-left: 10px;">
                                        <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" checked>
                                        <label class="custom-control-label" for="status"></label>
                                    </div>
                                    <label for="status" class="mb-0 cursor-pointer font-weight-bold text-dark-premium">{!! __('contracts.clause_status_active') !!}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        if ($.fn.select2) {
            $('.select2').select2({ width: '100%' });
        }
    });
</script>
@endpush
