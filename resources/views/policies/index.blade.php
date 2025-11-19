@extends('layouts.app')

@section('title', 'Συμβόλαια | Roumeliotaki CRM')
@section('page-title', 'Συμβόλαια')

@section('content')
<div class="card-glass p-3 p-md-4 mb-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="h5 mb-1">Λίστα συμβολαίων</h2>
            <p class="text-muted mb-0 small">
                Επισκόπηση όλων των ενεργών και μη συμβολαίων.
            </p>
        </div>
        <a href="{{ route('policies.create') }}" class="btn btn-key">
            <i class="bi bi-plus-lg me-1"></i> Νέο συμβόλαιο
        </a>
    </div>

    @if($policies->isEmpty())
        <p class="mb-0">Δεν υπάρχουν καταχωρημένα συμβόλαια.</p>
    @else
        <div class="table-responsive">
            <table class="table table-dark-custom align-middle mb-0">
                <thead>
                <tr>
                    <th>Αρ. Συμβολαίου</th>
                    <th>Συμβαλλόμενος</th>
                    <th>Εταιρία</th>
                    <th>Είδος</th>
                    <th>Τύπος</th>
                    <th>Υπογραφή</th>
                    <th class="text-end">Ενέργειες</th>
                </tr>
                </thead>
                <tbody>
                @foreach($policies as $policy)
                    <tr>
                        <td>{{ $policy->policy_number }}</td>
                        <td>{{ $policy->policyholder?->full_name ?? '—' }}</td>
                        <td>{{ $policy->insurance_company }}</td>
                        <td>{{ $policy->policy_kind }}</td>
                        <td>{{ $policy->contract_type }}</td>
                        <td>
                            @if($policy->is_signed)
                                Υπογεγραμμένο
                                @if($policy->signed_at)
                                    – @date($policy->signed_at)
                                @endif
                            @else
                                <span class="text-danger">Ανυπόγραφο</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('policies.show', $policy) }}"
                               class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('policies.edit', $policy) }}"
                               class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $policies->links() }}
        </div>
    @endif
</div>
@endsection
