@extends('layouts.public')

@section('title', 'المسارات التدريبية')

@section('content')
<div class="container-xl">

    @include('partials.alerts')

    <div class="text-center mb-5">
        <h1 class="display-6">
            المسارات التدريبية المتاحة
        </h1>

        <p class="text-muted">
            اختر المسار المناسب لك وابدأ التقديم.
        </p>
    </div>

    <div class="row row-cards">
        @forelse($tracks as $track)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">

                    @if($track->thumbnail)
                        <img src="{{ asset('storage/'.$track->thumbnail) }}" class="card-img-top" style="height:180px;object-fit:cover;">
                    @endif

                    <div class="card-body">
                        <h3 class="card-title">
                            {{ $track->title }}
                        </h3>

                        <p class="text-muted">
                            {{ $track->short_description }}
                        </p>

                        <div class="mb-2">
                            <span class="badge bg-blue">
                                {{ $track->category?->name ?? 'مسار تدريبي' }}
                            </span>

                            <span class="badge bg-green">
                                {{ $track->seats }} مقعد
                            </span>
                        </div>

                        <div class="text-muted">
                            الجنس:
                            @if($track->gender === 'male')
                                ذكور فقط
                            @elseif($track->gender === 'female')
                                إناث فقط
                            @else
                                الجميع
                            @endif
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="btn-list">
                            <a href="{{ route('public.tracks.show', $track) }}" class="btn btn-outline-primary">
                                التفاصيل
                            </a>

                            <a href="{{ route('public.tracks.apply', $track) }}" class="btn btn-primary">
                                قدّم الآن
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="empty-state text-center py-5">
                <p class="text-muted">لا توجد مسارات متاحة حالياً.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection