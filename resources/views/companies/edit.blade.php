@extends('layouts.app')

@section('title', 'Επεξεργασία εταιρίας · Roumeliotaki CRM')
@section('page-title', 'Επεξεργασία εταιρίας')

@section('content')
<div class="card-glass p-3 p-md-4">
    <h1 class="h4 mb-3 text-white">
        Επεξεργασία: {{ $company->name }}
    </h1>

    <form method="POST" action="{{ route('companies.update', $company) }}">
        @method('PUT')
        @include('companies._form', ['company' => $company])
    </form>
</div>
@endsection
