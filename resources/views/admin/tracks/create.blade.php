@extends('layouts.app')

@section('content')
<div class="container-xl">
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">إضافة مسار تدريبي</h2>
      </div>
    </div>
  </div>

  <form action="{{ route('admin.tracks.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.tracks.form', ['button' => 'إضافة'])
  </form>
</div>
@endsection
