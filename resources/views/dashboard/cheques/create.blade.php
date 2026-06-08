@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@section('content')
    <div class="app-content content">
        @livewire('dashboard.cheques.create-cheque', [
            'is_deposit' => $is_deposit,
            'contract_id' => $contract_id,
            'company_id' => $company_id,
        ])
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/dashbaord/js/generic-select2.js') }}"></script>
@endpush
