@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Όνομα</label>
        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
               value="{{ old('first_name', $customer->first_name ?? '') }}" required>
        @error('first_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Επώνυμο</label>
        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
               value="{{ old('last_name', $customer->last_name ?? '') }}" required>
        @error('last_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Διεύθυνση</label>
        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
               value="{{ old('address', $customer->address ?? '') }}">
        @error('address')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Ημ. γέννησης</label>
        <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror"
               value="{{ old('birth_date', isset($customer->birth_date) ? $customer->birth_date->format('Y-m-d') : '') }}">
        @error('birth_date')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Σταθερό</label>
        <input type="text" name="phone_landline" class="form-control @error('phone_landline') is-invalid @enderror"
               value="{{ old('phone_landline', $customer->phone_landline ?? '') }}">
        @error('phone_landline')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Κινητό</label>
        <input type="text" name="phone_mobile" class="form-control @error('phone_mobile') is-invalid @enderror"
               value="{{ old('phone_mobile', $customer->phone_mobile ?? '') }}">
        @error('phone_mobile')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Οικογενειακή κατάσταση</label>
        <input type="text" name="marital_status" class="form-control @error('marital_status') is-invalid @enderror"
               placeholder="π.χ. Έγγαμος, Άγαμος"
               value="{{ old('marital_status', $customer->marital_status ?? '') }}">
        @error('marital_status')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Ρόλος στην οικογένεια</label>
        <input type="text" name="role_in_family" class="form-control @error('role_in_family') is-invalid @enderror"
               placeholder="π.χ. Πατέρας, Μητέρα, Παιδί"
               value="{{ old('role_in_family', $customer->role_in_family ?? '') }}">
        @error('role_in_family')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Εταιρία (εργοδότης)</label>
        <select name="company_id" class="form-select @error('company_id') is-invalid @enderror">
            <option value="">— Καμία —</option>
            @foreach($companies as $company)
                <option value="{{ $company->id }}"
                    {{ old('company_id', $customer->company_id ?? null) == $company->id ? 'selected' : '' }}>
                    {{ $company->name }}
                </option>
            @endforeach
        </select>
        @error('company_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mt-4 d-flex justify-content-end gap-2">
    <a href="{{ route('customers.index') }}" class="btn btn-outline-light">
        Άκυρο
    </a>
    <button type="submit" class="btn btn-key">
        Αποθήκευση
    </button>
</div>
