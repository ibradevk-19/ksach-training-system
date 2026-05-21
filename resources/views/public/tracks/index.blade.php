@extends('layouts.public')

@php
    $genderLabels = [
        'male' => 'ذكور فقط',
        'female' => 'إناث فقط',
        'both' => 'الجميع',
    ];

    $fallbackImage = 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1200&q=80';
@endphp

@section('title', 'المسارات التدريبية')

@section('content')
<style>
    :root {
        --primary: #0f766e;
        --primary-2: #14b8a6;
        --primary-dark: #115e59;
        --secondary: #f59e0b;
        --blue: #2563eb;
        --dark: #0f172a;
        --muted: #64748b;
        --light: #f8fafc;
        --soft: #f0fdfa;
        --white: #ffffff;
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

    .tracks-page {
        padding: 112px 0 86px;
    }

    .tracks-hero {
        overflow: hidden;
        border-radius: 34px;
        background:
            radial-gradient(circle at 12% 18%, rgba(255, 255, 255, .22), transparent 24%),
            linear-gradient(135deg, var(--primary-dark), var(--primary), #0d9488);
        color: #fff;
        box-shadow: var(--shadow-deep);
        margin-bottom: 34px;
    }

    .tracks-hero-content {
        padding: 46px;
    }

    .tracks-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 16px;
        border-radius: 999px;
        background: rgba(255, 255, 255, .16);
        color: #fff;
        font-weight: 900;
        margin-bottom: 18px;
    }

    .tracks-title {
        font-size: 3rem;
        font-weight: 900;
        line-height: 1.25;
        margin-bottom: 14px;
    }

    .tracks-description {
        color: rgba(255, 255, 255, .84);
        font-size: 1.05rem;
        line-height: 2;
        max-width: 760px;
        margin-bottom: 0;
    }

    .tracks-hero-image {
        min-height: 100%;
        height: 330px;
        width: 100%;
        object-fit: cover;
        display: block;
    }

    .tracks-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-bottom: 32px;
    }

    .summary-item {
        background: rgba(255, 255, 255, .88);
        border: 1px solid rgba(15, 118, 110, .10);
        border-radius: var(--radius-md);
        padding: 20px;
        box-shadow: var(--shadow-soft);
    }

    .summary-item strong {
        display: block;
        color: var(--primary-dark);
        font-size: 1.65rem;
        font-weight: 900;
    }

    .summary-item span {
        color: var(--muted);
        font-weight: 800;
    }

    .track-card {
        position: relative;
        height: 100%;
        overflow: hidden;
        background: #fff;
        border: 1px solid rgba(15, 23, 42, .06);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-soft);
        transition: .25s ease;
    }

    .track-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-deep);
        border-color: rgba(15, 118, 110, .20);
    }

    .track-card::before {
        content: "";
        position: absolute;
        top: 0;
        inset-inline-start: 0;
        width: 100%;
        height: 6px;
        background: var(--gradient-main);
        z-index: 2;
    }

    .track-image {
        width: 100%;
        height: 210px;
        object-fit: cover;
        display: block;
    }

    .track-body {
        padding: 26px;
    }

    .track-chip {
        display: inline-flex;
        align-items: center;
        border-radius: 999px;
        padding: 7px 12px;
        background: rgba(15, 118, 110, .10);
        color: var(--primary-dark);
        font-size: .84rem;
        font-weight: 900;
        margin-bottom: 12px;
    }

    .track-card h2 {
        font-size: 1.24rem;
        font-weight: 900;
        line-height: 1.55;
        margin-bottom: 10px;
    }

    .track-card p {
        color: var(--muted);
        line-height: 1.9;
        min-height: 76px;
        margin-bottom: 18px;
    }

    .track-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 22px;
    }

    .track-meta span {
        background: #f1f5f9;
        color: #334155;
        border-radius: 999px;
        padding: 7px 12px;
        font-size: .83rem;
        font-weight: 800;
    }

    .track-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .btn-gradient,
    .btn-outline-soft {
        min-height: 46px;
        border-radius: 999px;
        font-weight: 900;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        white-space: normal;
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

    .empty-box {
        background: #fff;
        border: 1px solid rgba(15, 23, 42, .06);
        border-radius: var(--radius-lg);
        padding: 54px 24px;
        text-align: center;
        box-shadow: var(--shadow-soft);
    }

    @media (max-width: 991px) {
        .tracks-page {
            padding-top: 92px;
        }

        .tracks-title {
            font-size: 2.25rem;
        }

        .tracks-summary {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 575px) {
        .tracks-page {
            padding: 84px 0 58px;
        }

        .tracks-hero {
            border-radius: 24px;
        }

        .tracks-hero-content {
            padding: 28px 22px;
        }

        .tracks-title {
            font-size: 1.8rem;
        }

        .track-actions {
            grid-template-columns: 1fr;
        }
    }
</style>

<main class="tracks-page">
    <div class="container-xl">
        @include('partials.alerts')

        <section class="tracks-hero">
            <div class="row g-0 align-items-stretch">
                <div class="col-lg-7">
                    <div class="tracks-hero-content">
                        <span class="tracks-kicker">المسارات التدريبية</span>
                        <h1 class="tracks-title">اختر المسار الأقرب لمهارتك وفرصتك القادمة</h1>
                        <p class="tracks-description">
                            استعرض المسارات المتاحة، قارن المقاعد والفئة المناسبة، ثم انتقل إلى صفحة التفاصيل أو ابدأ التقديم مباشرة.
                        </p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <img class="tracks-hero-image" src="{{ $fallbackImage }}" alt="متدربون في جلسة تدريبية">
                </div>
            </div>
        </section>

        <div class="tracks-summary">
            <div class="summary-item">
                <strong>{{ $tracks->count() }}</strong>
                <span>مسار متاح</span>
            </div>
            <div class="summary-item">
                <strong>{{ number_format($tracks->sum('seats')) }}</strong>
                <span>مقعد تدريبي</span>
            </div>
            <div class="summary-item">
                <strong>{{ $tracks->pluck('category.name')->filter()->unique()->count() }}</strong>
                <span>تصنيف تدريبي</span>
            </div>
        </div>

        <div class="row g-4">
            @forelse($tracks as $track)
                <div class="col-md-6 col-lg-4">
                    <article class="track-card">
                        <img
                            src="{{ $track->thumbnail ? asset('storage/'.$track->thumbnail) : $fallbackImage }}"
                            class="track-image"
                            alt="{{ $track->title }}"
                        >

                        <div class="track-body">
                            <span class="track-chip">{{ $track->category?->name ?? 'مسار تدريبي' }}</span>
                            <h2>{{ $track->title }}</h2>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($track->short_description ?: $track->description), 130) }}</p>

                            <div class="track-meta">
                                <span>{{ $track->seats ?? 0 }} مقعد</span>
                                <span>{{ $genderLabels[$track->gender] ?? 'الجميع' }}</span>
                                @if($track->min_age || $track->max_age)
                                    <span>{{ $track->min_age ?? '-' }} - {{ $track->max_age ?? '-' }} سنة</span>
                                @endif
                            </div>

                            <div class="track-actions">
                                <a href="{{ route('public.tracks.show', $track) }}" class="btn btn-outline-soft">التفاصيل</a>
                                <a href="{{ route('public.tracks.apply', $track) }}" class="btn btn-gradient">قدّم الآن</a>
                            </div>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-box">
                        <h2 class="mb-2">لا توجد مسارات متاحة حالياً</h2>
                        <p class="text-muted mb-0">سيتم عرض المسارات هنا عند فتح التسجيل.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</main>
@endsection
