@extends('layouts.app')

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">إدارة المتقدمين</h2>
      </div>

      <div class="col-auto">
        <a href="{{ route('admin.applicants.create') }}" class="btn btn-primary">
          إضافة متقدم
        </a>
      </div>
    </div>
  </div>

  @include('partials.alerts')

  <div class="card mb-3">
    <div class="card-body">
      <form method="GET" action="{{ route('admin.applicants.index') }}">
        <div class="row">

          <div class="col-md-3 mb-2">
            <input type="text"
                   name="q"
                   value="{{ request('q') }}"
                   class="form-control"
                   placeholder="بحث بالاسم / الهوية / الجوال">
          </div>

          <div class="col-md-2 mb-2">
            <select name="gender" class="form-select">
              <option value="">الجنس</option>
              <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
              <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
            </select>
          </div>

          <div class="col-md-2 mb-2">
            <select name="governorate_id" class="form-select">
              <option value="">المحافظة</option>
              @foreach($governorates as $governorate)
                <option value="{{ $governorate->id }}" {{ request('governorate_id') == $governorate->id ? 'selected' : '' }}>
                  {{ $governorate->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2 mb-2">
            <select name="displacement_status" class="form-select">
              <option value="">الإقامة</option>
              <option value="resident" {{ request('displacement_status') == 'resident' ? 'selected' : '' }}>مقيم</option>
              <option value="displaced" {{ request('displacement_status') == 'displaced' ? 'selected' : '' }}>نازح</option>
            </select>
          </div>

          <div class="col-md-2 mb-2">
            <select name="employment_status" class="form-select">
              <option value="">العمل</option>
              <option value="employed" {{ request('employment_status') == 'employed' ? 'selected' : '' }}>يعمل</option>
              <option value="unemployed" {{ request('employment_status') == 'unemployed' ? 'selected' : '' }}>لا يعمل</option>
            </select>
          </div>

          <div class="col-md-1 mb-2">
            <button class="btn btn-primary w-100">بحث</button>
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
            <th>الاسم</th>
            <th>رقم الهوية</th>
            <th>الجوال</th>
            <th>الجنس</th>
            <th>المحافظة</th>
            <th>الحالة الصحية</th>
            <th>الحالة</th>
            <th>الإجراءات</th>
          </tr>
        </thead>

        <tbody>
        @forelse($items as $item)
          <tr>
            <td>{{ $item->id }}</td>

            <td>{{ $item->full_name }}</td>

            <td>{{ $item->national_id }}</td>

            <td>
              {{ $item->phone_1 }}
              @if($item->phone_2)
                <br>
                <span class="text-muted">{{ $item->phone_2 }}</span>
              @endif
            </td>

            <td>
              {{ $item->gender == 'male' ? 'ذكر' : 'أنثى' }}
            </td>

            <td>{{ $item->governorate?->name ?? '-' }}</td>

            <td>
              @if($item->health_status == 'disabled')
                <span class="badge bg-warning">ذوي إعاقة</span>
              @elseif($item->health_status == 'healthy')
                <span class="badge bg-success">سليم</span>
              @else
                -
              @endif
            </td>

            <td>
              @if($item->is_active)
                <span class="badge bg-success">نشط</span>
              @else
                <span class="badge bg-danger">غير نشط</span>
              @endif
            </td>

            <td>
              <div class="btn-list">
                <a href="{{ route('admin.applicants.show', $item) }}" class="btn btn-info btn-sm">
                  عرض
                </a>

                <a href="{{ route('admin.applicants.edit', $item) }}" class="btn btn-warning btn-sm">
                  تعديل
                </a>

                <form action="{{ route('admin.applicants.destroy', $item) }}" method="POST">
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
            <td colspan="9" class="text-center text-muted">
              لا توجد بيانات
            </td>
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
