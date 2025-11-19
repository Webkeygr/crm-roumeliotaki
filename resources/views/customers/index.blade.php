@extends('layouts.app')

@section('title', 'Πελάτες · Roumeliotaki CRM')
@section('page-title', 'Πελάτες')

@section('content')
<div class="card-glass p-3 p-md-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 mb-md-4 gap-3">
        <div>
            <h1 class="h4 mb-1 text-white">Λίστα πελατών</h1>
            <p class="mb-0 text-muted-soft">
                Διαχείριση φυσικών προσώπων, οικογενειών και συμβολαίων.
            </p>
        </div>
        <div>
            <a href="{{ route('customers.create') }}" class="btn btn-key">
                <i class="bi bi-plus-lg me-1"></i> Νέος πελάτης
            </a>
        </div>
    </div>

    @if($customers->count())
        <div class="table-responsive">
            <table class="table table-dark table-dark-custom align-middle mb-0">
                <thead>
                <tr class="text-muted-soft small">
                    <th>Όνομα</th>
                    <th>Τηλέφωνο</th>
                    <th>Εταιρία</th>
                    <th>Οικογενειακή κατάσταση</th>
                    <th class="text-end">Ενέργειες</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>
                            <a href="{{ route('customers.show', $customer) }}"
                               class="text-decoration-none text-white">
                                {{ $customer->full_name }}
                            </a>
                        </td>
                        <td class="text-muted-soft">
                            @if($customer->phone_mobile)
                                <i class="bi bi-phone me-1"></i>{{ $customer->phone_mobile }}
                            @elseif($customer->phone_landline)
                                <i class="bi bi-telephone me-1"></i>{{ $customer->phone_landline }}
                            @else
                                <span class="text-muted-soft">—</span>
                            @endif
                        </td>
                        <td class="text-muted-soft">
                            {{ $customer->company?->name ?? '—' }}
                        </td>
                        <td class="text-muted-soft">
                            {{ $customer->marital_status ?? '—' }}
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('customers.show', $customer) }}"
                                   class="btn btn-outline-light btn-sm">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('customers.edit', $customer) }}"
                                   class="btn btn-outline-light btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('customers.destroy', $customer) }}"
                                      method="POST"
                                      onsubmit="return confirm('Σίγουρα θέλεις να διαγράψεις αυτόν τον πελάτη;')">
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
        {{ $customers->links() }}
        </div>
    @else
        <div class="text-center py-5 text-muted-soft">
            <i class="bi bi-people display-4 d-block mb-3"></i>
            Δεν έχουν καταχωρηθεί ακόμη πελάτες.
            <div class="mt-2">
                <a href="{{ route('customers.create') }}" class="btn btn-key btn-sm">
                    Προσθήκη πρώτου πελάτη
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
