@extends('layouts.app')

@section('content')

<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">

      <div class="col">
        <h2 class="page-title">
          تعديل المستخدم
        </h2>
      </div>

    </div>
  </div>

  <form action="{{ route('admin.users.update',$user) }}"
        method="POST">

    @csrf
    @method('PUT')

    <div class="card">

      <div class="card-body">

        <div class="row">

          <div class="col-md-6 mb-3">

            <label class="form-label">الاسم</label>

            <input type="text"
                   name="name"
                   value="{{ $user->name }}"
                   class="form-control">

          </div>

          <div class="col-md-6 mb-3">

            <label class="form-label">البريد</label>

            <input type="email"
                   name="email"
                   value="{{ $user->email }}"
                   class="form-control">

          </div>

          <div class="col-md-6 mb-3">

            <label class="form-label">
              كلمة المرور الجديدة
            </label>

            <input type="password"
                   name="password"
                   class="form-control">

          </div>

          <div class="col-md-6 mb-3">

            <label class="form-label">الدور</label>

            <select name="role"
                    class="form-select">

              @foreach($roles as $role)

                <option value="{{ $role->name }}"
                    {{ $user->roles->first()?->name == $role->name ? 'selected' : '' }}>

                    {{ $role->name }}

                </option>

              @endforeach

            </select>

          </div>

        </div>

      </div>

      <div class="card-footer text-end">

        <button class="btn btn-primary">
          تحديث
        </button>

      </div>

    </div>

  </form>

</div>

@endsection