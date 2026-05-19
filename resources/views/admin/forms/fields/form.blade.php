<div class="card">
  <div class="card-body">
    <div class="row">

      <input type="hidden" name="form_id" value="{{ $form->id }}">

      <div class="col-md-6 mb-3">
        <label class="form-label">القسم</label>
        <select name="form_section_id" class="form-select">
          <option value="">بدون قسم</option>
          @foreach($form->sections as $section)
            <option value="{{ $section->id }}"
              {{ old('form_section_id', $formField->form_section_id ?? '') == $section->id ? 'selected' : '' }}>
              {{ $section->title }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">عنوان الحقل</label>
        <input type="text" name="label" value="{{ old('label', $formField->label ?? '') }}" class="form-control">
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">اسم الحقل البرمجي</label>
        <input type="text" name="name" value="{{ old('name', $formField->name ?? '') }}" class="form-control">
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">نوع الحقل</label>
        <select name="type" class="form-select">
          @foreach(['text','textarea','number','date','select','radio','checkbox','file'] as $type)
            <option value="{{ $type }}" {{ old('type', $formField->type ?? '') == $type ? 'selected' : '' }}>
              {{ $type }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">Placeholder</label>
        <input type="text" name="placeholder" value="{{ old('placeholder', $formField->placeholder ?? '') }}" class="form-control">
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">عرض الحقل</label>
        <select name="width" class="form-select">
          @foreach([3,4,6,8,12] as $width)
            <option value="{{ $width }}" {{ old('width', $formField->width ?? 12) == $width ? 'selected' : '' }}>
              {{ $width }}/12
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-12 mb-3">
        <label class="form-label">الخيارات</label>
        <textarea name="options_text" rows="5" class="form-control"
                  placeholder="كل خيار في سطر">{{ old('options_text', isset($formField) && $formField->options ? implode("\n", $formField->options) : '') }}</textarea>
        <small class="text-muted">تستخدم فقط مع select / radio / checkbox</small>
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">Validation Rules</label>
        <input type="text" name="validation_rules" value="{{ old('validation_rules', $formField->validation_rules ?? '') }}" class="form-control" placeholder="max:255">
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">الترتيب</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $formField->sort_order ?? 0) }}" class="form-control">
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">الحالة</label>
        <select name="status" class="form-select">
          <option value="1" {{ old('status', $formField->status ?? 1) == 1 ? 'selected' : '' }}>نشط</option>
          <option value="0" {{ old('status', $formField->status ?? 1) == 0 ? 'selected' : '' }}>غير نشط</option>
        </select>
      </div>

      <div class="col-md-12 mb-3">
        <label class="form-check">
          <input type="checkbox" name="is_required" value="1" class="form-check-input"
                 {{ old('is_required', $formField->is_required ?? false) ? 'checked' : '' }}>
          <span class="form-check-label">الحقل إلزامي</span>
        </label>
      </div>

    </div>
  </div>

  <div class="card-footer text-end">
    <a href="{{ route('admin.forms.builder', $form) }}" class="btn btn-light">رجوع</a>
    <button class="btn btn-primary">{{ $button ?? 'حفظ' }}</button>
  </div>
</div>
