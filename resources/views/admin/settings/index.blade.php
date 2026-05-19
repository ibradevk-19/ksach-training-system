@extends('layouts.app')

@section('content')

<div class="container-xl">

  <div class="page-header d-print-none">

    <div class="row align-items-center">

      <div class="col">
        <h2 class="page-title">
          إعدادات النظام
        </h2>
      </div>

    </div>

  </div>

  <form action="{{ route('admin.settings.update') }}"
        method="POST"
        enctype="multipart/form-data">

    @csrf

    <div class="row">

      <!-- General -->

      <div class="col-md-8">

        <div class="card mb-3">

          <div class="card-header">
            <h3 class="card-title">
              الإعدادات العامة
            </h3>
          </div>

          <div class="card-body">

            <div class="row">

              <div class="col-md-6 mb-3">

                <label class="form-label">
                  اسم المشروع
                </label>

                <input type="text"
                       name="project_name"
                       value="{{ $settings['project_name'] ?? '' }}"
                       class="form-control">

              </div>

              <div class="col-md-6 mb-3">

                <label class="form-label">
                  البريد الإلكتروني
                </label>

                <input type="email"
                       name="project_email"
                       value="{{ $settings['project_email'] ?? '' }}"
                       class="form-control">

              </div>

              <div class="col-md-6 mb-3">

                <label class="form-label">
                  رقم التواصل
                </label>

                <input type="text"
                       name="project_phone"
                       value="{{ $settings['project_phone'] ?? '' }}"
                       class="form-control">

              </div>

            </div>

          </div>

        </div>
        <div class="col-md-6 mb-3">
    <label class="form-label">
        السماح للمتقدم بالتقديم لأكثر من مسار
    </label>

    <select name="allow_multiple_applications" class="form-select">
        <option value="0" {{ ($settings['allow_multiple_applications'] ?? 0) == 0 ? 'selected' : '' }}>
            لا، مسار واحد فقط
        </option>

        <option value="1" {{ ($settings['allow_multiple_applications'] ?? 0) == 1 ? 'selected' : '' }}>
            نعم، أكثر من مسار
        </option>
    </select>
</div>

        <!-- SMS -->

        <div class="card mb-3">

          <div class="card-header">
            <h3 class="card-title">
              إعدادات SMS
            </h3>
          </div>

          <div class="card-body">

            <div class="row">

              <div class="col-md-4 mb-3">

                <label class="form-label">
                  مزود الخدمة
                </label>

                <input type="text"
                       name="sms_provider"
                       value="{{ $settings['sms_provider'] ?? '' }}"
                       class="form-control">

              </div>

              <div class="col-md-4 mb-3">

                <label class="form-label">
                  Username
                </label>

                <input type="text"
                       name="sms_username"
                       value="{{ $settings['sms_username'] ?? '' }}"
                       class="form-control">

              </div>

              <div class="col-md-4 mb-3">

                <label class="form-label">
                  Password
                </label>

                <input type="password"
                       name="sms_password"
                       value="{{ $settings['sms_password'] ?? '' }}"
                       class="form-control">

              </div>

            </div>

          </div>

        </div>

      </div>

      <!-- Logo -->

      <div class="col-md-4">

        <div class="card">

          <div class="card-header">
            <h3 class="card-title">
              شعار النظام
            </h3>
          </div>

          <div class="card-body text-center">

            @if(isset($settings['project_logo']))

              <img src="{{ asset('storage/'.$settings['project_logo']) }}"
                   class="img-fluid mb-3"
                   style="max-height:200px">

            @endif

            <input type="file"
                   name="project_logo"
                   class="form-control">

          </div>

        </div>

      </div>

    </div>

    <div class="card mt-3">

      <div class="card-body text-end">

        <button class="btn btn-primary">
          حفظ الإعدادات
        </button>

      </div>

    </div>

  </form>

</div>

@endsection