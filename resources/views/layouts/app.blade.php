<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'لوحة التحكم')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="page">

  @include('admin.partials.sidebar')

  <div class="page-wrapper">
    @include('admin.partials.topbar')

    <div class="page-body">
      <div class="container-xl">

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
          </div>
        @endif

        @yield('content')
      </div>
    </div>

    <footer class="footer footer-transparent d-print-none">
      <div class="container-xl">
        <div class="text-center text-muted">© {{ date('Y') }} "نظام ادارة مشروع التمكين الاقتصادي"</div>
      </div>
    </footer>

  </div>
</div>

@stack('scripts')

</body>
</html>
