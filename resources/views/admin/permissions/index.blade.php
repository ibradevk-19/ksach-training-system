@extends('layouts.app')

@section('content')

<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">إدارة الصلاحيات</h2>
      </div>
      <div class="col-auto">
        @can('permissions.create')
        <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">إضافة صلاحية</a>
        @endcan
      </div>
    </div>
  </div>

  <div class="card">
    <div class="table-responsive">
      <table class="table table-vcenter card-table">
        <thead>
          <tr>
            <th>#</th>
            <th>اسم الصلاحية</th>
            <th>الإجراءات</th>
          </tr>
        </thead>
        <tbody>
          @forelse($permissions as $permission)
          <tr>
            <td>{{ $permission->id }}</td>
            <td>{{ $permission->name }}</td>
            <td>
              <div class="btn-list">
                @can('permissions.edit')
                <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-warning btn-sm">تعديل</a>
                @endcan

                @can('permissions.delete')
                <form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" onclick="return confirm('حذف الصلاحية؟')">حذف</button>
                </form>
                @endcan
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="3" class="text-center">لا يوجد بيانات</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="card-footer">
      {{ $permissions->links() }}
    </div>
  </div>
</div>

@endsection
