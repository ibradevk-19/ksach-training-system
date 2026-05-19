@extends('layouts.app')

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">تعديل الطلب</h2>
      </div>
    </div>
  </div>

  @include('partials.alerts')

  <form action="{{ route('admin.applications.update', $application) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card">
      <div class="card-body">

        <div class="row">

          <div class="col-md-4 mb-3">
            <label class="form-label">رقم الطلب</label>
            <input type="text" class="form-control" value="{{ $application->application_number }}" disabled>
          </div>

          <div class="col-md-4 mb-3">
            <label class="form-label">المتقدم</label>
            <input type="text" class="form-control" value="{{ $application->applicant?->full_name }}" disabled>
          </div>

          <div class="col-md-4 mb-3">
            <label class="form-label">المسار</label>
            <input type="text" class="form-control" value="{{ $application->track?->title }}" disabled>
          </div>

          <div class="col-md-4 mb-3">
            <label class="form-label">الحالة</label>
            <select name="status" class="form-select">
              <option value="submitted" {{ old('status', $application->status) == 'submitted' ? 'selected' : '' }}>مقدم</option>
              <option value="under_review" {{ old('status', $application->status) == 'under_review' ? 'selected' : '' }}>قيد المراجعة</option>
              <option value="accepted" {{ old('status', $application->status) == 'accepted' ? 'selected' : '' }}>مقبول</option>
              <option value="rejected" {{ old('status', $application->status) == 'rejected' ? 'selected' : '' }}>مرفوض</option>
              <option value="waiting_list" {{ old('status', $application->status) == 'waiting_list' ? 'selected' : '' }}>قائمة انتظار</option>
              <option value="cancelled" {{ old('status', $application->status) == 'cancelled' ? 'selected' : '' }}>ملغي</option>
            </select>
          </div>

          <div class="col-md-4 mb-3">
            <label class="form-label">الدرجة</label>
            <input type="number"
                   name="score"
                   min="0"
                   max="100"
                   value="{{ old('score', $application->score) }}"
                   class="form-control">
          </div>

          <div class="col-md-12 mb-3">
            <label class="form-label">ملاحظات</label>
            <textarea name="notes" rows="4" class="form-control">{{ old('notes', $application->notes) }}</textarea>
          </div>

        </div>

      </div>

      <div class="card-footer text-end">
        <a href="{{ route('admin.applications.index') }}" class="btn btn-light">رجوع</a>
        <button class="btn btn-primary">تحديث</button>
      </div>
    </div>

  </form>

</div>
@endsection
