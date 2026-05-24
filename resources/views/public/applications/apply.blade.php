@php
    $genderLabels = [
        'male' => 'ذكور فقط',
        'female' => 'إناث فقط',
        'both' => 'الجميع',
    ];
@endphp

@extends('layouts.public')

@section('title', 'التقديم على '.$track->title)

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
        --white: #ffffff;
        --radius-md: 20px;
        --radius-lg: 28px;
        --shadow-soft: 0 14px 45px rgba(15, 23, 42, .07);
        --shadow-deep: 0 26px 80px rgba(15, 23, 42, .13);
        --gradient-main: linear-gradient(135deg, #0f766e 0%, #14b8a6 55%, #22c55e 100%);
    }

    body {
        background:
            radial-gradient(circle at 10% 7%, rgba(20, 184, 166, .18), transparent 26%),
            radial-gradient(circle at 90% 2%, rgba(245, 158, 11, .14), transparent 24%),
            linear-gradient(180deg, #ffffff 0%, #ecfeff 360px, var(--light) 100%);
        color: var(--dark);
    }

    .navbar {
        background: rgba(255, 255, 255, .90);
        backdrop-filter: blur(18px);
        box-shadow: 0 12px 40px rgba(15, 23, 42, .06);
    }

    .navbar-brand {
        color: var(--dark);
        font-weight: 900;
    }

    .apply-page {
        padding: 72px 0 86px;
    }

    .apply-page .container-xl {
        max-width: 1240px;
    }

    .apply-hero {
        position: relative;
        overflow: hidden;
        border-radius: 34px;
        background:
            radial-gradient(circle at 12% 20%, rgba(255, 255, 255, .22), transparent 24%),
            linear-gradient(135deg, var(--primary-dark), var(--primary), #0d9488);
        color: #fff;
        padding: 52px;
        box-shadow: var(--shadow-deep);
        margin-bottom: 28px;
    }

    .apply-hero::after {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .12);
        left: -90px;
        bottom: -120px;
    }

    .apply-hero-content {
        position: relative;
        z-index: 2;
    }

    .apply-kicker {
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

    .apply-title {
        font-size: clamp(2rem, 4vw, 3.6rem);
        font-weight: 900;
        line-height: 1.25;
        margin-bottom: 14px;
    }

    .apply-description {
        color: rgba(255, 255, 255, .82);
        font-size: 1.04rem;
        line-height: 2;
        max-width: 780px;
        margin-bottom: 0;
    }

    .info-card,
    .apply-card {
        background: rgba(255, 255, 255, .94);
        border: 1px solid rgba(15, 23, 42, .06);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-soft);
    }

    .info-card {
        position: sticky;
        top: 24px;
        padding: 32px;
    }

    .info-card p {
        line-height: 1.9;
    }

    .info-card h3,
    .apply-card-title {
        font-size: 1.2rem;
        font-weight: 900;
        margin-bottom: 14px;
    }

    .track-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 18px 0;
    }

    .track-meta span {
        background: #f1f5f9;
        color: #334155;
        border-radius: 999px;
        padding: 7px 12px;
        font-size: .83rem;
        font-weight: 800;
    }

    .apply-card {
        padding: 38px;
        margin-bottom: 26px;
        overflow: hidden;
    }

    .apply-card > .row,
    .apply-card .row {
        --bs-gutter-x: 24px;
        --bs-gutter-y: 22px;
        margin-left: 0;
        margin-right: 0;
    }

    .apply-card [class*="col-"] {
        margin-bottom: 0 !important;
        min-width: 0;
    }

    .apply-card-head {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 22px;
        margin-bottom: 28px;
        border-bottom: 1px solid rgba(100, 116, 139, .16);
    }

    .apply-card-icon {
        width: 48px;
        height: 48px;
        border-radius: 17px;
        background: rgba(15, 118, 110, .11);
        color: var(--primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        flex-shrink: 0;
    }

    .apply-card-title {
        margin-bottom: 2px;
    }

    .apply-card-subtitle {
        color: var(--muted);
        font-size: .92rem;
        font-weight: 700;
        line-height: 1.7;
    }

    .form-label {
        display: inline-flex;
        flex-wrap: wrap;
        align-items: baseline;
        gap: 4px;
        max-width: 100%;
        padding: 0 2px;
        color: #334155;
        font-weight: 900;
        margin-bottom: 10px;
        line-height: 1.7;
        white-space: normal;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .form-label .text-danger {
        flex-shrink: 0;
        line-height: 1;
    }

    .form-control,
    .form-select {
        width: 100%;
        max-width: 100%;
        border-radius: 16px;
        border: 1px solid rgba(100, 116, 139, .22);
        padding: 12px 14px;
        min-height: 48px;
        box-shadow: none;
        transition: .2s ease;
    }

    .apply-card input,
    .apply-card select,
    .apply-card textarea {
        min-width: 0;
    }

    .apply-card .form-label,
    .apply-card .form-check-label,
    .invalid-feedback {
        max-width: 100%;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .invalid-feedback {
        margin-top: 7px;
        line-height: 1.6;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: rgba(15, 118, 110, .45);
        box-shadow: 0 0 0 .25rem rgba(20, 184, 166, .12);
    }

    textarea.form-control {
        min-height: 112px;
    }

    .form-check {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        padding: 0;
        margin-bottom: 10px;
        line-height: 1.8;
    }

    .form-check:last-child {
        margin-bottom: 0;
    }

    .form-check-input {
        float: none;
        margin: 4px 0 0;
        border-color: rgba(100, 116, 139, .35);
    }

    .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .btn-gradient {
        background: var(--gradient-main);
        color: #fff;
        border: 0;
        border-radius: 999px;
        padding: 13px 28px;
        font-weight: 900;
        box-shadow: 0 18px 38px rgba(15, 118, 110, .26);
        transition: all .25s ease;
    }

    .btn-gradient:hover {
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 24px 48px rgba(15, 118, 110, .34);
    }

    .btn-outline-soft {
        background: rgba(255, 255, 255, .72);
        color: var(--primary-dark);
        border: 1px solid rgba(15, 118, 110, .18);
        border-radius: 999px;
        padding: 13px 28px;
        font-weight: 900;
    }

    .btn-gradient,
    .btn-outline-soft {
        min-height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: normal;
        text-align: center;
    }

    .consent-card {
        background: var(--soft);
        border-color: rgba(15, 118, 110, .13);
    }

    .actions-bar {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 12px;
    }

    @media (max-width: 991px) {
        .apply-page {
            padding: 46px 0 64px;
        }

        .apply-hero {
            padding: 38px 30px;
            border-radius: 26px;
            margin-bottom: 24px;
        }

        .info-card {
            position: static;
            padding: 28px;
        }

        .apply-title {
            font-size: 2rem;
        }

        .apply-description {
            font-size: 1rem;
        }
    }

    @media (max-width: 767px) {
        .apply-page {
            padding: 34px 0 52px;
        }

        .apply-page .container-xl {
            padding-left: 18px;
            padding-right: 18px;
        }

        .apply-hero {
            padding: 30px 22px;
            border-radius: 22px;
        }

        .apply-kicker {
            padding: 8px 13px;
            margin-bottom: 14px;
        }

        .apply-title {
            font-size: 1.72rem;
            line-height: 1.35;
        }

        .info-card,
        .apply-card {
            border-radius: 22px;
            padding: 24px;
        }

        .info-card {
            margin-bottom: 4px;
        }

        .apply-card {
            margin-bottom: 22px;
        }

        .apply-card-head {
            align-items: flex-start;
            gap: 10px;
            padding-bottom: 18px;
            margin-bottom: 22px;
        }

        .apply-card-icon {
            width: 42px;
            height: 42px;
            border-radius: 15px;
            font-size: 22px;
        }

        .apply-card-title {
            font-size: 1.08rem;
            line-height: 1.5;
        }

        .apply-card-subtitle {
            font-size: .86rem;
        }

        .apply-card > .row,
        .apply-card .row {
            --bs-gutter-x: 0;
            --bs-gutter-y: 18px;
        }

        .form-label {
            font-size: .93rem;
            margin-bottom: 9px;
            line-height: 1.75;
        }

        .form-control,
        .form-select {
            border-radius: 14px;
            min-height: 46px;
            padding: 11px 13px;
            font-size: .95rem;
        }

        textarea.form-control {
            min-height: 104px;
        }

        .track-meta {
            gap: 7px;
            margin: 16px 0;
        }

        .track-meta span {
            font-size: .78rem;
            padding: 7px 10px;
        }

        .actions-bar {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .actions-bar .btn,
        .info-card .btn {
            width: 100%;
        }
    }

    @media (max-width: 420px) {
        .apply-page .container-xl {
            padding-left: 14px;
            padding-right: 14px;
        }

        .apply-hero,
        .info-card,
        .apply-card {
            border-radius: 18px;
            padding: 20px;
        }

        .apply-title {
            font-size: 1.5rem;
        }

        .apply-card-head {
            flex-direction: column;
        }
    }
</style>

<div class="apply-page">
    <div class="container-xl">
        <section class="apply-hero">
            <div class="apply-hero-content">
                <span class="apply-kicker">
                    <i class="ti ti-clipboard-text"></i>
                    نموذج التقديم
                </span>

                <h1 class="apply-title">التقديم على {{ $track->title }}</h1>

                <p class="apply-description">
                    يرجى تعبئة البيانات بدقة. سيتم استخدام هذه المعلومات لمراجعة أهليتك واختيار المتقدمين حسب معايير المسار.
                </p>
            </div>
        </section>

        @include('partials.alerts')

        <form action="{{ route('public.tracks.submit', $track) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4 align-items-start">
                <div class="col-lg-4">
                    <aside class="info-card">
                        <h3>ملخص المسار</h3>

                        <p class="text-muted mb-0">
                            {{ \Illuminate\Support\Str::limit(strip_tags($track->short_description ?: $track->description), 180) }}
                        </p>

                        <div class="track-meta">
                            @if($track->seats)
                                <span>{{ $track->seats }} مقعد</span>
                            @endif

                            @if($track->gender)
                                <span>{{ $genderLabels[$track->gender] ?? $track->gender }}</span>
                            @endif

                            @if($track->min_age || $track->max_age)
                                <span>{{ $track->min_age ?? '-' }}-{{ $track->max_age ?? '-' }} سنة</span>
                            @endif

                            @if($track->category)
                                <span>{{ $track->category->name }}</span>
                            @endif
                        </div>

                      
                    </aside>
                </div>

                <div class="col-lg-8">
                    <div class="apply-card">
                        <div class="apply-card-head">
                            <span class="apply-card-icon">
                                <i class="ti ti-user"></i>
                            </span>
                            <div>
                                <h2 class="apply-card-title">بيانات المتقدم الأساسية</h2>
                                <div class="apply-card-subtitle">الحقول المميزة بنجمة مطلوبة لإرسال الطلب</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">الاسم الرباعي <span class="text-danger">*</span></label>
                                <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control @error('full_name') is-invalid @enderror">
                                @error('full_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">رقم الهوية <span class="text-danger">*</span></label>
                                <input type="text" name="national_id" value="{{ old('national_id') }}" class="form-control @error('national_id') is-invalid @enderror">
                                @error('national_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">الجنس <span class="text-danger">*</span></label>
                                <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                    <option value="">اختر</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
                                </select>
                                @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">الحالة الاجتماعية</label>
                                <select name="marital_status" class="form-select">
                                    <option value="">اختر</option>
                                    <option value="husband" {{ old('marital_status') == 'husband' ? 'selected' : '' }}>الزوج</option>
                                    <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>أعزب</option>
                                    <option value="widow" {{ old('marital_status') == 'widow' ? 'selected' : '' }}>أرملة</option>
                                    <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>مطلقة</option>
                                    <option value="other" {{ old('marital_status') == 'other' ? 'selected' : '' }}>أخرى</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">رقم تواصل 1 <span class="text-danger">*</span></label>
                                <input type="text" name="phone_1" value="{{ old('phone_1') }}" class="form-control @error('phone_1') is-invalid @enderror">
                                @error('phone_1') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">رقم تواصل 2</label>
                                <input type="text" name="phone_2" value="{{ old('phone_2') }}" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">تاريخ الميلاد</label>
                                <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">المحافظة</label>
	                                <select name="governorate_id" class="form-select js-governorate-select">
                                    <option value="">اختر</option>
                                    @foreach($governorates as $governorate)
                                        <option value="{{ $governorate->id }}" {{ old('governorate_id') == $governorate->id ? 'selected' : '' }}>
                                            {{ $governorate->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

	                            <div class="col-md-3 mb-3">
	                                <label class="form-label">التجمع السكاني</label>
	                                <select name="population_community_id" class="form-select js-population-community-select @error('population_community_id') is-invalid @enderror" data-selected="{{ old('population_community_id') }}">
	                                    <option value="">اختر</option>
	                                </select>
	                                @error('population_community_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
	                            </div>

	                            <div class="col-md-3 mb-3">
                                <label class="form-label">الإقامة</label>
                                <select name="displacement_status" class="form-select">
                                    <option value="">اختر</option>
                                    <option value="resident" {{ old('displacement_status') == 'resident' ? 'selected' : '' }}>مقيم</option>
                                    <option value="displaced" {{ old('displacement_status') == 'displaced' ? 'selected' : '' }}>نازح</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">مكان الإقامة الحالي</label>
                                <select name="residence_type_id" class="form-select">
                                    <option value="">اختر</option>
                                    @foreach($residenceTypes as $type)
                                        <option value="{{ $type->id }}" {{ old('residence_type_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">عنوان السكن الحالي بالتفصيل</label>
                                <textarea name="current_address" rows="3" class="form-control">{{ old('current_address') }}</textarea>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">عدد أفراد الأسرة</label>
                                <input type="number" name="family_members_count" value="{{ old('family_members_count') }}" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">معيل الأسرة</label>
                                <select name="breadwinner_status" class="form-select">
                                    <option value="">اختر</option>
                                    <option value="husband" {{ old('breadwinner_status') == 'husband' ? 'selected' : '' }}>الزوج</option>
                                    <option value="single" {{ old('breadwinner_status') == 'single' ? 'selected' : '' }}>أعزب</option>
                                    <option value="widow" {{ old('breadwinner_status') == 'widow' ? 'selected' : '' }}>أرملة</option>
                                    <option value="divorced" {{ old('breadwinner_status') == 'divorced' ? 'selected' : '' }}>مطلقة</option>
                                    <option value="other" {{ old('breadwinner_status') == 'other' ? 'selected' : '' }}>أخرى</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">حالة العمل</label>
                                <select name="employment_status" class="form-select">
                                    <option value="">اختر</option>
                                    <option value="employed" {{ old('employment_status') == 'employed' ? 'selected' : '' }}>يعمل / تعمل</option>
                                    <option value="unemployed" {{ old('employment_status') == 'unemployed' ? 'selected' : '' }}>لا يعمل / لا تعمل</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">مستوى الدخل</label>
                                <select name="income_type_id" class="form-select">
                                    <option value="">اختر</option>
                                    @foreach($incomeTypes as $type)
                                        <option value="{{ $type->id }}" {{ old('income_type_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">المستوى التعليمي</label>
                                <select name="education_level" class="form-select">
                                    <option value="">اختر</option>
                                    <option value="none" {{ old('education_level') == 'none' ? 'selected' : '' }}>بدون</option>
                                    <option value="preparatory" {{ old('education_level') == 'preparatory' ? 'selected' : '' }}>شهادة ثالث إعدادي</option>
                                    <option value="secondary" {{ old('education_level') == 'secondary' ? 'selected' : '' }}>ثانوية عامة</option>
                                    <option value="diploma" {{ old('education_level') == 'diploma' ? 'selected' : '' }}>دبلوم</option>
                                    <option value="bachelor" {{ old('education_level') == 'bachelor' ? 'selected' : '' }}>بكالوريوس</option>
                                    <option value="master_or_above" {{ old('education_level') == 'master_or_above' ? 'selected' : '' }}>ماجستير فأعلى</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">التخصص</label>
                                <input type="text" name="specialization" value="{{ old('specialization') }}" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">الوضع الصحي</label>
                                <select name="health_status" class="form-select">
                                    <option value="">اختر</option>
                                    <option value="healthy" {{ old('health_status') == 'healthy' ? 'selected' : '' }}>سليم / سليمة</option>
                                    <option value="disabled" {{ old('health_status') == 'disabled' ? 'selected' : '' }}>ذوي إعاقة</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    @foreach($form->sections as $section)
                        @php
                            $activeFields = $section->fields
                                ->where('status', true);
                        @endphp

                        @continue($activeFields->isEmpty())

                        <div class="apply-card">
                            <div class="apply-card-head">
                                <span class="apply-card-icon">
                                    <i class="ti ti-forms"></i>
                                </span>
                                <div>
                                    <h2 class="apply-card-title">{{ $section->title }}</h2>
                                    <div class="apply-card-subtitle">أكمل بيانات هذا القسم حسب المطلوب</div>
                                </div>
                            </div>

                            <div class="row">
                                @foreach($activeFields as $field)
                                    <div class="col-md-{{ $field->width }} mb-3">
                                        @include('public.partials.dynamic-field', ['field' => $field])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div class="apply-card consent-card">
                        <label class="form-check">
                            <input type="checkbox" required class="form-check-input">
                            <span class="form-check-label">
                                أقر بأن جميع البيانات المدخلة صحيحة، وأوافق على مراجعة طلبي من قبل الإدارة.
                            </span>
                        </label>
                    </div>

                    <div class="actions-bar">
                        <a href="{{ route('public.tracks.show', $track) }}" class="btn btn-outline-soft">رجوع</a>
                        <button class="btn btn-gradient">
                            إرسال الطلب
                            <i class="ti ti-send ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@php
    $populationCommunitiesByGovernorate = $governorates->mapWithKeys(function ($governorate) {
        return [
            $governorate->id => $governorate->populationCommunities->map(function ($community) {
                return [
                    'id' => $community->id,
                    'name' => $community->name,
                ];
            })->values(),
        ];
    });
@endphp

<script>
	    document.addEventListener('DOMContentLoaded', function () {
	        const communitiesByGovernorate = @json($populationCommunitiesByGovernorate);

        const governorateSelect = document.querySelector('.js-governorate-select');
        const communitySelect = document.querySelector('.js-population-community-select');

        if (!governorateSelect || !communitySelect) {
            return;
        }

        function renderCommunities() {
            const selectedCommunity = communitySelect.dataset.selected || '';
            const communities = communitiesByGovernorate[governorateSelect.value] || [];

            communitySelect.innerHTML = '';
            communitySelect.add(new Option('اختر', ''));

            communities.forEach(function (community) {
                communitySelect.add(new Option(community.name, community.id, false, String(community.id) === String(selectedCommunity)));
            });

            communitySelect.disabled = communities.length === 0;
        }

        governorateSelect.addEventListener('change', function () {
            communitySelect.dataset.selected = '';
            renderCommunities();
        });

        renderCommunities();
    });
</script>
@endsection
