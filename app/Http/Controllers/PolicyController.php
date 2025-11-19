<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\Customer;
use App\Models\Company;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index()
    {
        $policies = Policy::with(['policyholder', 'company'])
            ->latest()
            ->paginate(15);

        return view('policies.index', compact('policies'));
    }

    public function create()
    {
        $customers = Customer::orderBy('last_name')->orderBy('first_name')->get();
        $companies = Company::orderBy('name')->get();

        // επιλογές dropdown
        $contractTypes = ['Ατομικό', 'Οικογενειακό', 'Ομαδικό'];
        $insuranceCompanies = ['Interamerican', 'Groupama'];
        $paymentFrequencies = ['Μηνιαίο', 'Τρίμηνο', 'Εξάμηνο', 'Ετήσιο'];
        $policyKinds = [
            'Ομαδικό ασφαλιστικό',
            'Ασφάλεια Υγείας',
            'Ασφάλεια Ζωής',
            'Ασφάλεια αυτοκινήτου',
            'Ασφάλεια σπιτιού',
        ];

        return view('policies.create', compact(
            'customers',
            'companies',
            'contractTypes',
            'insuranceCompanies',
            'paymentFrequencies',
            'policyKinds'
        ));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $policy = Policy::create($data);

        // ασφαλιζόμενοι
        $policy->insuredCustomers()->sync($request->input('insured_ids', []));

        return redirect()
            ->route('policies.show', $policy)
            ->with('success', 'Το συμβόλαιο δημιουργήθηκε με επιτυχία.');
    }

    public function show(Policy $policy)
    {
        $policy->load(['policyholder', 'company', 'insuredCustomers']);
        return view('policies.show', compact('policy'));
    }

    public function edit(Policy $policy)
    {
        $customers = Customer::orderBy('last_name')->orderBy('first_name')->get();
        $companies = Company::orderBy('name')->get();

        $contractTypes = ['Ατομικό', 'Οικογενειακό', 'Ομαδικό'];
        $insuranceCompanies = ['Interamerican', 'Groupama'];
        $paymentFrequencies = ['Μηνιαίο', 'Τρίμηνο', 'Εξάμηνο', 'Ετήσιο'];
        $policyKinds = [
            'Ομαδικό ασφαλιστικό',
            'Ασφάλεια Υγείας',
            'Ασφάλεια Ζωής',
            'Ασφάλεια αυτοκινήτου',
            'Ασφάλεια σπιτιού',
        ];

        // ids των ήδη ασφαλισμένων
        $selectedInsuredIds = $policy->insuredCustomers()->pluck('customers.id')->toArray();

        return view('policies.edit', compact(
            'policy',
            'customers',
            'companies',
            'contractTypes',
            'insuranceCompanies',
            'paymentFrequencies',
            'policyKinds',
            'selectedInsuredIds'
        ));
    }

    public function update(Request $request, Policy $policy)
    {
        $data = $this->validateData($request, $policy->id);

        $policy->update($data);
        $policy->insuredCustomers()->sync($request->input('insured_ids', []));

        return redirect()
            ->route('policies.show', $policy)
            ->with('success', 'Το συμβόλαιο ενημερώθηκε με επιτυχία.');
    }

    public function destroy(Policy $policy)
    {
        $policy->delete();

        return redirect()
            ->route('policies.index')
            ->with('success', 'Το συμβόλαιο διαγράφηκε.');
    }

    private function validateData(Request $request, ?int $policyId = null): array
    {
        $idRule = $policyId ? ",{$policyId}" : '';

        return $request->validate([
            'contract_type'      => 'required|string|max:255',
            'insurance_company'  => 'required|string|max:255',
            'policy_number'      => 'required|string|max:255|unique:policies,policy_number' . $idRule,
            'is_signed'          => 'sometimes|boolean',
            'signed_at'          => 'nullable|date',
            'payment_frequency'  => 'required|string|max:255',
            'net_value'          => 'nullable|numeric|min:0',
            'policy_kind'        => 'required|string|max:255',
            'policyholder_id'    => 'required|exists:customers,id',
            'company_id'         => 'nullable|exists:companies,id',
            'insured_ids'        => 'nullable|array',
            'insured_ids.*'      => 'exists:customers,id',
        ]);
    }
}
