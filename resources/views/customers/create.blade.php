@extends('layouts.app')

@section('title', 'Νέος πελάτης · Roumeliotaki CRM')
@section('page-title', 'Νέος πελάτης')

@section('content')
<div class="card-glass p-3 p-md-4">
    <h1 class="h4 mb-3 text-white">Προσθήκη νέου πελάτη</h1>
    <p class="text-muted-soft mb-4">
        Συμπλήρωσε τα βασικά στοιχεία του πελάτη. Μπορείς να προσθέσεις περισσότερα στοιχεία αργότερα.
    </p>

    <form method="POST" action="{{ route('customers.store') }}">
        @include('customers._form', ['customer' => new \App\Models\Customer()])
    </form>
</div>
@endsection
