@extends('layouts.public')

@php
    $genderLabels = [
        'male' => 'ذكور فقط',
        'female' => 'إناث فقط',
        'both' => 'الجميع',
    ];

    $fallbackImage = 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1200&q=80';
@endphp

@section('title', $track->title)

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

    .track-show-page {
        padding: 112px 0 86px;
    }

    .detail-hero {
        position: relative;
        overflow: hidden;
        min-height: 430px;
        border-radius: 34px;
        color: #fff;
        box-shadow: var(--shadow-deep);
        margin-bottom: 30px;
    }

    .detail-hero img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .detail-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(15, 94, 89, .94), rgba(15, 118, 110, .78), rgba(15, 23, 42, .24));
    }

    .detail-hero-content {
        position: relative;
        z-index: 2;
        max-width: 780px;
        padding: 52px;
    }

    .detail-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 16px;
        border-radius: 999px;
        background: rgba(255, 255, 255, .16);
        font-weight: 900;
        margin-bottom: 18px;
    }

    .detail-title {
        font-size: 3rem;
        font-weight: 900;
        line-height: 1.25;
        margin-bottom: 16px;
    }

    .detail-description {
        color: rgba(255, 255, 255, .86);
        line-height: 2;
        font-size: 1.06rem;
        margin-bottom: 26px;
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
        background: rgba(255, 255, 255, .90);
        color: var(--primary-dark);
        border: 1px solid rgba(15, 118, 110, .18);
    }

    .info-card,
    .content-card {
        background: rgba(255, 255, 255, .94);
        border: 1px solid rgba(15, 23, 42, .06);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-soft);
    }

    .content-card {
        padding: 34px;
    }

    .content-card h2,
    .info-card h2 {
        font-size: 1.25rem;
        font-weight: 900;
        margin-bottom: 16px;
    }

    .track-copy {
        color: #334155;
        line-height: 2.1;
        font-size: 1.02rem;
    }

    .info-card {
        position: sticky;
        top: 96px;
        padding: 28px;
    }

    .fact-list {
        display: grid;
        gap: 12px;
        margin-bottom: 24px;
    }

    .fact-item {
        display: flex;
        justify-content: space-between;
        gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid rgba(100, 116, 139, .14);
    }

    .fact-item span {
        color: var(--muted);
        font-weight: 800;
    }

    .fact-item strong {
        color: var(--dark);
        text-align: end;
    }

    .tag-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 22px;
    }

    .tag-list span {
        background: #f1f5f9;
        color: #334155;
        border-radius: 999px;
        padding: 7px 12px;
        font-size: .83rem;
        font-weight: 800;
    }

    @media (max-width: 991px) {
        .track-show-page {
            padding-top: 92px;
        }

        .detail-title {
            font-size: 2.25rem;
        }

        .info-card {
            position: static;
        }
    }

    @media (max-width: 575px) {
        .track-show-page {
            padding: 84px 0 58px;
        }

        .detail-hero {
            border-radius: 24px;
            min-height: 440px;
        }

        .detail-hero-content {
            padding: 30px 22px;
        }

        .detail-title {
            font-size: 1.8rem;
        }

        .content-card,
        .info-card {
            padding: 24px;
            border-radius: 22px;
        }
    }
</style>

<main class="track-show-page">
    <div class="container-xl">
        @include('partials.alerts')

        <section class="detail-hero">
            <img src="{{ $track->thumbnail ? asset('storage/'.$track->thumbnail) : $fallbackImage }}" alt="{{ $track->title }}">
            <div class="detail-hero-content">
                <span class="detail-kicker">{{ $track->category?->name ?? 'مسار تدريبي' }}</span>
                <h1 class="detail-title">{{ $track->title }}</h1>
                <p class="detail-description">
                    {{ $track->short_description ?: \Illuminate\Support\Str::limit(strip_tags($track->description), 190) }}
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('public.tracks.apply', $track) }}" class="btn btn-gradient">قدّم الآن</a>
                    <a href="{{ route('public.tracks.index') }}" class="btn btn-outline-soft">كل المسارات</a>
                </div>
            </div>
        </section>

        <div class="row g-4 align-items-start">
            <div class="col-lg-8">
                <article class="content-card">
                    <div class="tag-list">
                        @if($track->type)
                            <span>{{ $track->type->name }}</span>
                        @endif
                        @if($track->category)
                            <span>{{ $track->category->name }}</span>
                        @endif
                        <span>{{ $genderLabels[$track->gender] ?? 'الجميع' }}</span>
                    </div>

                    <h2>تفاصيل المسار</h2>
                    <div class="track-copy">
                        {!! nl2br(e($track->description ?: $track->short_description)) !!}
                    </div>
                </article>
            </div>

            <div class="col-lg-4">
                <aside class="info-card">
                    <h2>بيانات المسار</h2>
                    <div class="fact-list">
                        <div class="fact-item">
                            <span>عدد المقاعد</span>
                            <strong>{{ $track->seats ?? 0 }} مقعد</strong>
                        </div>
                        <div class="fact-item">
                            <span>الجنس</span>
                            <strong>{{ $genderLabels[$track->gender] ?? 'الجميع' }}</strong>
                        </div>
                        <div class="fact-item">
                            <span>العمر</span>
                            <strong>{{ $track->min_age ?? '-' }} - {{ $track->max_age ?? '-' }}</strong>
                        </div>
                        <div class="fact-item">
                            <span>بداية التسجيل</span>
                            <strong>{{ $track->registration_start?->format('Y-m-d') ?? '-' }}</strong>
                        </div>
                        <div class="fact-item">
                            <span>نهاية التسجيل</span>
                            <strong>{{ $track->registration_end?->format('Y-m-d') ?? '-' }}</strong>
                        </div>
                        <div class="fact-item">
                            <span>بداية التدريب</span>
                            <strong>{{ $track->start_date?->format('Y-m-d') ?? '-' }}</strong>
                        </div>
                    </div>

                    <a href="{{ route('public.tracks.apply', $track) }}" class="btn btn-gradient w-100">ابدأ التقديم</a>
                </aside>
            </div>
        </div>
    </div>
</main>
@endsection
