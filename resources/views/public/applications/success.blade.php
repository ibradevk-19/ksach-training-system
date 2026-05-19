@extends('layouts.public')

@section('title', 'تم إرسال الطلب')

@section('content')
<div class="container-xl">

    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card text-center">
                <div class="card-body py-5">

                    <div class="mb-4">
                        <span class="avatar avatar-xl bg-success text-white">
                            ✓
                        </span>
                    </div>

                    <h1 class="mb-3">تم إرسال طلبك بنجاح</h1>

                    <p class="text-muted">
                        يرجى الاحتفاظ برقم الطلب لاستخدامه لاحقاً في متابعة حالة الطلب.
                    </p>

                    <div class="alert alert-success">
                        رقم الطلب:
                        <strong>{{ $application->application_number }}</strong>
                    </div>

                    <div class="mb-3">
                        <strong>المسار:</strong>
                        {{ $application->track?->title }}
                    </div>

                    <div class="mb-3">
                        <strong>اسم المتقدم:</strong>
                        {{ $application->applicant?->full_name }}
                    </div>

                    <a href="{{ route('public.tracks.index') }}" class="btn btn-primary">
                        العودة للمسارات
                    </a>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection