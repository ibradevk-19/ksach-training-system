@extends('layouts.app')

@section('content')
<div class="container-xl">
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">إضافة تصنيف مسار</h2>
      </div>
    </div>
  </div>

  <form action="{{ route('admin.track-categories.store') }}" method="POST">
    @csrf
    @include('admin.track-categories.form', ['button' => 'إضافة'])
  </form>
</div>
@endsection
