@extends('layouts.app')

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">تقارير طلبات الانضمام</h2>
      </div>

      <div class="col-auto">
        <div class="btn-list">
          <a href="{{ route('admin.reports.applications.export-excel', request()->query()) }}" class="btn btn-success">
            تصدير Excel
          </a>

          <a href="{{ route('admin.reports.applications.export-pdf', request()->query()) }}" class="btn btn-danger">
            تصدير PDF
          </a>
        </div>
      </div>
    </div>
  </div>

  @include('partials.alerts')

  <div class="row row-cards mb-3">
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <div class="subheader">إجمالي الطلبات</div>
          <div class="h2">{{ $summary['total'] }}</div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <div class="subheader">المقبولين</div>
          <div class="h2 text-success">{{ $summary['accepted'] }}</div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <div class="subheader">قائمة الانتظار</div>
          <div class="h2 text-warning">{{ $summary['waiting_list'] }}</div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <div class="subheader">المرفوضين</div>
          <div class="h2 text-danger">{{ $summary['rejected'] }}</div>
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-header">
      <h3 class="card-title">فلاتر التقرير</h3>
    </div>

    <div class="card-body">
      <form method="GET" action="{{ route('admin.reports.applications.index') }}">
        <div class="row">

          <div class="col-md-3 mb-2">
            <input type="text"
                   name="q"
                   value="{{ request('q') }}"
                   class="form-control"
                   placeholder="بحث بالاسم / الهوية / رقم الطلب">
          </div>

          <div class="col-md-3 mb-2">
            <select name="track_id" class="form-select">
              <option value="">كل المسارات</option>
              @foreach($tracks as $track)
                <option value="{{ $track->id }}" {{ request('track_id') == $track->id ? 'selected' : '' }}>
                  {{ $track->title }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2 mb-2">
            <select name="status" class="form-select">
              <option value="">كل الحالات</option>
              <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>مقدم</option>
              <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>قيد المراجعة</option>
              <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>مقبول</option>
              <option value="waiting_list" {{ request('status') == 'waiting_list' ? 'selected' : '' }}>قائمة انتظار</option>
              <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>مرفوض</option>
            </select>
          </div>

          <div class="col-md-2 mb-2">
            <select name="eligibility_status" class="form-select">
              <option value="">الأهلية</option>
              <option value="eligible" {{ request('eligibility_status') == 'eligible' ? 'selected' : '' }}>مؤهل</option>
              <option value="partially_eligible" {{ request('eligibility_status') == 'partially_eligible' ? 'selected' : '' }}>مؤهل جزئياً</option>
              <option value="not_eligible" {{ request('eligibility_status') == 'not_eligible' ? 'selected' : '' }}>غير مؤهل</option>
            </select>
          </div>

          <div class="col-md-2 mb-2">
            <button class="btn btn-primary w-100">
              عرض التقرير
            </button>
          </div>

        </div>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="table-responsive">
      <table class="table table-vcenter card-table">
        <thead>
          <tr>
            <th>رقم الطلب</th>
            <th>المتقدم</th>
            <th>المسار</th>
            <th>الحالة</th>
            <th>الأهلية</th>
            <th>النقاط</th>
            <th>أسباب الرفض</th>
            <th>تاريخ التقديم</th>
          </tr>
        </thead>

        <tbody>
        @forelse($applications as $application)
          <tr>
            <td>{{ $application->application_number }}</td>

            <td>
              <div>{{ $application->applicant?->full_name }}</div>
              <div class="text-muted">{{ $application->applicant?->national_id }}</div>
            </td>

            <td>{{ $application->track?->title }}</td>

            <td>
              @include('admin.applications.partials.status-badge', ['status' => $application->status])
            </td>

            <td>
              @if($application->review?->eligibility_status === 'eligible')
                <span class="badge bg-success">مؤهل</span>
              @elseif($application->review?->eligibility_status === 'not_eligible')
                <span class="badge bg-danger">غير مؤهل</span>
              @elseif($application->review?->eligibility_status === 'partially_eligible')
                <span class="badge bg-warning">مؤهل جزئياً</span>
              @else
                <span class="badge bg-secondary">غير محلل</span>
              @endif
            </td>

            <td>
              <span class="badge bg-blue">{{ $application->score }}</span>
            </td>

            <td>
              @php
                $failed = $application->review?->failed_rules ?? [];
              @endphp

              @if(count($failed))
                <ul class="mb-0">
                  @foreach($failed as $rule)
                    <li>{{ $rule['message'] ?? '-' }}</li>
                  @endforeach
                </ul>
              @else
                -
              @endif
            </td>

            <td>{{ $application->submitted_at?->format('Y-m-d H:i') ?? '-' }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center text-muted">
              لا توجد بيانات
            </td>
          </tr>
        @endforelse
        </tbody>
      </table>
    </div>

    <div class="card-footer">
      {{ $applications->links() }}
    </div>
  </div>

</div>
@endsection
