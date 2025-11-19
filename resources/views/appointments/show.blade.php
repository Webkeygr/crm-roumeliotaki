@extends('layouts.app')

@section('title', 'Ραντεβού · ' . $appointment->customer?->full_name)
@section('page-title', 'Ραντεβού')

@section('content')
<div class="card-glass p-3 p-md-4 mb-4">
    <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
        <div>
            <h1 class="h4 mb-1 text-white">
                Ραντεβού με {{ $appointment->customer?->full_name }}
            </h1>
            <p class="mb-0 text-muted-soft">
                {{ $appointment->date->format('d/m/Y') }} · {{ $appointment->time->format('H:i') }}
                @if($appointment->location)
                    · {{ $appointment->location }}
                @endif
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-outline-light btn-sm">
                <i class="bi bi-pencil me-1"></i> Επεξεργασία
            </a>
            <a href="{{ route('appointments.index') }}" class="btn btn-outline-light btn-sm">
                Πίσω στη λίστα
            </a>
        </div>
    </div>

    <hr class="border-secondary border-opacity-25 my-4">

    <div class="row g-3">
        <div class="col-md-6">
            <h6 class="text-muted-soft text-uppercase small">Λόγος</h6>
            <div class="mt-2">
                <strong>{{ $appointment->reason }}</strong>
                <div class="mt-1">
                    {{ $appointment->reason_detail ?: '—' }}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <h6 class="text-muted-soft text-uppercase small">Κατάσταση & ασφαλιστική</h6>
            <div class="mt-2">
                <div><strong>Κατάσταση:</strong> {{ $appointment->status }}</div>
                <div><strong>Ασφαλιστική:</strong> {{ $appointment->insurance_company ?: '—' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
