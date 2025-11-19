@extends('layouts.app')

@section('title', 'Ραντεβού · Roumeliotaki CRM')
@section('page-title', 'Ραντεβού')

@section('content')
<div class="card-glass p-3 p-md-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 mb-md-4 gap-3">
        <div>
            <h1 class="h4 mb-1 text-white">Λίστα ραντεβού</h1>
            <p class="mb-0 text-muted-soft">
                Παρακολούθηση ραντεβού με πελάτες ανά προϊόν & ασφαλιστική.
            </p>
        </div>
        <div>
            <a href="{{ route('appointments.create') }}" class="btn btn-key">
                <i class="bi bi-plus-lg me-1"></i> Νέο ραντεβού
            </a>
        </div>
    </div>

    @if($appointments->count())
        <div class="table-responsive">
            <table class="table table-dark table-dark-custom align-middle mb-0">
                <thead>
                <tr class="text-muted-soft small">
                    <th>Πελάτης</th>
                    <th>Ημερ. & Ώρα</th>
                    <th>Λόγος</th>
                    <th>Κατάσταση</th>
                    <th>Ασφαλιστική</th>
                    <th class="text-end">Ενέργειες</th>
                </tr>
                </thead>
                <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>
                            <a href="{{ route('customers.show', $appointment->customer) }}"
                               class="text-decoration-none text-white">
                                {{ $appointment->customer?->full_name ?? '—' }}
                            </a>
                        </td>
                        <td class="text-muted-soft">
                            {{ $appointment->date->format('d/m/Y') }}
                            ·
                            {{ $appointment->time->format('H:i') }}
                        </td>
                        <td class="text-muted-soft">
                            {{ $appointment->reason }}
                        </td>
                        <td>
                            @php
                                $status = $appointment->status;
                                $statusClass = match($status) {
                                    'Άκυρο' => 'badge bg-danger',
                                    'Αίτηση' => 'badge bg-info',
                                    'Υπογραφή συμβολαίου' => 'badge bg-success',
                                    default => 'badge bg-warning text-dark',
                                };
                            @endphp
                            <span class="{{ $statusClass }}">
                                {{ $status }}
                            </span>
                        </td>
                        <td class="text-muted-soft">
                            {{ $appointment->insurance_company ?? '—' }}
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('appointments.show', $appointment) }}"
                                   class="btn btn-outline-light btn-sm">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('appointments.edit', $appointment) }}"
                                   class="btn btn-outline-light btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('appointments.destroy', $appointment) }}"
                                      method="POST"
                                      onsubmit="return confirm('Σίγουρα θέλεις να διαγράψεις αυτό το ραντεβού;')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" type="submit">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $appointments->links() }}
        </div>
    @else
        <div class="text-center py-5 text-muted-soft">
            <i class="bi bi-calendar-event display-4 d-block mb-3"></i>
            Δεν έχουν καταχωρηθεί ακόμη ραντεβού.
            <div class="mt-2">
                <a href="{{ route('appointments.create') }}" class="btn btn-key btn-sm">
                    Προσθήκη πρώτου ραντεβού
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
