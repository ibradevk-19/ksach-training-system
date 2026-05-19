<div class="card">
  <div class="card-body">
    <div class="row">

      <div class="col-md-6 mb-3">
        <label class="form-label">اسم النوع</label>
        <input type="text"
               name="name"
               value="{{ old('name', $trackType->name ?? '') }}"
               class="form-control @error('name') is-invalid @enderror">
        @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">الأيقونة</label>
        <input type="text"
               name="icon"
               value="{{ old('icon', $trackType->icon ?? '') }}"
               class="form-control"
               placeholder="ti ti-school">
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">اللون</label>
        <input type="color"
               name="color"
               value="{{ old('color', $trackType->color ?? '#206bc4') }}"
               class="form-control form-control-color">
      </div>

      <div class="col-md-12 mb-3">
        <label class="form-label">الوصف</label>
        <textarea name="description"
                  rows="4"
                  class="form-control">{{ old('description', $trackType->description ?? '') }}</textarea>
      </div>

      <div class="col-md-4 mb-3">
        <label class="form-label">الحالة</label>
        <select name="status" class="form-select">
          <option value="1" {{ old('status', $trackType->status ?? 1) == 1 ? 'selected' : '' }}>نشط</option>
          <option value="0" {{ old('status', $trackType->status ?? 1) == 0 ? 'selected' : '' }}>غير نشط</option>
        </select>
      </div>

    </div>
  </div>

  <div class="card-footer text-end">
    <a href="{{ route('admin.track-types.index') }}" class="btn btn-light">رجوع</a>
    <button class="btn btn-primary">{{ $button ?? 'حفظ' }}</button>
  </div>
</div>
