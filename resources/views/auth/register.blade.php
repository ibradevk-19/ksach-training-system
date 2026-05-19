@extends('layouts.auth-tabler')

@section('title', 'إنشاء حساب')

@section('content')
<form class="card card-md" method="POST" action="{{ route('register') }}" autocomplete="off">
  @csrf

  <div class="card-body">
    <h2 class="card-title text-center mb-4">إنشاء حساب</h2>

    {{-- Name --}}
    <div class="mb-3">
      <label class="form-label">الاسم</label>
      <input type="text"
             name="name"
             value="{{ old('name') }}"
             class="form-control @error('name') is-invalid @enderror"
             placeholder="الاسم الكامل"
             required autofocus>
      @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- Email --}}
    <div class="mb-3">
      <label class="form-label">البريد الإلكتروني</label>
      <input type="email"
             name="email"
             value="{{ old('email') }}"
             class="form-control @error('email') is-invalid @enderror"
             placeholder="example@email.com"
             required>
      @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- Password --}}
    <div class="mb-3">
      <label class="form-label">كلمة المرور</label>
      <input type="password"
             name="password"
             class="form-control @error('password') is-invalid @enderror"
             placeholder="********"
             required>
      @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- Confirm Password --}}
    <div class="mb-2">
      <label class="form-label">تأكيد كلمة المرور</label>
      <input type="password"
             name="password_confirmation"
             class="form-control"
             placeholder="********"
             required>
    </div>

    <div class="form-footer">
      <button type="submit" class="btn btn-primary w-100">إنشاء الحساب</button>
    </div>
  </div>

  <div class="card-footer text-center">
    لديك حساب؟ <a href="{{ route('login') }}">تسجيل الدخول</a>
  </div>
</form>
@endsection
