@php
    $isEdit = isset($policy);
@endphp

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">Αρ. συμβολαίου</label>
        <input type="text" name="policy_number" class="form-control"
               value="{{ old('policy_number', $policy->policy_number ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Ασφαλιστική εταιρία</label>
        <select name="insurance_company" class="form-select" required>
            <option value="">— Επιλογή —</option>
            @foreach($insuranceCompanies as $company)
                <option value="{{ $company }}"
                    {{ old('insurance_company', $policy->insurance_company ?? '') === $company ? 'selected' : '' }}>
                    {{ $company }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Τύπος συμβολαίου</label>
        <select name="contract_type" class="form-select" required>
            <option value="">— Επιλογή —</option>
            @foreach($contractTypes as $type)
                <option value="{{ $type }}"
                    {{ old('contract_type', $policy->contract_type ?? '') === $type ? 'selected' : '' }}>
                    {{ $type }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Συμβαλλόμενος</label>
        <select name="policyholder_id" class="form-select" required>
            <option value="">— Επιλογή πελάτη —</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}"
                    {{ old('policyholder_id', $policy->policyholder_id ?? '') == $customer->id ? 'selected' : '' }}>
                    {{ $customer->full_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Εταιρία (για ομαδικό)</label>
        <select name="company_id" class="form-select">
            <option value="">— Καμία —</option>
            @foreach($companies as $company)
                <option value="{{ $company->id }}"
                    {{ old('company_id', $policy->company_id ?? '') == $company->id ? 'selected' : '' }}>
                    {{ $company->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Είδος συμβολαίου</label>
        <select name="policy_kind" class="form-select" required>
            <option value="">— Επιλογή —</option>
            @foreach($policyKinds as $kind)
                <option value="{{ $kind }}"
                    {{ old('policy_kind', $policy->policy_kind ?? '') === $kind ? 'selected' : '' }}>
                    {{ $kind }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label">Πληρωμή κάθε πότε</label>
        <select name="payment_frequency" class="form-select" required>
            <option value="">— Επιλογή —</option>
            @foreach($paymentFrequencies as $freq)
                <option value="{{ $freq }}"
                    {{ old('payment_frequency', $policy->payment_frequency ?? '') === $freq ? 'selected' : '' }}>
                    {{ $freq }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label">Καθαρή αξία (€)</label>
        <input type="number" name="net_value" step="0.01" min="0"
               class="form-control"
               value="{{ old('net_value', $policy->net_value ?? '') }}">
    </div>

    <div class="col-md-3 d-flex align-items-center">
        <div class="form-check mt-3">
            <input type="checkbox" name="is_signed" id="is_signed" value="1"
                   class="form-check-input"
                   {{ old('is_signed', $policy->is_signed ?? false) ? 'checked' : '' }}>
            <label for="is_signed" class="form-check-label">Υπογεγραμμένο</label>
        </div>
    </div>

    <div class="col-md-3">
        <label class="form-label">Ημ/νία υπογραφής</label>
        <input type="date" name="signed_at" class="form-control"
               value="{{ old('signed_at',
                         isset($policy->signed_at) ? $policy->signed_at->format('Y-m-d') : '') }}">
    </div>

    <div class="col-12">
        <label class="form-label">Ασφαλιζόμενοι (περισσότεροι από ένας)</label>
        <select name="insured_ids[]" class="form-select" multiple size="5">
            @php
                $oldInsured = old('insured_ids', $selectedInsuredIds ?? []);
            @endphp
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}"
                    {{ in_array($customer->id, $oldInsured ?? []) ? 'selected' : '' }}>
                    {{ $customer->full_name }}
                </option>
            @endforeach
        </select>
        <div class="form-text">
            Κράτα πατημένο Ctrl (σε υπολογιστή) για πολλαπλή επιλογή.
        </div>
    </div>
</div>
