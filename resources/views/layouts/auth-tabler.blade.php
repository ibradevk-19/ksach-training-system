<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'تسجيل الدخول')</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="d-flex flex-column">
  <div class="page page-center">
    <div class="container container-tight py-4">
      {{-- Logo / Title --}}
      <div class="text-center mb-4">
        <a href="{{ url('/') }}" class="navbar-brand navbar-brand-autodark">
         المركز السعودي للثقافة والتراث | المنظومة الإلكتروني
        </a>
      </div>

      @yield('content')

      <div class="text-center text-muted mt-3">
        <small>© {{ date('Y') }} Ksach</small>
      </div>
    </div>
  </div>
</body>
</html>
