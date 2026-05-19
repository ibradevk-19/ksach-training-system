@extends('layouts.public')

@section('title', $track->title)

@section('content')
<div class="container-xl">

    @include('partials.alerts')

    <div class="row row-cards">

        <div class="col-md-8">
            <div class="card">

                @if($track->thumbnail)
                    <img src="{{ asset('storage/'.$track->thumbnail) }}" class="card-img-top" style="max-height:320px;object-fit:cover;">
                @endif

                <div class="card-body">
                    <h1 class="card-title">{{ $track->title }}</h1>

                    <div class="mb-3">
                        <span class="badge bg-blue">
                            {{ $track->type?->name }}
                        </span>

                        <span class="badge bg-green">
                            {{ $track->category?->name }}
                        </span>
                    </div>

                    <p class="text-muted">
                        {{ $track->short_description }}
                    </p>

                    <hr>

                    <div>
                        {!! nl2br(e($track->description)) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">بيانات المسار</h3>
                </div>

                <div class="card-body">
                    <p><strong>عدد المقاعد:</strong> {{ $track->seats }}</p>

                    <p>
                        <strong>الجنس:</strong>
                        @if($track->gender === 'male')
                            ذكور فقط
                        @elseif($track->gender === 'female')
                            إناث فقط
                        @else
                            الجميع
                        @endif
                    </p>

                    <p><strong>العمر:</strong> {{ $track->min_age }} - {{ $track->max_age }}</p>

                    <p>
                        <strong>فترة التسجيل:</strong><br>
                        {{ $track->registration_start?->format('Y-m-d') ?? '-' }}
                        إلى
                        {{ $track->registration_end?->format('Y-m-d') ?? '-' }}
                    </p>

                    <a href="{{ route('public.tracks.apply', $track) }}" class="btn btn-primary w-100">
                        قدّم الآن
                    </a>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection