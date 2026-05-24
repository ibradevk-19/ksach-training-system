@extends('layouts.app')

@section('content')
<div class="container-xl">
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">المحافظات</h2>
      </div>

      <div class="col-auto">
        <a href="{{ route('admin.governorates.create') }}" class="btn btn-primary">
          إضافة محافظة
        </a>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="table-responsive">
      <table class="table table-vcenter card-table">
        <thead>
          <tr>
            <th>#</th>
            <th>الاسم</th>
            <th>التجمعات السكانية</th>
            <th>الحالة</th>
            <th>الإجراءات</th>
          </tr>
        </thead>

        <tbody>
          @foreach($items as $item)
            <tr>
              <td>{{ $item->id }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->population_communities_count }}</td>
              <td>
                @if($item->status)
                  <span class="badge bg-success">نشط</span>
                @else
                  <span class="badge bg-danger">غير نشط</span>
                @endif
              </td>
              <td>
                <div class="btn-list">
                  <a href="{{ route('admin.governorates.edit', $item) }}" class="btn btn-warning btn-sm">
                    تعديل
                  </a>

                  <form action="{{ route('admin.governorates.destroy', $item) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">حذف</button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="card-footer">
      {{ $items->links() }}
    </div>
  </div>
</div>
@endsection
