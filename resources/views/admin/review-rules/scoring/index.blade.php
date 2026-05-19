@extends('layouts.app')

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">قواعد النقاط</h2>
      </div>

      <div class="col-auto">
        <a href="{{ route('admin.scoring-rules.create') }}" class="btn btn-primary">
          إضافة قاعدة نقاط
        </a>
      </div>
    </div>
  </div>

  @include('partials.alerts')

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
          <th>القيمة</th>
          <th>النقاط</th>
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
            <td><span class="badge bg-blue">{{ $item->score }}</span></td>
            <td>
              <span class="badge bg-{{ $item->is_active ? 'success' : 'danger' }}">
                {{ $item->is_active ? 'نشط' : 'غير نشط' }}
              </span>
            </td>
            <td>
              <div class="btn-list">
                <a href="{{ route('admin.scoring-rules.edit', $item) }}" class="btn btn-warning btn-sm">تعديل</a>

                <form action="{{ route('admin.scoring-rules.destroy', $item) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" onclick="return confirm('حذف القاعدة؟')">حذف</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="9" class="text-center text-muted">لا توجد قواعد</td>
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
