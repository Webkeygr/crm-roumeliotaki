@extends('layouts.app')

@section('title', 'Συμβόλαιο '.$policy->policy_number.' | Roumeliotaki CRM')
@section('page-title', 'Συμβόλαιο '.$policy->policy_number)

@section('content')
<div class="card-glass p-3 p-md-4 mb-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h5 mb-0">Στοιχεία συμβολαίου</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('policies.edit', $policy) }}" class="btn btn-sm btn-key">
                <i class="bi bi-pencil me-1"></i> Επεξεργασία
            </a>
            <form method="POST" action="{{ route('policies.destroy', $policy) }}"
                  onsubmit="return confirm('Σίγουρα θέλεις να διαγράψεις αυτό το συμβόλαιο;')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <h6 class="text-muted small mb-1">Αρ. συμβολαίου</h6>
            <div>{{ $policy->policy_number }}</div>
        </div>
        <div class="col-md-4">
            <h6 class="text-muted small mb-1">Ασφαλιστική</h6>
            <div>{{ $policy->insurance_company }}</div>
        </div>
        <div class="col-md-4">
            <h6 class="text-muted small mb-1">Τύπος</h6>
            <div>{{ $policy->contract_type }}</div>
        </div>

        <div class="col-md-4">
            <h6 class="text-muted small mb-1">Συμβαλλόμενος</h6>
            <div>{{ $policy->policyholder?->full_name ?? '—' }}</div>
        </div>
        <div class="col-md-4">
            <h6 class="text-muted small mb-1">Εταιρία</h6>
            <div>{{ $policy->company?->name ?? '—' }}</div>
        </div>
        <div class="col-md-4">
            <h6 class="text-muted small mb-1">Είδος συμβολαίου</h6>
            <div>{{ $policy->policy_kind }}</div>
        </div>

        <div class="col-md-4">
            <h6 class="text-muted small mb-1">Πληρωμή κάθε πότε</h6>
            <div>{{ $policy->payment_frequency }}</div>
        </div>
        <div class="col-md-4">
            <h6 class="text-muted small mb-1">Καθαρή αξία</h6>
            <div>{{ $policy->net_value ? number_format($policy->net_value, 2, ',', '.') . ' €' : '—' }}</div>
        </div>
        <div class="col-md-4">
            <h6 class="text-muted small mb-1">Κατάσταση</h6>
            <div>
                @if($policy->is_signed)
                    Υπογεγραμμένο
                    @if($policy->signed_at)
                        ( @date($policy->signed_at) )
                    @endif
                @else
                    <span class="text-danger">Ανυπόγραφο</span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card-glass p-3 p-md-4">
    <h5 class="h6 mb-3">Ασφαλιζόμενοι</h5>
    @if($policy->insuredCustomers->isEmpty())
        <p class="mb-0">Δεν έχουν οριστεί ασφαλιζόμενοι.</p>
    @else
        <ul class="mb-0">
            @foreach($policy->insuredCustomers as $customer)
                <li>{{ $customer->full_name }}</li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
