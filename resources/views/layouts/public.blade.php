<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>@yield('title', setting('project_name', 'بوابة التقديم'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
<div class="page">

 <header>
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('public.landing') }}" aria-label="بوابة التمكين">
        <span class="brand-logo">
          <i class="ti ti-school"></i>
        </span>
        <span>بوابة التمكين</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="فتح القائمة">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="{{ route('public.landing') }}#home">الرئيسية</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('public.landing') }}#about">عن المشروع</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('public.tracks.index') }}">المسارات</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('public.landing') }}#how">كيف تبدأ؟</a></li>
        </ul>

        
      </div>
    </div>
  </nav>
</header>


    <div class="page-wrapper">
        <div class="page-body">
            @yield('content')
        </div>

        <footer class="footer footer-transparent d-print-none">
            <div class="container-xl text-center text-muted">
                جميع الحقوق محفوظة © {{ date('Y') }}
            </div>
        </footer>
    </div>

</div>

@stack('scripts')
</body>
</html>
