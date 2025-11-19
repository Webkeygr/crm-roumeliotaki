@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Πελάτης</label>
        <select name="customer_id"
                class="form-select @error('customer_id') is-invalid @enderror"
                required>
            <option value="">— Επιλογή πελάτη —</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}"
                    {{ old('customer_id', $appointment->customer_id ?? null) == $customer->id ? 'selected' : '' }}>
                    {{ $customer->full_name }}
                </option>
            @endforeach
        </select>
        @error('customer_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Λόγος ραντεβού</label>
        <select name="reason"
                class="form-select @error('reason') is-invalid @enderror"
                required>
            <option value="">— Επιλογή λόγου —</option>
            @foreach($reasons as $reason)
                <option value="{{ $reason }}"
                    {{ old('reason', $appointment->reason ?? null) === $reason ? 'selected' : '' }}>
                    {{ $reason }}
                </option>
            @endforeach
        </select>
        @error('reason')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Συγκεκριμένος λόγος / σημειώσεις</label>
        <textarea name="reason_detail" rows="3"
                  class="form-control @error('reason_detail') is-invalid @enderror">{{ old('reason_detail', $appointment->reason_detail ?? '') }}</textarea>
        @error('reason_detail')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3">
        <label class="form-label">Ημερομηνία</label>
        <input type="date" name="date"
               class="form-control @error('date') is-invalid @enderror"
               value="{{ old('date', isset($appointment->date) ? $appointment->date->format('Y-m-d') : '') }}"
               required>
        @error('date')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3">
        <label class="form-label">Ώρα</label>
        <input type="time" name="time"
               class="form-control @error('time') is-invalid @enderror"
               value="{{ old('time', isset($appointment->time) ? $appointment->time->format('H:i') : '') }}"
               required>
        @error('time')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Μέρος</label>
        <input type="text" name="location"
               class="form-control @error('location') is-invalid @enderror"
               value="{{ old('location', $appointment->location ?? '') }}">
        @error('location')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Κατάσταση</label>
        <select name="status"
                class="form-select @error('status') is-invalid @enderror"
                required>
            @foreach($statuses as $status)
                <option value="{{ $status }}"
                    {{ old('status', $appointment->status ?? 'Σε αναμονή απάντησης') === $status ? 'selected' : '' }}>
                    {{ $status }}
                </option>
            @endforeach
        </select>
        @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Ασφαλιστική εταιρία</label>
        <select name="insurance_company"
                class="form-select @error('insurance_company') is-invalid @enderror">
            <option value="">— Καμία / δεν ορίστηκε —</option>
            @foreach($companies as $company)
                <option value="{{ $company }}"
                    {{ old('insurance_company', $appointment->insurance_company ?? null) === $company ? 'selected' : '' }}>
                    {{ $company }}
                </option>
            @endforeach
        </select>
        @error('insurance_company')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mt-4 d-flex justify-content-end gap-2">
    <a href="{{ route('appointments.index') }}" class="btn btn-outline-light">
        Άκυρο
    </a>
    <button type="submit" class="btn btn-key">
        Αποθήκευση
    </button>
</div>
