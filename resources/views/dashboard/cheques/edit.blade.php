@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@section('content')
@push('style')
    
    
@endpush
    <div class="app-content content">
        @livewire('dashboard.cheques.edit-cheque', [
        'cheque' => $cheque
    ])
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/dashbaord/js/generic-select2.js') }}"></script>
@endpush
