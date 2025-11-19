@extends('layouts.app')

@section('title', 'Επεξεργασία συμβολαίου | Roumeliotaki CRM')
@section('page-title', 'Επεξεργασία συμβολαίου')

@section('content')
<div class="card-glass p-3 p-md-4">
    <h2 class="h5 mb-3">Επεξεργασία συμβολαίου {{ $policy->policy_number }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Υπάρχουν σφάλματα στη φόρμα.</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('policies.update', $policy) }}">
        @csrf
        @method('PUT')

        @include('policies._form')

        <div class="mt-4 d-flex justify-content-end gap-2">
            <a href="{{ route('policies.show', $policy) }}" class="btn btn-outline-secondary">Άκυρο</a>
            <button type="submit" class="btn btn-key">Αποθήκευση</button>
        </div>
    </form>
</div>
@endsection
