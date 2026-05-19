@extends('layouts.app')

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">ترتيب واعتماد الطلبات</h2>
      </div>
    </div>
  </div>

  @include('partials.alerts')

  <div class="card mb-3">
    <div class="card-body">
      <form method="GET" action="{{ route('admin.rankings.index') }}">
        <div class="row">
          <div class="col-md-9 mb-2">
            <select name="track_id" class="form-select">
              <option value="">اختر المسار</option>
              @foreach($tracks as $track)
                <option value="{{ $track->id }}" {{ request('track_id') == $track->id ? 'selected' : '' }}>
                  {{ $track->title }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-3 mb-2">
            <button class="btn btn-primary w-100">عرض الترتيب</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  @if($selectedTrack)
    <div class="row row-cards mb-3">
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <div class="subheader">المقاعد</div>
            <div class="h2">{{ $selectedTrack->seats }}</div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <div class="subheader">إجمالي الطلبات</div>
            <div class="h2">{{ $selectedTrack->applications()->count() }}</div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <div class="subheader">المقبولين</div>
            <div class="h2">{{ $selectedTrack->applications()->where('status', 'accepted')->count() }}</div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <div class="subheader">قائمة الانتظار</div>
            <div class="h2">{{ $selectedTrack->applications()->where('status', 'waiting_list')->count() }}</div>
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-body">
        <div class="btn-list">

          <form action="{{ route('admin.rankings.analyze-all') }}" method="POST">
            @csrf
            <input type="hidden" name="track_id" value="{{ $selectedTrack->id }}">
            <button class="btn btn-primary" onclick="return confirm('تحليل جميع الطلبات؟')">
              تحليل جميع الطلبات
            </button>
          </form>

          <form action="{{ route('admin.rankings.reject-not-eligible') }}" method="POST">
            @csrf
            <input type="hidden" name="track_id" value="{{ $selectedTrack->id }}">
            <button class="btn btn-danger" onclick="return confirm('رفض جميع غير المؤهلين؟')">
              رفض غير المؤهلين
            </button>
          </form>

          <form action="{{ route('admin.rankings.auto-select') }}" method="POST">
            @csrf
            <input type="hidden" name="track_id" value="{{ $selectedTrack->id }}">
            <button class="btn btn-success" onclick="return confirm('سيتم قبول أعلى المرشحين حسب عدد المقاعد وتحويل الباقي لقائمة انتظار. متابعة؟')">
              اعتماد أعلى المرشحين
            </button>
          </form>

        </div>
      </div>
    </div>

    <div class="card">
      <div class="table-responsive">
        <table class="table table-vcenter card-table">
          <thead>
          <tr>
            <th>الترتيب</th>
            <th>رقم الطلب</th>
            <th>المتقدم</th>
            <th>الأهلية</th>
            <th>النقاط</th>
            <th>الحالة</th>
            <th>الإجراءات</th>
          </tr>
          </thead>

          <tbody>
          @forelse($applications as $index => $application)
            <tr>
              <td>{{ ($applications->currentPage() - 1) * $applications->perPage() + $index + 1 }}</td>

              <td>{{ $application->application_number }}</td>

              <td>
                <div>{{ $application->applicant?->full_name }}</div>
                <div class="text-muted">{{ $application->applicant?->national_id }}</div>
              </td>

              <td>
                @if($application->review?->eligibility_status === 'eligible')
                  <span class="badge bg-success">مؤهل</span>
                @elseif($application->review?->eligibility_status === 'not_eligible')
                  <span class="badge bg-danger">غير مؤهل</span>
                @else
                  <span class="badge bg-secondary">غير محلل</span>
                @endif
              </td>

              <td>
                <span class="badge bg-blue">{{ $application->score }}</span>
              </td>

              <td>
                @include('admin.applications.partials.status-badge', ['status' => $application->status])
              </td>

              <td>
                <div class="btn-list">
                  <a href="{{ route('admin.applications.review', $application) }}" class="btn btn-primary btn-sm">
                    مراجعة
                  </a>

                  <a href="{{ route('admin.applications.show', $application) }}" class="btn btn-info btn-sm">
                    عرض
                  </a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center text-muted">لا توجد طلبات لهذا المسار</td>
            </tr>
          @endforelse
          </tbody>
        </table>
      </div>

      <div class="card-footer">
        {{ $applications->links() }}
      </div>
    </div>
  @endif

</div>
@endsection
