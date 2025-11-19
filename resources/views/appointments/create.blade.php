@extends('layouts.app')

@section('title', 'Νέο ραντεβού · Roumeliotaki CRM')
@section('page-title', 'Νέο ραντεβού')

@section('content')
<div class="card-glass p-3 p-md-4">
    <h1 class="h4 mb-3 text-white">Καταχώριση νέου ραντεβού</h1>
    <p class="text-muted-soft mb-4">
        Επίλεξε πελάτη, προϊόν, ασφαλιστική και σημείωσε τα βασικά στοιχεία του ραντεβού.
    </p>

    <form method="POST" action="{{ route('appointments.store') }}">
    @include('appointments._form', [
        'appointment' => new \App\Models\Appointment(),
        'selectedCustomerId' => $selectedCustomerId ?? null,
    ])
</form>

</div>
@endsection
