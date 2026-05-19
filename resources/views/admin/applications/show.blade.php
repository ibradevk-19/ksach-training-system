@extends('layouts.app')

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">تفاصيل الطلب</h2>
      </div>

      <div class="col-auto">
        <a href="{{ route('admin.applications.edit', $application) }}" class="btn btn-warning">
          تعديل الطلب
        </a>
      </div>
    </div>
  </div>

  @include('partials.alerts')

  <div class="row row-cards">

    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">بيانات الطلب</h3>
        </div>
        <a href="{{ route('admin.applications.review', $application) }}" class="btn btn-primary">
          مراجعة ذكية
        </a>
        <div class="card-body">
          <p><strong>رقم الطلب:</strong> {{ $application->application_number }}</p>
          <p><strong>الحالة:</strong> @include('admin.applications.partials.status-badge', ['status' => $application->status])</p>
          <p><strong>الدرجة:</strong> {{ $application->score }}</p>
          <p><strong>تاريخ التقديم:</strong> {{ $application->submitted_at?->format('Y-m-d H:i') ?? '-' }}</p>
          <p><strong>أنشئ بواسطة:</strong> {{ $application->creator?->name ?? '-' }}</p>
          <p><strong>راجع بواسطة:</strong> {{ $application->reviewer?->name ?? '-' }}</p>
        </div>
      </div>

      <div class="card mt-3">
        <div class="card-header">
          <h3 class="card-title">تغيير الحالة السريع</h3>
        </div>

        <form action="{{ route('admin.applications.change-status', $application) }}" method="POST">
          @csrf
          @method('PATCH')

          <div class="card-body">
            <div class="mb-3">
              <label class="form-label">الحالة</label>
              <select name="status" class="form-select">
                <option value="under_review">قيد المراجعة</option>
                <option value="accepted">مقبول</option>
                <option value="rejected">مرفوض</option>
                <option value="waiting_list">قائمة انتظار</option>
                <option value="cancelled">ملغي</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">ملاحظات</label>
              <textarea name="notes" rows="3" class="form-control"></textarea>
            </div>
          </div>

          <div class="card-footer text-end">
            <button class="btn btn-primary">تحديث الحالة</button>
          </div>
        </form>
      </div>
    </div>

    <div class="col-md-8">
      <div class="card mb-3">
        <div class="card-header">
          <h3 class="card-title">بيانات المتقدم</h3>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <strong>الاسم:</strong>
              <div>{{ $application->applicant?->full_name }}</div>
            </div>

            <div class="col-md-6 mb-3">
              <strong>رقم الهوية:</strong>
              <div>{{ $application->applicant?->national_id }}</div>
            </div>

            <div class="col-md-6 mb-3">
              <strong>رقم التواصل:</strong>
              <div>{{ $application->applicant?->phone_1 }}</div>
            </div>

            <div class="col-md-6 mb-3">
              <strong>المحافظة:</strong>
              <div>{{ $application->applicant?->governorate?->name ?? '-' }}</div>
            </div>

            <div class="col-md-6 mb-3">
              <strong>الجنس:</strong>
              <div>{{ $application->applicant?->gender == 'male' ? 'ذكر' : 'أنثى' }}</div>
            </div>

            <div class="col-md-6 mb-3">
              <strong>الوضع الصحي:</strong>
              <div>{{ $application->applicant?->health_status == 'disabled' ? 'ذوي إعاقة' : 'سليم / سليمة' }}</div>
            </div>
          </div>

          <a href="{{ route('admin.applicants.show', $application->applicant) }}" class="btn btn-outline-primary">
            عرض ملف المتقدم
          </a>
          <a href="{{ route('admin.applications.answers.edit', $application) }}" class="btn btn-primary">
            تعبئة / تعديل نموذج الطلب
          </a>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">بيانات المسار</h3>
        </div>

        <div class="card-body">
          <p><strong>المسار:</strong> {{ $application->track?->title }}</p>
          <p><strong>النوع:</strong> {{ $application->track?->type?->name ?? '-' }}</p>
          <p><strong>التصنيف:</strong> {{ $application->track?->category?->name ?? '-' }}</p>
          <p><strong>عدد المقاعد:</strong> {{ $application->track?->seats }}</p>
          <p><strong>الجنس المطلوب:</strong> {{ $application->track?->gender }}</p>
          <p><strong>الفئة العمرية:</strong> {{ $application->track?->min_age }} - {{ $application->track?->max_age }}</p>
        </div>
      </div>
    </div>

  </div>

</div>
@endsection
