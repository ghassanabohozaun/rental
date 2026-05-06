@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@section('content')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/cheques-premium.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/contracts-premium.css') }}?v={{ time() }}">
@endpush
    <div class="app-content content">
        @livewire('dashboard.cheques.cheque-form', ['is_deposit' => $is_deposit])
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/dashbaord/js/generic-select2.js') }}"></script>
@endpush
