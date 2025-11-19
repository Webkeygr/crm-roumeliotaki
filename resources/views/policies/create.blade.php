@extends('layouts.app')

@section('title', 'Νέο συμβόλαιο | Roumeliotaki CRM')
@section('page-title', 'Νέο συμβόλαιο')

@section('content')
<div class="card-glass p-3 p-md-4">
    <h2 class="h5 mb-3">Καταχώρηση νέου συμβολαίου</h2>

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

    <form method="POST" action="{{ route('policies.store') }}">
        @csrf
        @include('policies._form')

        <div class="mt-4 d-flex justify-content-end gap-2">
            <a href="{{ route('policies.index') }}" class="btn btn-outline-secondary">Ακύρωση</a>
            <button type="submit" class="btn btn-key">Αποθήκευση</button>
        </div>
    </form>
</div>
@endsection
