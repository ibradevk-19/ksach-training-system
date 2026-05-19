<div class="card mb-3">
  <div class="card-header">
    <h3 class="card-title">البيانات الأساسية</h3>
  </div>

  <div class="card-body">
    <div class="row">

      <div class="col-md-6 mb-3">
        <label class="form-label">اسم المسار</label>
        <input type="text"
               name="title"
               value="{{ old('title', $track->title ?? '') }}"
               class="form-control @error('title') is-invalid @enderror">
        @error('title')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">نوع المسار</label>
        <select name="track_type_id" class="form-select">
          <option value="">اختر</option>
          @foreach($types as $type)
            <option value="{{ $type->id }}" {{ old('track_type_id', $track->track_type_id ?? '') == $type->id ? 'selected' : '' }}>
              {{ $type->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">التصنيف</label>
        <select name="track_category_id" class="form-select">
          <option value="">اختر</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('track_category_id', $track->track_category_id ?? '') == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-12 mb-3">
        <label class="form-label">وصف مختصر</label>
        <textarea name="short_description"
                  rows="2"
                  class="form-control">{{ old('short_description', $track->short_description ?? '') }}</textarea>
      </div>

      <div class="col-md-12 mb-3">
        <label class="form-label">الوصف الكامل</label>
        <textarea name="description"
                  rows="6"
                  class="form-control">{{ old('description', $track->description ?? '') }}</textarea>
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">صورة المسار</label>
        <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror">
        @error('thumbnail')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if(isset($track) && $track->thumbnail)
          <div class="mt-2">
            <img src="{{ asset('storage/'.$track->thumbnail) }}" style="max-height: 120px" class="rounded">
          </div>
        @endif
      </div>

    </div>
  </div>
</div>

<div class="card mb-3">
  <div class="card-header">
    <h3 class="card-title">إعدادات التسجيل والتدريب</h3>
  </div>

  <div class="card-body">
    <div class="row">

      <div class="col-md-3 mb-3">
        <label class="form-label">تاريخ بداية التدريب</label>
        <input type="date"
               name="start_date"
               value="{{ old('start_date', isset($track) && $track->start_date ? $track->start_date->format('Y-m-d') : '') }}"
               class="form-control">
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">تاريخ نهاية التدريب</label>
        <input type="date"
               name="end_date"
               value="{{ old('end_date', isset($track) && $track->end_date ? $track->end_date->format('Y-m-d') : '') }}"
               class="form-control">
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">بداية التسجيل</label>
        <input type="date"
               name="registration_start"
               value="{{ old('registration_start', isset($track) && $track->registration_start ? $track->registration_start->format('Y-m-d') : '') }}"
               class="form-control">
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">نهاية التسجيل</label>
        <input type="date"
               name="registration_end"
               value="{{ old('registration_end', isset($track) && $track->registration_end ? $track->registration_end->format('Y-m-d') : '') }}"
               class="form-control">
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">عدد المقاعد</label>
        <input type="number"
               name="seats"
               min="0"
               value="{{ old('seats', $track->seats ?? 0) }}"
               class="form-control @error('seats') is-invalid @enderror">
        @error('seats')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">الجنس</label>
        <select name="gender" class="form-select">
          <option value="both" {{ old('gender', $track->gender ?? 'both') == 'both' ? 'selected' : '' }}>الكل</option>
          <option value="male" {{ old('gender', $track->gender ?? '') == 'male' ? 'selected' : '' }}>ذكور فقط</option>
          <option value="female" {{ old('gender', $track->gender ?? '') == 'female' ? 'selected' : '' }}>إناث فقط</option>
        </select>
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">أقل عمر</label>
        <input type="number"
               name="min_age"
               value="{{ old('min_age', $track->min_age ?? '') }}"
               class="form-control">
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">أعلى عمر</label>
        <input type="number"
               name="max_age"
               value="{{ old('max_age', $track->max_age ?? '') }}"
               class="form-control">
      </div>

    </div>
  </div>
</div>

<div class="card mb-3">
  <div class="card-header">
    <h3 class="card-title">إعدادات النشر والمراجعة</h3>
  </div>

  <div class="card-body">
    <div class="row">

      <div class="col-md-3 mb-3">
        <label class="form-label">حالة المسار</label>
        <select name="status" class="form-select">
          <option value="draft" {{ old('status', $track->status ?? 'draft') == 'draft' ? 'selected' : '' }}>مسودة</option>
          <option value="published" {{ old('status', $track->status ?? '') == 'published' ? 'selected' : '' }}>منشور</option>
          <option value="closed" {{ old('status', $track->status ?? '') == 'closed' ? 'selected' : '' }}>مغلق</option>
          <option value="archived" {{ old('status', $track->status ?? '') == 'archived' ? 'selected' : '' }}>مؤرشف</option>
        </select>
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">قائمة الانتظار</label>
        <label class="form-check form-switch">
          <input class="form-check-input"
                 type="checkbox"
                 name="allow_waiting_list"
                 value="1"
                 {{ old('allow_waiting_list', $track->allow_waiting_list ?? true) ? 'checked' : '' }}>
          <span class="form-check-label">تفعيل قائمة الانتظار</span>
        </label>
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">المراجعة</label>
        <label class="form-check form-switch">
          <input class="form-check-input"
                 type="checkbox"
                 name="requires_review"
                 value="1"
                 {{ old('requires_review', $track->requires_review ?? true) ? 'checked' : '' }}>
          <span class="form-check-label">يتطلب مراجعة</span>
        </label>
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">تمييز المسار</label>
        <label class="form-check form-switch">
          <input class="form-check-input"
                 type="checkbox"
                 name="is_featured"
                 value="1"
                 {{ old('is_featured', $track->is_featured ?? false) ? 'checked' : '' }}>
          <span class="form-check-label">مسار مميز</span>
        </label>
      </div>

    </div>
  </div>

  <div class="card-footer text-end">
    <a href="{{ route('admin.tracks.index') }}" class="btn btn-light">رجوع</a>
    <button class="btn btn-primary">{{ $button ?? 'حفظ' }}</button>
  </div>
</div>
