@extends('layouts.dashboard.app')

@section('title')
    {!! $title !!}
@endsection

@section('content')
    <div class="app-content content">
        <livewire:dashboard.customers.create-customer />
    </div>
@endsection


