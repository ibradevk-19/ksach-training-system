<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="light">
  <div class="container-fluid">
    <h1 class="navbar-brand navbar-brand-autodark">
      <a href="{{ route('admin.dashboard') }}">التمكين الاقتصادي</a>
    </h1>

    <div class="collapse navbar-collapse show">
      <ul class="navbar-nav pt-lg-3">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <span class="nav-link-title">الرئيسية</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#applicationsMenu" role="button" aria-expanded="true" aria-controls="applicationsMenu">
            <span class="nav-link-title">إدارة الطلبات</span>
          </a>
          <ul class="navbar-nav ps-3 collapse show" id="applicationsMenu">
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.applicants.*') ? 'active' : '' }}" href="{{ route('admin.applicants.index') }}">
                <span class="nav-link-title">المتقدمين</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}" href="{{ route('admin.applications.index') }}">
                <span class="nav-link-title">طلبات الانضمام</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.rankings.*') ? 'active' : '' }}" href="{{ route('admin.rankings.index') }}">
                <span class="nav-link-title">ترتيب واعتماد الطلبات</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#tracksMenu" role="button" aria-expanded="true" aria-controls="tracksMenu">
            <span class="nav-link-title">المسارات والنماذج</span>
          </a>
          <ul class="navbar-nav ps-3 collapse show" id="tracksMenu">
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.tracks.*') ? 'active' : '' }}" href="{{ route('admin.tracks.index') }}">
                <span class="nav-link-title">المسارات التدريبية</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.forms.*') || request()->routeIs('admin.form-fields.*') || request()->routeIs('admin.form-sections.*') ? 'active' : '' }}" href="{{ route('admin.forms.index') }}">
                <span class="nav-link-title">نماذج المسارات</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.track-types.*') ? 'active' : '' }}" href="{{ route('admin.track-types.index') }}">
                <span class="nav-link-title">أنواع المسارات</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.track-categories.*') ? 'active' : '' }}" href="{{ route('admin.track-categories.index') }}">
                <span class="nav-link-title">تصنيفات المسارات</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#reviewRulesMenu" role="button" aria-expanded="true" aria-controls="reviewRulesMenu">
            <span class="nav-link-title">قواعد التقييم</span>
          </a>
          <ul class="navbar-nav ps-3 collapse show" id="reviewRulesMenu">
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.eligibility-rules.*') ? 'active' : '' }}" href="{{ route('admin.eligibility-rules.index') }}">
                <span class="nav-link-title">قواعد الأهلية</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.scoring-rules.*') ? 'active' : '' }}" href="{{ route('admin.scoring-rules.index') }}">
                <span class="nav-link-title">قواعد النقاط</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#reportsMenu" role="button" aria-expanded="true" aria-controls="reportsMenu">
            <span class="nav-link-title">التقارير</span>
          </a>
          <ul class="navbar-nav ps-3 collapse show" id="reportsMenu">
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.reports.applications.*') ? 'active' : '' }}" href="{{ route('admin.reports.applications.index') }}">
                <span class="nav-link-title">تقارير الطلبات</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.dashboard.analytics') }}">
                <span class="nav-link-title">لوحة التحليلات</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#generalSettingsMenu" role="button" aria-expanded="true" aria-controls="generalSettingsMenu">
            <span class="nav-link-title">الإعدادات العامة</span>
          </a>
          <ul class="navbar-nav ps-3 collapse show" id="generalSettingsMenu">
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                <span class="nav-link-title">إعدادات النظام</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.governorates.*') ? 'active' : '' }}" href="{{ route('admin.governorates.index') }}">
                <span class="nav-link-title">المحافظات</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.residence-types.*') ? 'active' : '' }}" href="{{ route('admin.residence-types.index') }}">
                <span class="nav-link-title">أنواع الإقامة</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.income-types.*') ? 'active' : '' }}" href="{{ route('admin.income-types.index') }}">
                <span class="nav-link-title">أنواع الدخل</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#accessManagementMenu" role="button" aria-expanded="true" aria-controls="accessManagementMenu">
            <span class="nav-link-title">إدارة الوصول</span>
          </a>
          <ul class="navbar-nav ps-3 collapse show" id="accessManagementMenu">
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                <span class="nav-link-title">المستخدمين</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                <span class="nav-link-title">الأدوار</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}" href="{{ route('admin.permissions.index') }}">
                <span class="nav-link-title">الصلاحيات</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</aside>
