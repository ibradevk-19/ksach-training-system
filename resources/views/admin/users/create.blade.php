@extends('layouts.app')

@section('content')

<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">

      <div class="col">
        <h2 class="page-title">
          إضافة مستخدم
        </h2>
      </div>

    </div>
  </div>

  <form action="{{ route('admin.users.store') }}"
        method="POST">

    @csrf

    <div class="card">

      <div class="card-body">

        <div class="row">

          <div class="col-md-6 mb-3">
            <label class="form-label">الاسم</label>

            <input type="text"
                   name="name"
                   class="form-control">
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label">البريد</label>

            <input type="email"
                   name="email"
                   class="form-control">
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label">كلمة المرور</label>

            <input type="password"
                   name="password"
                   class="form-control">
          </div>

          <div class="col-md-6 mb-3">

            <label class="form-label">الدور</label>

            <select name="role"
                    class="form-select">

              @foreach($roles as $role)

                <option value="{{ $role->name }}">
                  {{ $role->name }}
                </option>

              @endforeach

            </select>

          </div>

        </div>

      </div>

      <div class="card-footer text-end">

        <button class="btn btn-primary">
          حفظ
        </button>

      </div>

    </div>

  </form>

</div>

@endsection