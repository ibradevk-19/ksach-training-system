@extends('layouts.app')

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">المسارات التدريبية</h2>
      </div>

      <div class="col-auto">
        <a href="{{ route('admin.tracks.create') }}" class="btn btn-primary">
          إضافة مسار
        </a>
      </div>
    </div>
  </div>

  @include('partials.alerts')

  <div class="card mb-3">
    <div class="card-body">
      <form method="GET" action="{{ route('admin.tracks.index') }}">
        <div class="row">

          <div class="col-md-3 mb-2">
            <input type="text"
                   name="q"
                   value="{{ request('q') }}"
                   class="form-control"
                   placeholder="بحث باسم المسار">
          </div>

          <div class="col-md-2 mb-2">
            <select name="track_type_id" class="form-select">
              <option value="">نوع المسار</option>
              @foreach($types as $type)
                <option value="{{ $type->id }}" {{ request('track_type_id') == $type->id ? 'selected' : '' }}>
                  {{ $type->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2 mb-2">
            <select name="track_category_id" class="form-select">
              <option value="">التصنيف</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('track_category_id') == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2 mb-2">
            <select name="gender" class="form-select">
              <option value="">الجنس</option>
              <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>ذكور</option>
              <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>إناث</option>
              <option value="both" {{ request('gender') == 'both' ? 'selected' : '' }}>الكل</option>
            </select>
          </div>

          <div class="col-md-2 mb-2">
            <select name="status" class="form-select">
              <option value="">الحالة</option>
              <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>مسودة</option>
              <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>منشور</option>
              <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>مغلق</option>
              <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>مؤرشف</option>
            </select>
          </div>

          <div class="col-md-1 mb-2">
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
            <th>النوع</th>
            <th>التصنيف</th>
            <th>المقاعد</th>
            <th>الجنس</th>
            <th>التسجيل</th>
            <th>الحالة</th>
            <th>الإجراءات</th>
          </tr>
        </thead>

        <tbody>
        @forelse($items as $item)
          <tr>
            <td>{{ $item->id }}</td>

            <td>
              <div class="d-flex align-items-center">
                @if($item->thumbnail)
                  <span class="avatar me-2" style="background-image: url('{{ asset('storage/'.$item->thumbnail) }}')"></span>
                @endif

                <div>
                  <div class="font-weight-medium">{{ $item->title }}</div>
                  <div class="text-muted">{{ $item->slug }}</div>
                </div>
              </div>
            </td>

            <td>{{ $item->type?->name ?? '-' }}</td>
            <td>{{ $item->category?->name ?? '-' }}</td>
            <td>{{ $item->seats }}</td>

            <td>
              @if($item->gender === 'male')
                ذكور
              @elseif($item->gender === 'female')
                إناث
              @else
                الكل
              @endif
            </td>

            <td>
              {{ $item->registration_start?->format('Y-m-d') ?? '-' }}
              <br>
              <span class="text-muted">{{ $item->registration_end?->format('Y-m-d') ?? '-' }}</span>
            </td>

            <td>
              @php
                $statusColors = [
                  'draft' => 'secondary',
                  'published' => 'success',
                  'closed' => 'danger',
                  'archived' => 'dark',
                ];

                $statusLabels = [
                  'draft' => 'مسودة',
                  'published' => 'منشور',
                  'closed' => 'مغلق',
                  'archived' => 'مؤرشف',
                ];
              @endphp

              <span class="badge bg-{{ $statusColors[$item->status] ?? 'secondary' }}">
                {{ $statusLabels[$item->status] ?? $item->status }}
              </span>
            </td>

            <td>
              <div class="btn-list">
                <a href="{{ route('admin.tracks.edit', $item) }}" class="btn btn-warning btn-sm">
                  تعديل
                </a>

                <form action="{{ route('admin.tracks.destroy', $item) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                    حذف
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="9" class="text-center text-muted">لا توجد بيانات</td>
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
