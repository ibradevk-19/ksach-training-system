@extends('layouts.app')

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">مراجعة الطلب</h2>
        <div class="text-muted">
          {{ $application->application_number }} - {{ $application->track?->title }}
        </div>
      </div>

      <div class="col-auto">
        <form action="{{ route('admin.applications.analyze', $application) }}" method="POST">
          @csrf
          <button class="btn btn-primary">تحليل واحتساب النقاط</button>
        </form>
      </div>
    </div>
  </div>

  @include('partials.alerts')

  <div class="row row-cards">

    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">نتيجة التحليل</h3>
        </div>

        <div class="card-body">
          @if($application->review)
            <p>
              <strong>الأهلية:</strong>
              @if($application->review->eligibility_status === 'eligible')
                <span class="badge bg-success">مؤهل</span>
              @elseif($application->review->eligibility_status === 'partially_eligible')
                <span class="badge bg-warning">مؤهل جزئياً</span>
              @else
                <span class="badge bg-danger">غير مؤهل</span>
              @endif
            </p>

            <p><strong>النقاط التلقائية:</strong> {{ $application->review->auto_score }}</p>
            <p><strong>النقاط اليدوية:</strong> {{ $application->review->manual_score }}</p>
            <p><strong>النقاط النهائية:</strong> {{ $application->review->final_score }}</p>
          @else
            <p class="text-muted">لم يتم تحليل الطلب بعد.</p>
          @endif
        </div>
      </div>

      @if($application->review)
        <div class="card mt-3">
          <div class="card-header">
            <h3 class="card-title">تقييم يدوي</h3>
          </div>

          <form action="{{ route('admin.applications.manual-score', $application) }}" method="POST">
            @csrf

            <div class="card-body">
              <div class="mb-3">
                <label class="form-label">درجة يدوية</label>
                <input type="number"
                       name="manual_score"
                       min="0"
                       max="100"
                       value="{{ $application->review->manual_score }}"
                       class="form-control">
              </div>

              <div class="mb-3">
                <label class="form-label">ملاحظات</label>
                <textarea name="notes" rows="4" class="form-control">{{ $application->review->notes }}</textarea>
              </div>
            </div>

            <div class="card-footer text-end">
              <button class="btn btn-primary">حفظ التقييم</button>
            </div>
          </form>
        </div>
      @endif
    </div>

    <div class="col-md-8">

      <div class="card mb-3">
        <div class="card-header">
          <h3 class="card-title">بيانات المتقدم</h3>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-4 mb-3"><strong>الاسم:</strong><div>{{ $application->applicant?->full_name }}</div></div>
            <div class="col-md-4 mb-3"><strong>الهوية:</strong><div>{{ $application->applicant?->national_id }}</div></div>
            <div class="col-md-4 mb-3"><strong>الجوال:</strong><div>{{ $application->applicant?->phone_1 }}</div></div>
            <div class="col-md-4 mb-3"><strong>الجنس:</strong><div>{{ $application->applicant?->gender == 'male' ? 'ذكر' : 'أنثى' }}</div></div>
            <div class="col-md-4 mb-3"><strong>المحافظة:</strong><div>{{ $application->applicant?->governorate?->name ?? '-' }}</div></div>
            <div class="col-md-4 mb-3"><strong>الحالة الصحية:</strong><div>{{ $application->applicant?->health_status == 'disabled' ? 'ذوي إعاقة' : 'سليم' }}</div></div>
          </div>
        </div>
      </div>

      @if($application->review && count($application->review->failed_rules ?? []))
        <div class="card mb-3">
          <div class="card-header">
            <h3 class="card-title text-danger">أسباب عدم الأهلية</h3>
          </div>

          <div class="card-body">
            <ul>
              @foreach($application->review->failed_rules as $rule)
                <li>
                  {{ $rule['message'] }}
                  <span class="text-muted">
                    — القيمة: {{ is_array($rule['actual']) ? json_encode($rule['actual'], JSON_UNESCAPED_UNICODE) : $rule['actual'] }}
                  </span>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">إجابات الطلب</h3>
        </div>

        <div class="table-responsive">
          <table class="table card-table">
            <thead>
              <tr>
                <th>الحقل</th>
                <th>الإجابة</th>
              </tr>
            </thead>

            <tbody>
              @forelse($application->answers as $answer)
                <tr>
                  <td>{{ $answer->field?->label }}</td>
                  <td>
                    @php
                      $decoded = json_decode($answer->answer, true);
                    @endphp

                    @if(json_last_error() === JSON_ERROR_NONE && is_array($decoded))
                      {{ implode('، ', $decoded) }}
                    @else
                      {{ $answer->answer }}
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="2" class="text-center text-muted">لا توجد إجابات</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
