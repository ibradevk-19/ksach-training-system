@extends('layouts.app')

@section('content')
<div class="container-xl">
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title"> Dashboard</h2>
      </div>
    </div>
  </div>

  <div class="empty-state text-center py-5">
    <p class="text-muted">الصفحة فارغة الآن. أضف العناصر المطلوبة أو أعد التحميل لاحقاً.</p>
  </div>
</div>
@endsection

@push('scripts')

@endpush
