@extends('layouts.app')

@section('title', $customer->full_name . ' · Πελάτης')
@section('page-title', 'Στοιχεία πελάτη')

@section('content')
    {{-- Κάρτα βασικών στοιχείων πελάτη --}}
    <div class="card-glass p-3 p-md-4 mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
            <div>
                <h1 class="h4 mb-1 text-dark">{{ $customer->full_name }}</h1>
                <p class="mb-0 text-muted-soft">
                    {{ $customer->marital_status ?: 'Χωρίς δηλωμένη οικογενειακή κατάσταση' }}
                    @if($customer->birth_date)
    · Γέννηση: @date($customer->birth_date)
@endif
                </p>
            </div>

            <div class="text-md-end">
                @if($customer->company)
                    <div class="small text-muted-soft">Εταιρία</div>
                    <div>
                        <a href="{{ route('companies.show', $customer->company) }}"
                           class="text-decoration-none">
                            {{ $customer->company->name }}
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <hr class="border-secondary border-opacity-25 my-4">

        <div class="row g-3">
            <div class="col-md-4">
                <h6 class="text-muted-soft text-uppercase small">Στοιχεία επικοινωνίας</h6>
                <div class="mt-2 small">
                    <div><strong>Κινητό:</strong> {{ $customer->phone_mobile ?: '—' }}</div>
                    <div><strong>Σταθερό:</strong> {{ $customer->phone_landline ?: '—' }}</div>
                    <div class="mt-2"><strong>Email:</strong> — (προαιρετικό πεδίο στο μέλλον)</div>
                </div>
            </div>

            <div class="col-md-4">
                <h6 class="text-muted-soft text-uppercase small">Διεύθυνση</h6>
                <div class="mt-2 small">
                    {{ $customer->address ?: 'Δεν έχει καταχωρηθεί διεύθυνση.' }}
                </div>
            </div>

            <div class="col-md-4">
                <h6 class="text-muted-soft text-uppercase small">Λοιπά</h6>
                <div class="mt-2 small">
                    <div><strong>Ρόλος στην οικογένεια:</strong> {{ $customer->role_in_family ?: '—' }}</div>
                    {{-- εδώ στο μέλλον θα μπει “Οικογένεια / μέλη” --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Overview ραντεβού --}}
    <div class="row g-4">
        {{-- Επερχόμενα ραντεβού --}}
        <div class="col-lg-6">
            <div class="card-glass p-3 p-md-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h2 class="h5 mb-1 text-dark">Επερχόμενα ραντεβού</h2>
                        <p class="mb-0 text-muted-soft small">
                            Τα επόμενα ραντεβού που έχεις προγραμματίσει με τον πελάτη.
                        </p>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('appointments.create', ['customer_id' => $customer->id]) }}"
                           class="btn btn-key btn-sm">
                            <i class="bi bi-plus-lg me-1"></i> Νέο ραντεβού
                        </a>
                    </div>
                </div>

                @if($upcomingAppointments->count())
                    <ul class="list-group list-group-flush">
                        @foreach($upcomingAppointments as $appointment)
                            <li class="list-group-item bg-transparent px-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fw-semibold">
                                        {{ $appointment->date->format('d/m/Y') }}
                                        · {{ $appointment->time->format('H:i') }}
                                    </div>
                                    <div class="small text-muted-soft">
                                        {{ $appointment->reason }}
                                        @if($appointment->insurance_company)
                                            · {{ $appointment->insurance_company }}
                                        @endif
                                    </div>
                                    @if($appointment->location)
                                        <div class="small text-muted-soft">
                                            <i class="bi bi-geo-alt me-1"></i>{{ $appointment->location }}
                                        </div>
                                    @endif
                                </div>
                                <div class="text-end">
                                    @php
                                        $status = $appointment->status;
                                        $statusClass = match($status) {
                                            'Άκυρο' => 'badge bg-danger',
                                            'Αίτηση' => 'badge bg-info text-dark',
                                            'Υπογραφή συμβολαίου' => 'badge bg-success',
                                            default => 'badge bg-warning text-dark',
                                        };
                                    @endphp
                                    <span class="{{ $statusClass }} small">{{ $status }}</span>
                                    <div class="mt-2">
                                        <a href="{{ route('appointments.edit', $appointment) }}"
                                           class="small text-decoration-none">
                                            Επεξεργασία
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-muted-soft small mt-2">
                        Δεν υπάρχουν επερχόμενα ραντεβού.
                    </div>
                @endif
            </div>
        </div>

        {{-- Πρόσφατα ραντεβού --}}
        <div class="col-lg-6">
            <div class="card-glass p-3 p-md-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h2 class="h5 mb-1 text-dark">Πρόσφατα ραντεβού</h2>
                        <p class="mb-0 text-muted-soft small">
                            Τα τελευταία ραντεβού που έχουν ήδη πραγματοποιηθεί.
                        </p>
                    </div>
                </div>

                @if($pastAppointments->count())
                    <ul class="list-group list-group-flush">
                        @foreach($pastAppointments as $appointment)
                            <li class="list-group-item bg-transparent px-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fw-semibold">
                                        {{ $appointment->date->format('d/m/Y') }}
                                        · {{ $appointment->time->format('H:i') }}
                                    </div>
                                    <div class="small text-muted-soft">
                                        {{ $appointment->reason }}
                                        @if($appointment->insurance_company)
                                            · {{ $appointment->insurance_company }}
                                        @endif
                                    </div>
                                </div>
                                <div class="text-end">
                                    @php
                                        $status = $appointment->status;
                                        $statusClass = match($status) {
                                            'Άκυρο' => 'badge bg-danger',
                                            'Αίτηση' => 'badge bg-info text-dark',
                                            'Υπογραφή συμβολαίου' => 'badge bg-success',
                                            default => 'badge bg-secondary',
                                        };
                                    @endphp
                                    <span class="{{ $statusClass }} small">{{ $status }}</span>
                                    <div class="mt-2">
                                        <a href="{{ route('appointments.show', $appointment) }}"
                                           class="small text-decoration-none">
                                            Προβολή
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-muted-soft small mt-2">
                        Δεν υπάρχουν προηγούμενα ραντεβού καταχωρημένα.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
