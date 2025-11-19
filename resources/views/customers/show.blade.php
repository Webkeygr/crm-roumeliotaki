@extends('layouts.app')

@section('title', $customer->full_name . ' · Πελάτης')
@section('page-title', 'Πελάτης')

@section('content')
<div class="card-glass p-3 p-md-4 mb-4">
    <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
        <div>
            <h1 class="h4 mb-1 text-white">{{ $customer->full_name }}</h1>
            <p class="mb-0 text-muted-soft">
                {{ $customer->role_in_family ?? 'Ρόλος οικογένειας μη ορισμένος' }}
                @if($customer->marital_status)
                    · {{ $customer->marital_status }}
                @endif
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-outline-light btn-sm">
                <i class="bi bi-pencil me-1"></i> Επεξεργασία
            </a>
            <a href="{{ route('customers.index') }}" class="btn btn-outline-light btn-sm">
                Πίσω στη λίστα
            </a>
        </div>
    </div>

    <hr class="border-secondary border-opacity-25 my-4">

    <div class="row g-3">
        <div class="col-md-6">
            <h6 class="text-muted-soft text-uppercase small">Στοιχεία επικοινωνίας</h6>
            <div class="mt-2">
                <div><strong>Διεύθυνση:</strong> {{ $customer->address ?: '—' }}</div>
                <div><strong>Σταθερό:</strong> {{ $customer->phone_landline ?: '—' }}</div>
                <div><strong>Κινητό:</strong> {{ $customer->phone_mobile ?: '—' }}</div>
                <div><strong>Ημ. γέννησης:</strong>
                    {{ $customer->birth_date ? $customer->birth_date->format('d/m/Y') : '—' }}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <h6 class="text-muted-soft text-uppercase small">Εργασία</h6>
            <div class="mt-2">
                <div><strong>Εταιρία:</strong> {{ $customer->company?->name ?? '—' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
