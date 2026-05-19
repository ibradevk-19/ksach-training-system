@extends('layouts.app')

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">بناء النموذج: {{ $form->title }}</h2>
        <div class="text-muted">المسار: {{ $form->track?->title }}</div>
      </div>

      <div class="col-auto">
        <a href="{{ route('admin.form-fields.create', ['form_id' => $form->id]) }}" class="btn btn-primary">
          إضافة حقل
        </a>
      </div>
    </div>
  </div>

  @include('partials.alerts')

  <div class="row">

    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-header">
          <h3 class="card-title">إضافة قسم</h3>
        </div>

        <form action="{{ route('admin.form-sections.store') }}" method="POST">
          @csrf
          <input type="hidden" name="form_id" value="{{ $form->id }}">

          <div class="card-body">
            <div class="mb-3">
              <label class="form-label">عنوان القسم</label>
              <input type="text" name="title" class="form-control">
            </div>

            <div class="mb-3">
              <label class="form-label">الوصف</label>
              <textarea name="description" rows="3" class="form-control"></textarea>
            </div>

            <div class="mb-3">
              <label class="form-label">الترتيب</label>
              <input type="number" name="sort_order" class="form-control" value="0">
            </div>
          </div>

          <div class="card-footer text-end">
            <button class="btn btn-primary">إضافة القسم</button>
          </div>
        </form>
      </div>
    </div>

    <div class="col-md-8">
      @forelse($form->sections as $section)
        <div class="card mb-3">
          <div class="card-header">
            <div>
              <h3 class="card-title">{{ $section->title }}</h3>
              <div class="text-muted">{{ $section->description }}</div>
            </div>

            <div class="card-actions">
              <form action="{{ route('admin.form-sections.destroy', $section) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('حذف القسم؟')">
                  حذف
                </button>
              </form>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table card-table">
              <thead>
              <tr>
                <th>الحقل</th>
                <th>النوع</th>
                <th>إلزامي</th>
                <th>الترتيب</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
              </tr>
              </thead>

              <tbody>
              @forelse($section->fields as $field)
                <tr>
                  <td>{{ $field->label }}</td>
                  <td>{{ $field->type }}</td>
                  <td>{{ $field->is_required ? 'نعم' : 'لا' }}</td>
                  <td>{{ $field->sort_order }}</td>
                  <td>
                    <span class="badge bg-{{ $field->status ? 'success' : 'danger' }}">
                      {{ $field->status ? 'نشط' : 'غير نشط' }}
                    </span>
                  </td>
                  <td>
                    <div class="btn-list">
                      <a href="{{ route('admin.form-fields.edit', $field) }}" class="btn btn-warning btn-sm">
                        تعديل
                      </a>

                      <form action="{{ route('admin.form-fields.destroy', $field) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('حذف الحقل؟')">
                          حذف
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center text-muted">لا توجد حقول داخل هذا القسم</td>
                </tr>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
      @empty
        <div class="empty-state text-center py-5">
          <p class="text-muted">لم يتم إنشاء أقسام بعد.</p>
        </div>
      @endforelse
    </div>

  </div>
</div>
@endsection
