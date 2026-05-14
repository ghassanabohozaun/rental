@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@section('content')
    @push('style')
        
        
        <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/premium-select2.css') }}?v={{ time() }}">
    @endpush

    <div class="app-content content">
        @livewire('dashboard.payments.payment-form')
    </div>
@endsection


