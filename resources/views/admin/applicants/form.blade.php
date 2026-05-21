<div class="card mb-3">
  <div class="card-header">
    <h3 class="card-title">البيانات الأساسية</h3>
  </div>

  <div class="card-body">
    <div class="row">

      <div class="col-md-6 mb-3">
        <label class="form-label">الاسم الرباعي</label>
        <input type="text"
               name="full_name"
               value="{{ old('full_name', $applicant->full_name ?? '') }}"
               class="form-control @error('full_name') is-invalid @enderror">
        @error('full_name')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">رقم الهوية</label>
        <input type="text"
               name="national_id"
               value="{{ old('national_id', $applicant->national_id ?? '') }}"
               class="form-control @error('national_id') is-invalid @enderror">
        @error('national_id')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">الجنس</label>
        <select name="gender" class="form-select @error('gender') is-invalid @enderror">
          <option value="">اختر</option>
          <option value="male" {{ old('gender', $applicant->gender ?? '') == 'male' ? 'selected' : '' }}>ذكر</option>
          <option value="female" {{ old('gender', $applicant->gender ?? '') == 'female' ? 'selected' : '' }}>أنثى</option>
        </select>
        @error('gender')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">الحالة الاجتماعية</label>
        <select name="marital_status" class="form-select">
          <option value="">اختر</option>
          <option value="husband" {{ old('marital_status', $applicant->marital_status ?? '') == 'husband' ? 'selected' : '' }}>الزوج</option>
          <option value="single" {{ old('marital_status', $applicant->marital_status ?? '') == 'single' ? 'selected' : '' }}>أعزب</option>
          <option value="widow" {{ old('marital_status', $applicant->marital_status ?? '') == 'widow' ? 'selected' : '' }}>أرملة</option>
          <option value="divorced" {{ old('marital_status', $applicant->marital_status ?? '') == 'divorced' ? 'selected' : '' }}>مطلقة</option>
          <option value="other" {{ old('marital_status', $applicant->marital_status ?? '') == 'other' ? 'selected' : '' }}>أخرى</option>
        </select>
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">رقم تواصل 1</label>
        <input type="text"
               name="phone_1"
               value="{{ old('phone_1', $applicant->phone_1 ?? '') }}"
               class="form-control @error('phone_1') is-invalid @enderror">
        @error('phone_1')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">رقم تواصل 2</label>
        <input type="text"
               name="phone_2"
               value="{{ old('phone_2', $applicant->phone_2 ?? '') }}"
               class="form-control">
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">تاريخ الميلاد</label>
        <input type="date"
               name="birth_date"
               value="{{ old('birth_date', isset($applicant) && $applicant->birth_date ? $applicant->birth_date->format('Y-m-d') : '') }}"
               class="form-control">
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-label">الحالة</label>
        <select name="is_active" class="form-select">
          <option value="1" {{ old('is_active', $applicant->is_active ?? 1) == 1 ? 'selected' : '' }}>نشط</option>
          <option value="0" {{ old('is_active', $applicant->is_active ?? 1) == 0 ? 'selected' : '' }}>غير نشط</option>
        </select>
      </div>

    </div>
  </div>
</div>

<div class="card mb-3">
  <div class="card-header">
    <h3 class="card-title">بيانات السكن والأسرة</h3>
  </div>

  <div class="card-body">
    <div class="row">

      <div class="col-md-4 mb-3">
        <label class="form-label">المحافظة الحالية</label>
        <select name="governorate_id" class="form-select">
          <option value="">اختر</option>
          @foreach($governorates as $governorate)
            <option value="{{ $governorate->id }}" {{ old('governorate_id', $applicant->governorate_id ?? '') == $governorate->id ? 'selected' : '' }}>
              {{ $governorate->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-4 mb-3">
        <label class="form-label">الإقامة</label>
        <select name="displacement_status" class="form-select">
          <option value="">اختر</option>
          <option value="resident" {{ old('displacement_status', $applicant->displacement_status ?? '') == 'resident' ? 'selected' : '' }}>مقيم</option>
          <option value="displaced" {{ old('displacement_status', $applicant->displacement_status ?? '') == 'displaced' ? 'selected' : '' }}>نازح</option>
        </select>
      </div>

      <div class="col-md-4 mb-3">
        <label class="form-label">مكان الإقامة الحالي</label>
        <select name="residence_type_id" class="form-select">
          <option value="">اختر</option>
          @foreach($residenceTypes as $type)
            <option value="{{ $type->id }}" {{ old('residence_type_id', $applicant->residence_type_id ?? '') == $type->id ? 'selected' : '' }}>
              {{ $type->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-12 mb-3">
        <label class="form-label">عنوان السكن الحالي بالتفصيل</label>
        <textarea name="current_address"
                  rows="3"
                  class="form-control">{{ old('current_address', $applicant->current_address ?? '') }}</textarea>
      </div>

      <div class="col-md-4 mb-3">
        <label class="form-label">عدد أفراد الأسرة</label>
        <input type="number"
               name="family_members_count"
               value="{{ old('family_members_count', $applicant->family_members_count ?? '') }}"
               class="form-control">
      </div>

      <div class="col-md-4 mb-3">
        <label class="form-label">معيل الأسرة</label>
        <select name="breadwinner_status" class="form-select">
          <option value="">اختر</option>
          <option value="husband" {{ old('breadwinner_status', $applicant->breadwinner_status ?? '') == 'husband' ? 'selected' : '' }}>الزوج</option>
          <option value="single" {{ old('breadwinner_status', $applicant->breadwinner_status ?? '') == 'single' ? 'selected' : '' }}>أعزب</option>
          <option value="widow" {{ old('breadwinner_status', $applicant->breadwinner_status ?? '') == 'widow' ? 'selected' : '' }}>أرملة</option>
          <option value="divorced" {{ old('breadwinner_status', $applicant->breadwinner_status ?? '') == 'divorced' ? 'selected' : '' }}>مطلقة</option>
          <option value="other" {{ old('breadwinner_status', $applicant->breadwinner_status ?? '') == 'other' ? 'selected' : '' }}>أخرى</option>
        </select>
      </div>

    </div>
  </div>
</div>

<div class="card mb-3">
  <div class="card-header">
    <h3 class="card-title">البيانات الاقتصادية والتعليمية والصحية</h3>
  </div>

  <div class="card-body">
    <div class="row">

      <div class="col-md-4 mb-3">
        <label class="form-label">حالة العمل</label>
        <select name="employment_status" class="form-select">
          <option value="">اختر</option>
          <option value="employed" {{ old('employment_status', $applicant->employment_status ?? '') == 'employed' ? 'selected' : '' }}>يعمل / تعمل</option>
          <option value="unemployed" {{ old('employment_status', $applicant->employment_status ?? '') == 'unemployed' ? 'selected' : '' }}>لا يعمل / لا تعمل</option>
        </select>
      </div>

      <div class="col-md-4 mb-3">
        <label class="form-label">مستوى الدخل</label>
        <select name="income_type_id" class="form-select">
          <option value="">اختر</option>
          @foreach($incomeTypes as $type)
            <option value="{{ $type->id }}" {{ old('income_type_id', $applicant->income_type_id ?? '') == $type->id ? 'selected' : '' }}>
              {{ $type->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-4 mb-3">
        <label class="form-label">المستوى التعليمي</label>
        <select name="education_level" class="form-select">
          <option value="">اختر</option>
          <option value="none" {{ old('education_level', $applicant->education_level ?? '') == 'none' ? 'selected' : '' }}>بدون</option>
          <option value="preparatory" {{ old('education_level', $applicant->education_level ?? '') == 'preparatory' ? 'selected' : '' }}>شهادة ثالث إعدادي</option>
          <option value="secondary" {{ old('education_level', $applicant->education_level ?? '') == 'secondary' ? 'selected' : '' }}>ثانوية عامة</option>
          <option value="diploma" {{ old('education_level', $applicant->education_level ?? '') == 'diploma' ? 'selected' : '' }}>دبلوم</option>
          <option value="bachelor" {{ old('education_level', $applicant->education_level ?? '') == 'bachelor' ? 'selected' : '' }}>بكالوريوس</option>
          <option value="master_or_above" {{ old('education_level', $applicant->education_level ?? '') == 'master_or_above' ? 'selected' : '' }}>ماجستير فأعلى</option>
        </select>
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">التخصص</label>
        <input type="text"
               name="specialization"
               value="{{ old('specialization', $applicant->specialization ?? '') }}"
               class="form-control">
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">الوضع الصحي</label>
        <select name="health_status" class="form-select">
          <option value="">اختر</option>
          <option value="healthy" {{ old('health_status', $applicant->health_status ?? '') == 'healthy' ? 'selected' : '' }}>سليم / سليمة</option>
          <option value="disabled" {{ old('health_status', $applicant->health_status ?? '') == 'disabled' ? 'selected' : '' }}>ذوي إعاقة</option>
        </select>
      </div>

    </div>
  </div>
</div>

<div class="card mb-3">
  <div class="card-header">
    <h3 class="card-title">المرفقات</h3>
  </div>

  <div class="card-body">
    <div class="row">

      <div class="col-md-4 mb-3">
        <label class="form-label">صورة الهوية</label>
        <input type="file" name="identity_image" class="form-control">
        @if(isset($applicant) && $applicant->identity_image)
          <a href="{{ asset('storage/'.$applicant->identity_image) }}" target="_blank" class="btn btn-link mt-2">
            عرض الملف الحالي
          </a>
        @endif
      </div>

      <div class="col-md-4 mb-3">
        <label class="form-label">التقرير الطبي</label>
        <input type="file" name="medical_report" class="form-control">
        @if(isset($applicant) && $applicant->medical_report)
          <a href="{{ asset('storage/'.$applicant->medical_report) }}" target="_blank" class="btn btn-link mt-2">
            عرض الملف الحالي
          </a>
        @endif
      </div>

      <div class="col-md-4 mb-3">
        <label class="form-label">الشهادة العلمية</label>
        <input type="file" name="education_certificate" class="form-control">
        @if(isset($applicant) && $applicant->education_certificate)
          <a href="{{ asset('storage/'.$applicant->education_certificate) }}" target="_blank" class="btn btn-link mt-2">
            عرض الملف الحالي
          </a>
        @endif
      </div>

      <div class="col-md-12 mb-3">
        <label class="form-label">ملاحظات</label>
        <textarea name="notes"
                  rows="3"
                  class="form-control">{{ old('notes', $applicant->notes ?? '') }}</textarea>
      </div>

    </div>
  </div>

  <div class="card-footer text-end">
    <a href="{{ route('admin.applicants.index') }}" class="btn btn-light">رجوع</a>
    <button class="btn btn-primary">{{ $button ?? 'حفظ' }}</button>
  </div>
</div>
