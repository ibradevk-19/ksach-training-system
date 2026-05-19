@extends('layouts.app')

@section('content')
<div class="container-xl">
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">إنشاء نموذج مسار</h2>
      </div>
    </div>
  </div>

  @include('partials.alerts')

  <form action="{{ route('admin.forms.store') }}" method="POST">
    @csrf
    @include('admin.forms.form', ['button' => 'إنشاء'])
  </form>
</div>
@endsection
