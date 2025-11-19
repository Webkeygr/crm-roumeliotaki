@extends('layouts.app')

@section('title', $company->name . ' · Εταιρία')
@section('page-title', 'Εταιρία')

@section('content')
<div class="card-glass p-3 p-md-4 mb-4">
    <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
        <div>
            <h1 class="h4 mb-1 text-white">{{ $company->name }}</h1>
            <p class="mb-0 text-muted-soft">
                {{ $company->business_activity ?: 'Χωρίς δηλωμένο αντικείμενο' }}
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('companies.edit', $company) }}" class="btn btn-outline-light btn-sm">
                <i class="bi bi-pencil me-1"></i> Επεξεργασία
            </a>
            <a href="{{ route('companies.index') }}" class="btn btn-outline-light btn-sm">
                Πίσω στη λίστα
            </a>
        </div>
    </div>

    <hr class="border-secondary border-opacity-25 my-4">

    <div class="row g-3">
        <div class="col-md-6">
            <h6 class="text-muted-soft text-uppercase small">Δυναμικό</h6>
            <div class="mt-2">
                @if($company->staff_size_exact)
                    <div><strong>Άτομα:</strong> {{ $company->staff_size_exact }}</div>
                @elseif($company->staff_size_range_from || $company->staff_size_range_to)
                    <div><strong>Άτομα:</strong>
                        {{ $company->staff_size_range_from ?: '?' }}
                        –
                        {{ $company->staff_size_range_to ?: '?' }}
                    </div>
                @else
                    <div>Δεν έχει οριστεί.</div>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <h6 class="text-muted-soft text-uppercase small">Σημειώσεις</h6>
            <div class="mt-2">
                {{ $company->notes ?: '—' }}
            </div>
        </div>
    </div>

    <hr class="border-secondary border-opacity-25 my-4">

    <h6 class="text-muted-soft text-uppercase small">Σχετικοί πελάτες</h6>
    <div class="mt-2">
        @if($company->customers->count())
            <ul class="list-unstyled mb-0">
                @foreach($company->customers as $customer)
                    <li>
                        <a href="{{ route('customers.show', $customer) }}"
                           class="text-decoration-none text-white">
                            {{ $customer->full_name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <span class="text-muted-soft">Δεν υπάρχουν πελάτες συνδεδεμένοι με αυτή την εταιρία.</span>
        @endif
    </div>
</div>
@endsection
