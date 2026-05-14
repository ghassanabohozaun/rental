@extends('layouts.dashboard.app')

@section('title')
    {!! $title !!}
@endsection

@push('style')
@endpush

@section('content')
    <div class="app-content content">
        @livewire('dashboard.properties.edit-property', ['property' => $property])
    </div>
@endsection


