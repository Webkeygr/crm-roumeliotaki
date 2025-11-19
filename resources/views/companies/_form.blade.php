@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Επωνυμία εταιρίας</label>
        <input type="text" name="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $company->name ?? '') }}" required>
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Αντικείμενο δραστηριότητας</label>
        <input type="text" name="business_activity"
               class="form-control @error('business_activity') is-invalid @enderror"
               value="{{ old('business_activity', $company->business_activity ?? '') }}">
        @error('business_activity')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Δυναμικό (ακριβές)</label>
        <input type="number" name="staff_size_exact"
               class="form-control @error('staff_size_exact') is-invalid @enderror"
               value="{{ old('staff_size_exact', $company->staff_size_exact ?? '') }}">
        @error('staff_size_exact')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Δυναμικό από</label>
        <input type="number" name="staff_size_range_from"
               class="form-control @error('staff_size_range_from') is-invalid @enderror"
               value="{{ old('staff_size_range_from', $company->staff_size_range_from ?? '') }}">
        @error('staff_size_range_from')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Δυναμικό έως</label>
        <input type="number" name="staff_size_range_to"
               class="form-control @error('staff_size_range_to') is-invalid @enderror"
               value="{{ old('staff_size_range_to', $company->staff_size_range_to ?? '') }}">
        @error('staff_size_range_to')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Σημειώσεις</label>
        <textarea name="notes" rows="3"
                  class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $company->notes ?? '') }}</textarea>
        @error('notes')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mt-4 d-flex justify-content-end gap-2">
    <a href="{{ route('companies.index') }}" class="btn btn-outline-light">
        Άκυρο
    </a>
    <button type="submit" class="btn btn-key">
        Αποθήκευση
    </button>
</div>
