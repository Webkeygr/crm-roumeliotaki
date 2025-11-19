@extends('layouts.app')

@section('title', 'Επεξεργασία πελάτη · Roumeliotaki CRM')
@section('page-title', 'Επεξεργασία πελάτη')

@section('content')
<div class="card-glass p-3 p-md-4">
    <h1 class="h4 mb-3 text-white">
        Επεξεργασία: {{ $customer->full_name }}
    </h1>

    <form method="POST" action="{{ route('customers.update', $customer) }}">
        @method('PUT')
        @include('customers._form', ['customer' => $customer])
    </form>
</div>
@endsection
