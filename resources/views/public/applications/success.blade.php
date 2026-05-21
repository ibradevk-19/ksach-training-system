@extends('layouts.public')

@section('title', 'تم إرسال الطلب')

@section('content')
<style>
    :root {
        --primary: #0f766e;
        --primary-2: #14b8a6;
        --primary-dark: #115e59;
        --secondary: #f59e0b;
        --dark: #0f172a;
        --muted: #64748b;
        --light: #f8fafc;
        --soft: #f0fdfa;
        --radius-md: 20px;
        --radius-lg: 28px;
        --shadow-soft: 0 14px 45px rgba(15, 23, 42, .07);
        --shadow-deep: 0 26px 80px rgba(15, 23, 42, .13);
        --gradient-main: linear-gradient(135deg, #0f766e 0%, #14b8a6 55%, #22c55e 100%);
    }

    body {
        background:
            radial-gradient(circle at 10% 8%, rgba(20, 184, 166, .18), transparent 26%),
            radial-gradient(circle at 88% 2%, rgba(245, 158, 11, .13), transparent 24%),
            linear-gradient(180deg, #ffffff 0%, #ecfeff 360px, var(--light) 100%);
        color: var(--dark);
    }

    .navbar {
        background: rgba(255, 255, 255, .90);
        backdrop-filter: blur(18px);
        box-shadow: 0 12px 40px rgba(15, 23, 42, .06);
    }

    .success-page {
        padding: 112px 0 86px;
    }

    .success-card {
        overflow: hidden;
        background: rgba(255, 255, 255, .94);
        border: 1px solid rgba(15, 23, 42, .06);
        border-radius: 34px;
        box-shadow: var(--shadow-deep);
    }

    .success-visual {
        height: 100%;
        min-height: 430px;
        background:
            radial-gradient(circle at 18% 18%, rgba(255, 255, 255, .24), transparent 28%),
            linear-gradient(135deg, var(--primary-dark), var(--primary), #0d9488);
        color: #fff;
        padding: 42px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .success-mark {
        width: 82px;
        height: 82px;
        border-radius: 28px;
        background: rgba(255, 255, 255, .18);
        border: 1px solid rgba(255, 255, 255, .28);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: 900;
        margin-bottom: 24px;
    }

    .success-visual h1 {
        font-size: 2.45rem;
        font-weight: 900;
        line-height: 1.35;
        margin-bottom: 14px;
    }

    .success-visual p {
        color: rgba(255, 255, 255, .84);
        line-height: 2;
        margin-bottom: 0;
    }

    .success-body {
        padding: 44px;
    }

    .number-box {
        background: var(--soft);
        border: 1px solid rgba(15, 118, 110, .14);
        border-radius: var(--radius-md);
        padding: 22px;
        margin-bottom: 24px;
    }

    .number-box span {
        display: block;
        color: var(--muted);
        font-weight: 800;
        margin-bottom: 8px;
    }

    .number-box strong {
        color: var(--primary-dark);
        font-size: 1.9rem;
        font-weight: 900;
        word-break: break-word;
    }

    .success-list {
        display: grid;
        gap: 12px;
        margin-bottom: 28px;
    }

    .success-item {
        display: flex;
        justify-content: space-between;
        gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid rgba(100, 116, 139, .14);
    }

    .success-item span {
        color: var(--muted);
        font-weight: 800;
    }

    .success-item strong {
        text-align: end;
    }

    .btn-gradient,
    .btn-outline-soft {
        min-height: 48px;
        border-radius: 999px;
        padding: 12px 24px;
        font-weight: 900;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .btn-gradient {
        background: var(--gradient-main);
        color: #fff;
        border: 0;
        box-shadow: 0 18px 38px rgba(15, 118, 110, .24);
    }

    .btn-gradient:hover {
        color: #fff;
        transform: translateY(-2px);
    }

    .btn-outline-soft {
        background: rgba(255, 255, 255, .72);
        color: var(--primary-dark);
        border: 1px solid rgba(15, 118, 110, .20);
    }

    @media (max-width: 991px) {
        .success-page {
            padding-top: 92px;
        }
    }

    @media (max-width: 575px) {
        .success-page {
            padding: 84px 0 58px;
        }

        .success-card {
            border-radius: 24px;
        }

        .success-visual,
        .success-body {
            padding: 28px 22px;
        }

        .success-visual h1 {
            font-size: 1.9rem;
        }
    }
</style>

<main class="success-page">
    <div class="container-xl">
        <div class="success-card">
            <div class="row g-0">
                <div class="col-lg-5">
                    <section class="success-visual">
                        <div>
                            <div class="success-mark">✓</div>
                            <h1>تم إرسال طلبك بنجاح</h1>
                            <p>
                                تم استلام البيانات وإحالة الطلب للمراجعة. احتفظ برقم الطلب لاستخدامه عند الحاجة إلى المتابعة.
                            </p>
                        </div>
                        <div class="mt-4">
                            <span class="badge bg-white text-dark rounded-pill px-3 py-2">بوابة التمكين</span>
                        </div>
                    </section>
                </div>

                <div class="col-lg-7">
                    <section class="success-body">
                        <div class="number-box">
                            <span>رقم الطلب</span>
                            <strong>{{ $application->application_number }}</strong>
                        </div>

                        <div class="success-list">
                            <div class="success-item">
                                <span>المسار</span>
                                <strong>{{ $application->track?->title ?? '-' }}</strong>
                            </div>
                            <div class="success-item">
                                <span>اسم المتقدم</span>
                                <strong>{{ $application->applicant?->full_name ?? '-' }}</strong>
                            </div>
                            <div class="success-item">
                                <span>تاريخ الإرسال</span>
                                <strong>{{ $application->submitted_at?->format('Y-m-d H:i') ?? now()->format('Y-m-d H:i') }}</strong>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('public.tracks.index') }}" class="btn btn-gradient">العودة للمسارات</a>
                            @if($application->track)
                                <a href="{{ route('public.tracks.show', $application->track) }}" class="btn btn-outline-soft">عرض المسار</a>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
