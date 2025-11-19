@extends('layouts.app')

@section('title', 'Επεξεργασία ραντεβού · Roumeliotaki CRM')
@section('page-title', 'Επεξεργασία ραντεβού')

@section('content')
<div class="card-glass p-3 p-md-4">
    <h1 class="h4 mb-3 text-white">
        Επεξεργασία ραντεβού με {{ $appointment->customer?->full_name }}
    </h1>

    <form method="POST" action="{{ route('appointments.update', $appointment) }}">
        @method('PUT')
        @include('appointments._form', ['appointment' => $appointment])
    </form>
</div>
@endsection
