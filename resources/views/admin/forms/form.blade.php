<div class="card">
  <div class="card-body">
    <div class="row">

      @if(!isset($form))
      <div class="col-md-6 mb-3">
        <label class="form-label">المسار</label>
        <select name="track_id" class="form-select">
          <option value="">اختر المسار</option>
          @foreach($tracks as $track)
            <option value="{{ $track->id }}" {{ old('track_id') == $track->id ? 'selected' : '' }}>
              {{ $track->title }}
            </option>
          @endforeach
        </select>
      </div>
      @endif

      <div class="col-md-6 mb-3">
        <label class="form-label">عنوان النموذج</label>
        <input type="text" name="title" value="{{ old('title', $form->title ?? '') }}" class="form-control">
      </div>

      <div class="col-md-12 mb-3">
        <label class="form-label">الوصف</label>
        <textarea name="description" rows="4" class="form-control">{{ old('description', $form->description ?? '') }}</textarea>
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">متعدد الخطوات</label>
        <select name="is_multi_step" class="form-select">
          <option value="1" {{ old('is_multi_step', $form->is_multi_step ?? 1) == 1 ? 'selected' : '' }}>نعم</option>
          <option value="0" {{ old('is_multi_step', $form->is_multi_step ?? 1) == 0 ? 'selected' : '' }}>لا</option>
        </select>
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">الحالة</label>
        <select name="status" class="form-select">
          <option value="1" {{ old('status', $form->status ?? 1) == 1 ? 'selected' : '' }}>نشط</option>
          <option value="0" {{ old('status', $form->status ?? 1) == 0 ? 'selected' : '' }}>غير نشط</option>
        </select>
      </div>

    </div>
  </div>

  <div class="card-footer text-end">
    <a href="{{ route('admin.forms.index') }}" class="btn btn-light">رجوع</a>
    <button class="btn btn-primary">{{ $button ?? 'حفظ' }}</button>
  </div>
</div>
