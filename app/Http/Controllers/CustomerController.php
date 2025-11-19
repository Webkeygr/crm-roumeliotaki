<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Company;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Λίστα πελατών
     */
    public function index()
    {
        $customers = Customer::with('company')
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(15);

        return view('customers.index', compact('customers'));
    }

    /**
     * Φόρμα δημιουργίας νέου πελάτη
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get();

        return view('customers.create', compact('companies'));
    }

    /**
     * Αποθήκευση νέου πελάτη
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'     => ['required', 'string', 'max:255'],
            'last_name'      => ['required', 'string', 'max:255'],
            'address'        => ['nullable', 'string', 'max:1000'],
            'birth_date'     => ['nullable', 'date'],
            'phone_landline' => ['nullable', 'string', 'max:50'],
            'phone_mobile'   => ['nullable', 'string', 'max:50'],
            'marital_status' => ['nullable', 'string', 'max:50'],
            'role_in_family' => ['nullable', 'string', 'max:50'],
            'company_id'     => ['nullable', 'integer', 'exists:companies,id'],
        ]);

        Customer::create($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Ο πελάτης δημιουργήθηκε με επιτυχία.');
    }

    /**
     * Προβολή συγκεκριμένου πελάτη
     */
    public function show(Customer $customer)
    {
        $customer->load('company', 'contractsAsPolicyHolder', 'contractsAsInsured', 'familyMembers');

        return view('customers.show', compact('customer'));
    }

    /**
     * Φόρμα επεξεργασίας πελάτη
     */
    public function edit(Customer $customer)
    {
        $companies = Company::orderBy('name')->get();

        return view('customers.edit', compact('customer', 'companies'));
    }

    /**
     * Ενημέρωση στοιχείων πελάτη
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'first_name'     => ['required', 'string', 'max:255'],
            'last_name'      => ['required', 'string', 'max:255'],
            'address'        => ['nullable', 'string', 'max:1000'],
            'birth_date'     => ['nullable', 'date'],
            'phone_landline' => ['nullable', 'string', 'max:50'],
            'phone_mobile'   => ['nullable', 'string', 'max:50'],
            'marital_status' => ['nullable', 'string', 'max:50'],
            'role_in_family' => ['nullable', 'string', 'max:50'],
            'company_id'     => ['nullable', 'integer', 'exists:companies,id'],
        ]);

        $customer->update($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Ο πελάτης ενημερώθηκε με επιτυχία.');
    }

    /**
     * Διαγραφή πελάτη
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Ο πελάτης διαγράφηκε.');
    }
}
