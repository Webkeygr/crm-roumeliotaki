@extends('layouts.app')

@section('title', 'Εταιρίες · Roumeliotaki CRM')
@section('page-title', 'Εταιρίες')

@section('content')
<div class="card-glass p-3 p-md-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 mb-md-4 gap-3">
        <div>
            <h1 class="h4 mb-1 text-white">Λίστα εταιριών</h1>
            <p class="mb-0 text-muted-soft">
                Επιχειρήσεις – εργοδότες για ομαδικά συμβόλαια και συνδέσεις με πελάτες.
            </p>
        </div>
        <div>
            <a href="{{ route('companies.create') }}" class="btn btn-key">
                <i class="bi bi-plus-lg me-1"></i> Νέα εταιρία
            </a>
        </div>
    </div>

    @if($companies->count())
        <div class="table-responsive">
            <table class="table table-dark table-dark-custom align-middle mb-0">
                <thead>
                <tr class="text-muted-soft small">
                    <th>Επωνυμία</th>
                    <th>Αντικείμενο</th>
                    <th>Δυναμικό</th>
                    <th class="text-end">Ενέργειες</th>
                </tr>
                </thead>
                <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td>
                            <a href="{{ route('companies.show', $company) }}"
                               class="text-decoration-none text-white">
                                {{ $company->name }}
                            </a>
                        </td>
                        <td class="text-muted-soft">
                            {{ \Illuminate\Support\Str::limit($company->business_activity, 40) ?: '—' }}
                        </td>
                        <td class="text-muted-soft">
                            @if($company->staff_size_exact)
                                {{ $company->staff_size_exact }} άτομα
                            @elseif($company->staff_size_range_from || $company->staff_size_range_to)
                                {{ $company->staff_size_range_from ?: '?' }}
                                –
                                {{ $company->staff_size_range_to ?: '?' }} άτομα
                            @else
                                —
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('companies.show', $company) }}"
                                   class="btn btn-outline-light btn-sm">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('companies.edit', $company) }}"
                                   class="btn btn-outline-light btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('companies.destroy', $company) }}"
                                      method="POST"
                                      onsubmit="return confirm('Σίγουρα θέλεις να διαγράψεις αυτή την εταιρία;')">
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
            {{ $companies->links() }}
        </div>
    @else
        <div class="text-center py-5 text-muted-soft">
            <i class="bi bi-building display-4 d-block mb-3"></i>
            Δεν έχουν καταχωρηθεί ακόμη εταιρίες.
            <div class="mt-2">
                <a href="{{ route('companies.create') }}" class="btn btn-key btn-sm">
                    Προσθήκη πρώτης εταιρίας
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
