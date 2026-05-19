@extends('layouts.app')

@section('content')

<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">

      <div class="col">
        <h2 class="page-title">
          إدارة المستخدمين
        </h2>
      </div>

      <div class="col-auto">

        @can('users.create')
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
          إضافة مستخدم
        </a>
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
            <th>الاسم</th>
            <th>البريد</th>
            <th>الدور</th>
            <th>الإجراءات</th>
          </tr>
        </thead>

        <tbody>

          @forelse($users as $user)

          <tr>

            <td>{{ $user->id }}</td>

            <td>{{ $user->name }}</td>

            <td>{{ $user->email }}</td>

            <td>
              @foreach($user->roles as $role)
                <span class="badge bg-blue">
                  {{ $role->name }}
                </span>
              @endforeach
            </td>

            <td>

              <div class="btn-list">

                @can('users.edit')
                <a href="{{ route('admin.users.edit',$user) }}"
                   class="btn btn-warning btn-sm">
                  تعديل
                </a>
                @endcan

                @can('users.delete')
                <form action="{{ route('admin.users.destroy',$user) }}"
                      method="POST">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('حذف المستخدم؟')">

                        حذف
                    </button>

                </form>
                @endcan

              </div>

            </td>

          </tr>

          @empty

          <tr>
            <td colspan="5" class="text-center">
              لا يوجد بيانات
            </td>
          </tr>

          @endforelse

        </tbody>

      </table>

    </div>

    <div class="card-footer">
      {{ $users->links() }}
    </div>

  </div>

</div>

@endsection