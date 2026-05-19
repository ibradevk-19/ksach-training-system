@extends('layouts.app')

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">إضافة متقدم</h2>
      </div>
    </div>
  </div>

  @include('partials.alerts')

  <form action="{{ route('admin.applicants.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @include('admin.applicants.form', [
      'button' => 'حفظ'
    ])
  </form>

</div>
@endsection
