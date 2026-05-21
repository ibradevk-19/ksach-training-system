@extends('layouts.app')

@php
  $genderLabels = ['male' => 'ذكر', 'female' => 'أنثى'];
  $displacementLabels = ['resident' => 'مقيم', 'displaced' => 'نازح'];
  $breadwinnerLabels = ['husband' => 'الزوج', 'single' => 'أعزب', 'widow' => 'أرملة', 'divorced' => 'مطلقة', 'other' => 'أخرى'];
  $employmentLabels = ['employed' => 'يعمل / تعمل', 'unemployed' => 'لا يعمل / لا تعمل'];
  $educationLabels = [
    'none' => 'بدون',
    'preparatory' => 'شهادة ثالث إعدادي',
    'secondary' => 'ثانوية عامة',
    'diploma' => 'دبلوم',
    'bachelor' => 'بكالوريوس',
    'master_or_above' => 'ماجستير فأعلى',
  ];
  $healthLabels = ['healthy' => 'سليم / سليمة', 'disabled' => 'ذوي إعاقة'];

  $value = fn ($value) => filled($value) ? $value : '-';
  $fileSize = fn ($bytes) => $bytes ? number_format($bytes / 1024, 1).' ك.ب' : '-';

  $formatAnswer = function ($answer) {
    if (! filled($answer)) {
      return '-';
    }

    $decoded = json_decode($answer, true);

    return json_last_error() === JSON_ERROR_NONE && is_array($decoded)
      ? implode('، ', $decoded)
      : $answer;
  };
@endphp

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <div class="page-pretitle">ملف المتقدم</div>
        <h2 class="page-title">{{ $applicant->full_name }}</h2>
      </div>

      <div class="col-auto d-flex gap-2">
        <a href="{{ route('admin.applicants.index') }}" class="btn btn-outline-secondary">رجوع</a>
        <a href="{{ route('admin.applicants.edit', $applicant) }}" class="btn btn-warning">تعديل</a>
      </div>
    </div>
  </div>

  @include('partials.alerts')

  <div class="row row-cards">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body text-center">
          <span class="avatar avatar-xl mb-3 rounded" style="background-color:#0f766e;color:#fff;">
            {{ mb_substr($applicant->full_name, 0, 1) }}
          </span>
          <h3 class="mb-1">{{ $applicant->full_name }}</h3>
          <div class="text-muted">{{ $applicant->national_id }}</div>
          <div class="mt-3">
            <span class="badge bg-{{ $applicant->is_active ? 'success' : 'secondary' }}">
              {{ $applicant->is_active ? 'نشط' : 'غير نشط' }}
            </span>
          </div>
        </div>
        <div class="list-group list-group-flush">
          <div class="list-group-item d-flex justify-content-between">
            <span class="text-muted">الجنس</span>
            <strong>{{ $genderLabels[$applicant->gender] ?? '-' }}</strong>
          </div>
          <div class="list-group-item d-flex justify-content-between">
            <span class="text-muted">الحالة الاجتماعية</span>
            <strong>{{ $breadwinnerLabels[$applicant->marital_status] ?? '-' }}</strong>
          </div>
          <div class="list-group-item d-flex justify-content-between">
            <span class="text-muted">رقم التواصل</span>
            <strong>{{ $applicant->phone_1 }}</strong>
          </div>
          <div class="list-group-item d-flex justify-content-between">
            <span class="text-muted">رقم بديل</span>
            <strong>{{ $value($applicant->phone_2) }}</strong>
          </div>
          <div class="list-group-item d-flex justify-content-between">
            <span class="text-muted">تاريخ الميلاد</span>
            <strong>{{ $applicant->birth_date?->format('Y-m-d') ?? '-' }}</strong>
          </div>
          <div class="list-group-item d-flex justify-content-between">
            <span class="text-muted">عدد الطلبات</span>
            <strong>{{ $applicant->applications->count() }}</strong>
          </div>
        </div>
      </div>

      <div class="card mt-3">
        <div class="card-header">
          <h3 class="card-title">المرفقات المسجلة في ملف المتقدم</h3>
        </div>
        <div class="card-body">
          <div class="btn-list">
            @if($applicant->identity_image)
              <a href="{{ asset('storage/'.$applicant->identity_image) }}" target="_blank" class="btn btn-outline-primary">صورة الهوية</a>
            @endif

            @if($applicant->medical_report)
              <a href="{{ asset('storage/'.$applicant->medical_report) }}" target="_blank" class="btn btn-outline-primary">التقرير الطبي</a>
            @endif

            @if($applicant->education_certificate)
              <a href="{{ asset('storage/'.$applicant->education_certificate) }}" target="_blank" class="btn btn-outline-primary">الشهادة العلمية</a>
            @endif

            @if(! $applicant->identity_image && ! $applicant->medical_report && ! $applicant->education_certificate)
              <div class="text-muted">لا توجد مرفقات مباشرة في ملف المتقدم.</div>
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-8">
      <div class="card mb-3">
        <div class="card-header">
          <h3 class="card-title">البيانات الشخصية والسكنية</h3>
        </div>
        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-4"><div class="text-muted">المحافظة</div><strong>{{ $applicant->governorate?->name ?? '-' }}</strong></div>
            <div class="col-md-4"><div class="text-muted">الإقامة</div><strong>{{ $displacementLabels[$applicant->displacement_status] ?? '-' }}</strong></div>
            <div class="col-md-4"><div class="text-muted">مكان الإقامة</div><strong>{{ $applicant->residenceType?->name ?? '-' }}</strong></div>
            <div class="col-md-4"><div class="text-muted">عدد أفراد الأسرة</div><strong>{{ $value($applicant->family_members_count) }}</strong></div>
            <div class="col-md-4"><div class="text-muted">معيل الأسرة</div><strong>{{ $breadwinnerLabels[$applicant->breadwinner_status] ?? '-' }}</strong></div>
            <div class="col-md-4"><div class="text-muted">الوضع الصحي</div><strong>{{ $healthLabels[$applicant->health_status] ?? '-' }}</strong></div>
            <div class="col-12"><div class="text-muted">العنوان التفصيلي</div><strong>{{ $value($applicant->current_address) }}</strong></div>
          </div>
        </div>
      </div>

      <div class="card mb-3">
        <div class="card-header">
          <h3 class="card-title">البيانات الاقتصادية والتعليمية</h3>
        </div>
        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-3"><div class="text-muted">حالة العمل</div><strong>{{ $employmentLabels[$applicant->employment_status] ?? '-' }}</strong></div>
            <div class="col-md-3"><div class="text-muted">مستوى الدخل</div><strong>{{ $applicant->incomeType?->name ?? '-' }}</strong></div>
            <div class="col-md-3"><div class="text-muted">المستوى التعليمي</div><strong>{{ $educationLabels[$applicant->education_level] ?? '-' }}</strong></div>
            <div class="col-md-3"><div class="text-muted">التخصص</div><strong>{{ $value($applicant->specialization) }}</strong></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card mt-3">
    <div class="card-header">
      <h3 class="card-title">طلبات المتقدم وبيانات النماذج</h3>
    </div>
    <div class="card-body">
      @forelse($applicant->applications as $application)
        @php
          $answersByField = $application->answers->keyBy('form_field_id');
          $filesByField = $application->files->keyBy('form_field_id');
          $sections = $application->track?->form?->sections ?? collect();
        @endphp

        <div class="border rounded p-3 mb-3">
          <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
            <div>
              <h4 class="mb-1">{{ $application->track?->title ?? 'طلب بدون مسار' }}</h4>
              <div class="text-muted">
                رقم الطلب: {{ $application->application_number }} |
                تاريخ التقديم: {{ $application->submitted_at?->format('Y-m-d H:i') ?? '-' }}
              </div>
            </div>
            <div class="d-flex gap-2 align-items-center">
              @include('admin.applications.partials.status-badge', ['status' => $application->status])
              <a href="{{ route('admin.applications.show', $application) }}" class="btn btn-sm btn-outline-primary">عرض الطلب</a>
            </div>
          </div>

          @forelse($sections as $section)
            @php
              $visibleFields = $section->fields->filter(fn ($field) => $answersByField->has($field->id) || $filesByField->has($field->id));
            @endphp

            @continue($visibleFields->isEmpty())

            <div class="mb-3">
              <div class="fw-bold border-bottom pb-2 mb-2">{{ $section->title }}</div>
              <div class="row g-3">
                @foreach($visibleFields as $field)
                  <div class="col-md-6">
                    <div class="text-muted">{{ $field->label }}</div>

                    @if($filesByField->has($field->id))
                      @php($file = $filesByField->get($field->id))
                      <a href="{{ asset('storage/'.$file->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1">
                        {{ $file->file_name }}
                      </a>
                      <div class="small text-muted mt-1">{{ $file->mime_type }} | {{ $fileSize($file->file_size) }}</div>
                    @else
                      <strong>{{ $formatAnswer($answersByField->get($field->id)?->answer) }}</strong>
                    @endif
                  </div>
                @endforeach
              </div>
            </div>
          @empty
            <div class="text-muted">لا يوجد نموذج مرتبط بهذا الطلب.</div>
          @endforelse
        </div>
      @empty
        <div class="empty">
          <div class="empty-title">لا توجد طلبات لهذا المتقدم</div>
        </div>
      @endforelse
    </div>
  </div>

</div>
@endsection
