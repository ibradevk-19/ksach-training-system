@extends('layouts.app')

@section('content')

<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">تعديل الصلاحية</h2>
      </div>
    </div>
  </div>

  <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">اسم الصلاحية</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $permission->name) }}">
          </div>
        </div>
      </div>

      <div class="card-footer text-end">
        <button class="btn btn-primary">تحديث</button>
      </div>
    </div>
  </form>
</div>

@endsection
