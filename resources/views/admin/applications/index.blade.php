@extends('layouts.app')

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">طلبات الانضمام للمسارات</h2>
      </div>

      <div class="col-auto">
        <a href="{{ route('admin.applications.create') }}" class="btn btn-primary">
          إنشاء طلب
        </a>
      </div>
    </div>
  </div>

  @include('partials.alerts')

  <div class="card mb-3">
    <div class="card-body">
      <form method="GET" action="{{ route('admin.applications.index') }}">
        <div class="row">

          <div class="col-md-3 mb-2">
            <input type="text"
                   name="q"
                   value="{{ request('q') }}"
                   class="form-control"
                   placeholder="رقم الطلب / الاسم / الهوية / الجوال">
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
              <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>مرفوض</option>
              <option value="waiting_list" {{ request('status') == 'waiting_list' ? 'selected' : '' }}>قائمة انتظار</option>
              <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>ملغي</option>
            </select>
          </div>

          <div class="col-md-2 mb-2">
            <select name="gender" class="form-select">
              <option value="">الجنس</option>
              <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
              <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
            </select>
          </div>

          <div class="col-md-2 mb-2">
            <button class="btn btn-primary w-100">فلترة</button>
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
            <th>الدرجة</th>
            <th>تاريخ التقديم</th>
            <th>الإجراءات</th>
          </tr>
        </thead>

        <tbody>
        @forelse($items as $item)
          <tr>
            <td>{{ $item->application_number }}</td>

            <td>
              <div>{{ $item->applicant?->full_name }}</div>
              <div class="text-muted">{{ $item->applicant?->national_id }}</div>
            </td>

            <td>{{ $item->track?->title }}</td>

            <td>
              @include('admin.applications.partials.status-badge', ['status' => $item->status])
            </td>

            <td>
              <span class="badge bg-blue">{{ $item->score }}</span>
            </td>

            <td>{{ $item->submitted_at?->format('Y-m-d H:i') ?? '-' }}</td>

            <td>
              <div class="btn-list">
                <a href="{{ route('admin.applications.show', $item) }}" class="btn btn-info btn-sm">
                  عرض
                </a>
                 <a href="{{ route('admin.applications.review', $item) }}" class="btn btn-primary btn-sm">
                  مراجعة
                </a>
                <a href="{{ route('admin.applications.edit', $item) }}" class="btn btn-warning btn-sm">
                  تعديل
                </a>

                <form action="{{ route('admin.applications.destroy', $item) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">
                    حذف
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center text-muted">لا توجد طلبات</td>
          </tr>
        @endforelse
        </tbody>
      </table>
    </div>

    <div class="card-footer">
      {{ $items->links() }}
    </div>
  </div>

</div>
@endsection
