@extends('layouts.app')

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">إنشاء طلب جديد</h2>
      </div>
    </div>
  </div>

  @include('partials.alerts')

  <form action="{{ route('admin.applications.store') }}" method="POST">
    @csrf

    <div class="card">
      <div class="card-body">
        <div class="row">

          <div class="col-md-6 mb-3">
            <label class="form-label">المتقدم</label>
            <select name="applicant_id" class="form-select @error('applicant_id') is-invalid @enderror">
              <option value="">اختر المتقدم</option>
              @foreach($applicants as $applicant)
                <option value="{{ $applicant->id }}" {{ old('applicant_id') == $applicant->id ? 'selected' : '' }}>
                  {{ $applicant->full_name }} - {{ $applicant->national_id }}
                </option>
              @endforeach
            </select>
            @error('applicant_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label">المسار</label>
            <select name="track_id" class="form-select @error('track_id') is-invalid @enderror">
              <option value="">اختر المسار</option>
              @foreach($tracks as $track)
                <option value="{{ $track->id }}" {{ old('track_id') == $track->id ? 'selected' : '' }}>
                  {{ $track->title }}
                </option>
              @endforeach
            </select>
            @error('track_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-12 mb-3">
            <label class="form-label">ملاحظات</label>
            <textarea name="notes" rows="4" class="form-control">{{ old('notes') }}</textarea>
          </div>

        </div>
      </div>

      <div class="card-footer text-end">
        <a href="{{ route('admin.applications.index') }}" class="btn btn-light">رجوع</a>
        <button class="btn btn-primary">حفظ الطلب</button>
      </div>
    </div>

  </form>

</div>
@endsection
