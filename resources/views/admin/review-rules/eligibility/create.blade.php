@extends('layouts.app')

@section('content')
<div class="container-xl">
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">إضافة قاعدة أهلية</h2>
      </div>
    </div>
  </div>

  @include('partials.alerts')

  <form action="{{ route('admin.eligibility-rules.store') }}" method="POST">
    @csrf
    @include('admin.review-rules.eligibility.form', ['button' => 'إضافة'])
  </form>
</div>
@endsection
