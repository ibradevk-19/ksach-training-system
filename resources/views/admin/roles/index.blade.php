@extends('layouts.app')

@section('content')

<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">

      <div class="col">
        <h2 class="page-title">إدارة الأدوار</h2>
      </div>

      <div class="col-auto">
        @can('roles.create')
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">إضافة دور</a>
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
            <th>اسم الدور</th>
            <th>الصلاحيات</th>
            <th>الإجراءات</th>
          </tr>
        </thead>
        <tbody>
          @forelse($roles as $role)
          <tr>
            <td>{{ $role->id }}</td>
            <td>{{ $role->name }}</td>
            <td>
              @foreach($role->permissions as $permission)
                <span class="badge bg-blue">{{ $permission->name }}</span>
              @endforeach
            </td>
            <td>
              <div class="btn-list">
                @can('roles.edit')
                <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-warning btn-sm">تعديل</a>
                @endcan

                @can('roles.delete')
                <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" onclick="return confirm('حذف الدور؟')">حذف</button>
                </form>
                @endcan
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4" class="text-center">لا يوجد بيانات</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="card-footer">
      {{ $roles->links() }}
    </div>

  </div>
</div>

@endsection
