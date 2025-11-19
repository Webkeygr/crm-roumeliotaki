@extends('layouts.app')

@section('title', 'Νέα εταιρία · Roumeliotaki CRM')
@section('page-title', 'Νέα εταιρία')

@section('content')
<div class="card-glass p-3 p-md-4">
    <h1 class="h4 mb-3 text-white">Προσθήκη νέας εταιρίας</h1>
    <p class="text-muted-soft mb-4">
        Καταχώρισε βασικές πληροφορίες για την επιχείρηση.
    </p>

    <form method="POST" action="{{ route('companies.store') }}">
        @include('companies._form', ['company' => new \App\Models\Company()])
    </form>
</div>
@endsection
