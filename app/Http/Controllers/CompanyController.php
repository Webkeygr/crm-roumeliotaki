<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::orderBy('name')->paginate(15);

        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'business_activity' => ['nullable', 'string'],
            'contact_position'  => ['nullable', 'string', 'max:255'],
            'staff_size_exact'  => ['nullable', 'integer'],
            'staff_size_range_from' => ['nullable', 'integer'],
            'staff_size_range_to'   => ['nullable', 'integer'],
            'notes'             => ['nullable', 'string'],
        ]);

        Company::create($validated);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Η εταιρία δημιουργήθηκε με επιτυχία.');
    }

    public function show(Company $company)
    {
        $company->load('customers');

        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'business_activity' => ['nullable', 'string'],
            'contact_position'  => ['nullable', 'string', 'max:255'],
            'staff_size_exact'  => ['nullable', 'integer'],
            'staff_size_range_from' => ['nullable', 'integer'],
            'staff_size_range_to'   => ['nullable', 'integer'],
            'notes'             => ['nullable', 'string'],
        ]);

        $company->update($validated);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Η εταιρία ενημερώθηκε.');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()
            ->route('companies.index')
            ->with('success', 'Η εταιρία διαγράφηκε.');
    }
}
