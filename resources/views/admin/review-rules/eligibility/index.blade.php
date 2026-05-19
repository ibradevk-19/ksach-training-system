@extends('layouts.app')

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">قواعد الأهلية</h2>
      </div>

      <div class="col-auto">
        <a href="{{ route('admin.eligibility-rules.create') }}" class="btn btn-primary">
          إضافة قاعدة أهلية
        </a>
      </div>
    </div>
  </div>

  @include('partials.alerts')

  <div class="card mb-3">
    <div class="card-body">
      <form method="GET">
        <div class="row">
          <div class="col-md-5 mb-2">
            <select name="track_id" class="form-select">
              <option value="">كل المسارات</option>
              @foreach($tracks as $track)
                <option value="{{ $track->id }}" {{ request('track_id') == $track->id ? 'selected' : '' }}>
                  {{ $track->title }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-4 mb-2">
            <select name="source" class="form-select">
              <option value="">كل المصادر</option>
              <option value="applicant" {{ request('source') == 'applicant' ? 'selected' : '' }}>بيانات المتقدم</option>
              <option value="answer" {{ request('source') == 'answer' ? 'selected' : '' }}>إجابات النموذج</option>
              <option value="track" {{ request('source') == 'track' ? 'selected' : '' }}>بيانات المسار</option>
            </select>
          </div>

          <div class="col-md-3 mb-2">
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
          <th>#</th>
          <th>المسار</th>
          <th>المصدر</th>
          <th>الحقل</th>
          <th>الشرط</th>
          <th>القيمة المتوقعة</th>
          <th>الحالة</th>
          <th>الإجراءات</th>
        </tr>
        </thead>

        <tbody>
        @forelse($items as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->track?->title }}</td>
            <td>{{ $item->source }}</td>
            <td>{{ $item->field_name }}</td>
            <td>{{ $item->operator }}</td>
            <td>{{ implode('، ', $item->expected_value ?? []) }}</td>
            <td>
              <span class="badge bg-{{ $item->is_active ? 'success' : 'danger' }}">
                {{ $item->is_active ? 'نشط' : 'غير نشط' }}
              </span>
            </td>
            <td>
              <div class="btn-list">
                <a href="{{ route('admin.eligibility-rules.edit', $item) }}" class="btn btn-warning btn-sm">
                  تعديل
                </a>

                <form action="{{ route('admin.eligibility-rules.destroy', $item) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" onclick="return confirm('حذف القاعدة؟')">
                    حذف
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center text-muted">لا توجد قواعد</td>
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
