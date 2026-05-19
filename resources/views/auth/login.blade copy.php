@extends('layouts.auth-tabler')

@section('title', 'تسجيل الدخول')

@section('content')
<form class="card card-md" method="POST" action="{{ route('login') }}" autocomplete="off">
  @csrf

  <div class="card-body">
    <h2 class="card-title text-center mb-4">تسجيل الدخول</h2>

    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif

    <div class="mb-3">
      <label class="form-label">البريد الإلكتروني</label>
      <input type="email"
             name="email"
             value="{{ old('email') }}"
             class="form-control @error('email') is-invalid @enderror"
             placeholder="example@email.com"
             required autofocus>
      @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-2">
      <label class="form-label">كلمة المرور</label>
      <div class="input-group input-group-flat">
        <input type="password"
               name="password"
               class="form-control @error('password') is-invalid @enderror"
               placeholder="********"
               required>
      </div>
      @error('password')
        <div class="invalid-feedback d-block">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-2">
      <label class="form-check">
        <input class="form-check-input" type="checkbox" name="remember">
        <span class="form-check-label">تذكرني</span>
      </label>
    </div>

    <div class="form-footer">
      <button type="submit" class="btn btn-primary w-100">دخول</button>
    </div>
  </div>

  <div class="card-footer text-center">
   
  </div>
</form>
@endsection
