@extends('layouts.app')

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">تفاصيل المتقدم</h2>
      </div>

      <div class="col-auto">
        <a href="{{ route('admin.applicants.edit', $applicant) }}" class="btn btn-warning">
          تعديل
        </a>
      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-header">
      <h3 class="card-title">البيانات الأساسية</h3>
    </div>

    <div class="card-body">
      <div class="row">

        <div class="col-md-4 mb-3">
          <strong>الاسم:</strong>
          <div>{{ $applicant->full_name }}</div>
        </div>

        <div class="col-md-4 mb-3">
          <strong>رقم الهوية:</strong>
          <div>{{ $applicant->national_id }}</div>
        </div>

        <div class="col-md-4 mb-3">
          <strong>الجنس:</strong>
          <div>{{ $applicant->gender == 'male' ? 'ذكر' : 'أنثى' }}</div>
        </div>

        <div class="col-md-4 mb-3">
          <strong>رقم تواصل 1:</strong>
          <div>{{ $applicant->phone_1 }}</div>
        </div>

        <div class="col-md-4 mb-3">
          <strong>رقم تواصل 2:</strong>
          <div>{{ $applicant->phone_2 ?? '-' }}</div>
        </div>

        <div class="col-md-4 mb-3">
          <strong>تاريخ الميلاد:</strong>
          <div>{{ $applicant->birth_date?->format('Y-m-d') ?? '-' }}</div>
        </div>

      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-header">
      <h3 class="card-title">السكن والأسرة</h3>
    </div>

    <div class="card-body">
      <div class="row">

        <div class="col-md-4 mb-3">
          <strong>المحافظة:</strong>
          <div>{{ $applicant->governorate?->name ?? '-' }}</div>
        </div>

        <div class="col-md-4 mb-3">
          <strong>الإقامة:</strong>
          <div>
            @if($applicant->displacement_status == 'resident')
              مقيم
            @elseif($applicant->displacement_status == 'displaced')
              نازح
            @else
              -
            @endif
          </div>
        </div>

        <div class="col-md-4 mb-3">
          <strong>مكان الإقامة:</strong>
          <div>{{ $applicant->residenceType?->name ?? '-' }}</div>
        </div>

        <div class="col-md-12 mb-3">
          <strong>العنوان:</strong>
          <div>{{ $applicant->current_address ?? '-' }}</div>
        </div>

      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-header">
      <h3 class="card-title">البيانات الاقتصادية والتعليمية</h3>
    </div>

    <div class="card-body">
      <div class="row">

        <div class="col-md-4 mb-3">
          <strong>حالة العمل:</strong>
          <div>{{ $applicant->employment_status == 'employed' ? 'يعمل / تعمل' : 'لا يعمل / لا تعمل' }}</div>
        </div>

        <div class="col-md-4 mb-3">
          <strong>الدخل:</strong>
          <div>{{ $applicant->incomeType?->name ?? '-' }}</div>
        </div>

        <div class="col-md-4 mb-3">
          <strong>التعليم:</strong>
          <div>{{ $applicant->education_level ?? '-' }}</div>
        </div>

        <div class="col-md-4 mb-3">
          <strong>التخصص:</strong>
          <div>{{ $applicant->specialization ?? '-' }}</div>
        </div>

        <div class="col-md-4 mb-3">
          <strong>الوضع الصحي:</strong>
          <div>{{ $applicant->health_status == 'disabled' ? 'ذوي إعاقة' : 'سليم / سليمة' }}</div>
        </div>

      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">المرفقات</h3>
    </div>

    <div class="card-body">
      <div class="btn-list">

        @if($applicant->identity_image)
          <a href="{{ asset('storage/'.$applicant->identity_image) }}" target="_blank" class="btn btn-outline-primary">
            صورة الهوية
          </a>
        @endif

        @if($applicant->medical_report)
          <a href="{{ asset('storage/'.$applicant->medical_report) }}" target="_blank" class="btn btn-outline-primary">
            التقرير الطبي
          </a>
        @endif

        @if($applicant->education_certificate)
          <a href="{{ asset('storage/'.$applicant->education_certificate) }}" target="_blank" class="btn btn-outline-primary">
            الشهادة العلمية
          </a>
        @endif

      </div>
    </div>
  </div>

</div>
@endsection
