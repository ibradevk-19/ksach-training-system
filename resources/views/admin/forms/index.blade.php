@extends('layouts.app')

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">نماذج المسارات</h2>
      </div>

      <div class="col-auto">
        <a href="{{ route('admin.forms.create') }}" class="btn btn-primary">
          إنشاء نموذج
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
          <th>النموذج</th>
          <th>المسار</th>
          <th>متعدد الخطوات</th>
          <th>الحالة</th>
          <th>الإجراءات</th>
        </tr>
        </thead>

        <tbody>
        @forelse($forms as $form)
          <tr>
            <td>{{ $form->id }}</td>
            <td>{{ $form->title }}</td>
            <td>{{ $form->track?->title }}</td>
            <td>{{ $form->is_multi_step ? 'نعم' : 'لا' }}</td>
            <td>
              <span class="badge bg-{{ $form->status ? 'success' : 'danger' }}">
                {{ $form->status ? 'نشط' : 'غير نشط' }}
              </span>
            </td>
            <td>
              <div class="btn-list">
                <a href="{{ route('admin.forms.builder', $form) }}" class="btn btn-primary btn-sm">
                  بناء النموذج
                </a>

                <a href="{{ route('admin.forms.edit', $form) }}" class="btn btn-warning btn-sm">
                  تعديل
                </a>

                <form action="{{ route('admin.forms.destroy', $form) }}" method="POST">
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
            <td colspan="6" class="text-center text-muted">لا توجد نماذج</td>
          </tr>
        @endforelse
        </tbody>
      </table>
    </div>

    <div class="card-footer">
      {{ $forms->links() }}
    </div>
  </div>
</div>
@endsection
