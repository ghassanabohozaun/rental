@extends('layouts.employees.app')
@section('title', __('dashboard.tasks'))

@section('content')
<div class="content-wrapper">
    @livewire('employee.tasks.todo-list')
</div>
@endsection
