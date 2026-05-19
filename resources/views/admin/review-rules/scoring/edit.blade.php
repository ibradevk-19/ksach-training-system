@extends('layouts.app')

@section('content')
<div class="container-xl">
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">تعديل قاعدة نقاط</h2>
      </div>
    </div>
  </div>

  @include('partials.alerts')

  <form action="{{ route('admin.scoring-rules.update', $scoringRule) }}" method="POST">
    @csrf
    @method('PUT')
    @include('admin.review-rules.scoring.form', ['button' => 'تحديث'])
  </form>
</div>
@endsection
