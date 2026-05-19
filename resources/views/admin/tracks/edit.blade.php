@extends('layouts.app')

@section('content')
<div class="container-xl">
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">تعديل المسار التدريبي</h2>
      </div>
    </div>
  </div>

  <form action="{{ route('admin.tracks.update', $track) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.tracks.form', ['button' => 'تحديث'])
  </form>
</div>
@endsection
