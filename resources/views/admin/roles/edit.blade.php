@extends('layouts.app')

@section('content')

<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">تعديل الدور</h2>
      </div>
    </div>
  </div>

  <form action="{{ route('admin.roles.update', $role) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">اسم الدور</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}">
          </div>

          <div class="col-12 mb-3">
            <label class="form-label">الصلاحيات</label>
            <select name="permissions[]" class="form-select" multiple>
              @foreach($permissions as $permission)
                <option value="{{ $permission->id }}"
                  {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'selected' : '' }}>
                  {{ $permission->name }}
                </option>
              @endforeach
            </select>
            <div class="form-hint">يمكنك اختيار أكثر من صلاحية</div>
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
