<header class="navbar navbar-expand-md d-print-none">
  <div class="container-xl">
    <div class="navbar-nav flex-row order-md-last">
      <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown">
          <div class="d-none d-xl-block ps-2">
            <div>{{ auth()->user()->name }}</div>
            <div class="mt-1 small text-muted">{{ auth()->user()->email }}</div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="dropdown-item">تسجيل خروج</button>
          </form>
        </div>
      </div>
    </div>

    <div class="collapse navbar-collapse">
      <h2 class="page-title">@yield('page_title', 'لوحة التحكم')</h2>
    </div>
  </div>
</header>
