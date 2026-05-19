@extends('layouts.app')

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">تعديل بيانات المتقدم</h2>
      </div>
    </div>
  </div>

  @include('partials.alerts')

  <form action="{{ route('admin.applicants.update', $applicant) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @include('admin.applicants.form', [
      'button' => 'تحديث'
    ])
  </form>

</div>
@endsection
