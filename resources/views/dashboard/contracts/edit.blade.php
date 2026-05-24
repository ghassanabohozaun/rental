@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/vendors/css/pickers/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')
    <div class="app-content content">
        @livewire(\App\Livewire\Dashboard\Contracts\EditContract::class, ['contract' => $contract])
    </div>
@endsection
