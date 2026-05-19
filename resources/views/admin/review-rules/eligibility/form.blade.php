<div class="card">
  <div class="card-body">
    <div class="row">

      <div class="col-md-6 mb-3">
        <label class="form-label">المسار</label>
        <select name="track_id" class="form-select">
          <option value="">اختر المسار</option>
          @foreach($tracks as $track)
            <option value="{{ $track->id }}" {{ old('track_id', $eligibilityRule->track_id ?? '') == $track->id ? 'selected' : '' }}>
              {{ $track->title }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">المصدر</label>
        <select name="source" class="form-select">
          <option value="applicant" {{ old('source', $eligibilityRule->source ?? '') == 'applicant' ? 'selected' : '' }}>بيانات المتقدم</option>
          <option value="answer" {{ old('source', $eligibilityRule->source ?? 'answer') == 'answer' ? 'selected' : '' }}>إجابات النموذج</option>
          <option value="track" {{ old('source', $eligibilityRule->source ?? '') == 'track' ? 'selected' : '' }}>بيانات المسار</option>
        </select>
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">الحالة</label>
        <select name="is_active" class="form-select">
          <option value="1" {{ old('is_active', $eligibilityRule->is_active ?? 1) == 1 ? 'selected' : '' }}>نشط</option>
          <option value="0" {{ old('is_active', $eligibilityRule->is_active ?? 1) == 0 ? 'selected' : '' }}>غير نشط</option>
        </select>
      </div>

      <div class="col-md-4 mb-3">
        <label class="form-label">اسم الحقل</label>
        <input type="text"
               name="field_name"
               value="{{ old('field_name', $eligibilityRule->field_name ?? '') }}"
               class="form-control"
               placeholder="مثال: training_commitment">
      </div>

      <div class="col-md-2 mb-3">
        <label class="form-label">المعامل</label>
        <select name="operator" class="form-select">
          @foreach(['=','!=','>','>=','<','<=','in','not_in'] as $operator)
            <option value="{{ $operator }}" {{ old('operator', $eligibilityRule->operator ?? '=') == $operator ? 'selected' : '' }}>
              {{ $operator }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">القيمة المتوقعة</label>
        <textarea name="expected_value"
                  rows="4"
                  class="form-control"
                  placeholder="كل قيمة في سطر">{{ old('expected_value', isset($eligibilityRule) ? implode("\n", $eligibilityRule->expected_value ?? []) : '') }}</textarea>
      </div>

      <div class="col-md-12 mb-3">
        <label class="form-label">رسالة الفشل</label>
        <input type="text"
               name="failure_message"
               value="{{ old('failure_message', $eligibilityRule->failure_message ?? '') }}"
               class="form-control"
               placeholder="مثال: المتقدم غير مستعد للالتزام بالتدريب">
      </div>

    </div>
  </div>

  <div class="card-footer text-end">
    <a href="{{ route('admin.eligibility-rules.index') }}" class="btn btn-light">رجوع</a>
    <button class="btn btn-primary">{{ $button ?? 'حفظ' }}</button>
  </div>
</div>
