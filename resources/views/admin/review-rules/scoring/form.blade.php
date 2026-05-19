<div class="card">
  <div class="card-body">
    <div class="row">

      <div class="col-md-6 mb-3">
        <label class="form-label">المسار</label>
        <select name="track_id" class="form-select">
          <option value="">اختر المسار</option>
          @foreach($tracks as $track)
            <option value="{{ $track->id }}" {{ old('track_id', $scoringRule->track_id ?? '') == $track->id ? 'selected' : '' }}>
              {{ $track->title }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">المصدر</label>
        <select name="source" class="form-select">
          <option value="applicant" {{ old('source', $scoringRule->source ?? '') == 'applicant' ? 'selected' : '' }}>بيانات المتقدم</option>
          <option value="answer" {{ old('source', $scoringRule->source ?? 'answer') == 'answer' ? 'selected' : '' }}>إجابات النموذج</option>
          <option value="track" {{ old('source', $scoringRule->source ?? '') == 'track' ? 'selected' : '' }}>بيانات المسار</option>
        </select>
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">الحالة</label>
        <select name="is_active" class="form-select">
          <option value="1" {{ old('is_active', $scoringRule->is_active ?? 1) == 1 ? 'selected' : '' }}>نشط</option>
          <option value="0" {{ old('is_active', $scoringRule->is_active ?? 1) == 0 ? 'selected' : '' }}>غير نشط</option>
        </select>
      </div>

      <div class="col-md-4 mb-3">
        <label class="form-label">اسم الحقل</label>
        <input type="text"
               name="field_name"
               value="{{ old('field_name', $scoringRule->field_name ?? '') }}"
               class="form-control"
               placeholder="مثال: monthly_income">
      </div>

      <div class="col-md-2 mb-3">
        <label class="form-label">المعامل</label>
        <select name="operator" class="form-select">
          @foreach(['=','!=','>','>=','<','<=','in','not_in'] as $operator)
            <option value="{{ $operator }}" {{ old('operator', $scoringRule->operator ?? '=') == $operator ? 'selected' : '' }}>
              {{ $operator }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">النقاط</label>
        <input type="number"
               name="score"
               value="{{ old('score', $scoringRule->score ?? 0) }}"
               class="form-control">
      </div>

      <div class="col-md-12 mb-3">
        <label class="form-label">القيمة المتوقعة</label>
        <textarea name="expected_value"
                  rows="4"
                  class="form-control"
                  placeholder="كل قيمة في سطر">{{ old('expected_value', isset($scoringRule) ? implode("\n", $scoringRule->expected_value ?? []) : '') }}</textarea>
      </div>

    </div>
  </div>

  <div class="card-footer text-end">
    <a href="{{ route('admin.scoring-rules.index') }}" class="btn btn-light">رجوع</a>
    <button class="btn btn-primary">{{ $button ?? 'حفظ' }}</button>
  </div>
</div>
