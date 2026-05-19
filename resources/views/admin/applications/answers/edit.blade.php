@extends('layouts.app')

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">تعبئة نموذج الطلب</h2>
        <div class="text-muted">
          {{ $application->application_number }} - {{ $application->track?->title }}
        </div>
      </div>
    </div>
  </div>

  @include('partials.alerts')

  @php
    $answers = $application->answers->keyBy('form_field_id');
    $files = $application->files->keyBy('form_field_id');
  @endphp

  <form action="{{ route('admin.applications.answers.update', $application) }}" method="POST" enctype="multipart/form-data">
    @csrf

    @foreach($form->sections as $section)
      <div class="card mb-3">
        <div class="card-header">
          <h3 class="card-title">{{ $section->title }}</h3>
        </div>

        <div class="card-body">
          <div class="row">

            @foreach($section->fields->where('status', true) as $field)
              @php
                $value = old('answers.'.$field->id, $answers[$field->id]->answer ?? '');
              @endphp

              <div class="col-md-{{ $field->width }} mb-3">
                <label class="form-label">
                  {{ $field->label }}
                  @if($field->is_required)
                    <span class="text-danger">*</span>
                  @endif
                </label>

                @if($field->type === 'text')
                  <input type="text" name="answers[{{ $field->id }}]" value="{{ $value }}" class="form-control" placeholder="{{ $field->placeholder }}">

                @elseif($field->type === 'number')
                  <input type="number" name="answers[{{ $field->id }}]" value="{{ $value }}" class="form-control">

                @elseif($field->type === 'date')
                  <input type="date" name="answers[{{ $field->id }}]" value="{{ $value }}" class="form-control">

                @elseif($field->type === 'textarea')
                  <textarea name="answers[{{ $field->id }}]" rows="3" class="form-control" placeholder="{{ $field->placeholder }}">{{ $value }}</textarea>

                @elseif($field->type === 'select')
                  <select name="answers[{{ $field->id }}]" class="form-select">
                    <option value="">اختر</option>
                    @foreach($field->options ?? [] as $option)
                      <option value="{{ $option }}" {{ $value == $option ? 'selected' : '' }}>
                        {{ $option }}
                      </option>
                    @endforeach
                  </select>

                @elseif($field->type === 'radio')
                  @foreach($field->options ?? [] as $option)
                    <label class="form-check">
                      <input type="radio" name="answers[{{ $field->id }}]" value="{{ $option }}" class="form-check-input" {{ $value == $option ? 'checked' : '' }}>
                      <span class="form-check-label">{{ $option }}</span>
                    </label>
                  @endforeach

                @elseif($field->type === 'checkbox')
                  @php
                    $selected = $value ? json_decode($value, true) : [];
                    if (!is_array($selected)) $selected = [];
                  @endphp

                  @foreach($field->options ?? [] as $option)
                    <label class="form-check">
                      <input type="checkbox" name="answers[{{ $field->id }}][]" value="{{ $option }}" class="form-check-input"
                             {{ in_array($option, $selected) ? 'checked' : '' }}>
                      <span class="form-check-label">{{ $option }}</span>
                    </label>
                  @endforeach

                @elseif($field->type === 'file')
                  <input type="file" name="answers[{{ $field->id }}]" class="form-control">

                  @if(isset($files[$field->id]))
                    <a href="{{ asset('storage/'.$files[$field->id]->file_path) }}" target="_blank" class="btn btn-link mt-2">
                      عرض الملف الحالي
                    </a>
                  @endif
                @endif

                @error('answers.'.$field->id)
                  <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
              </div>
            @endforeach

          </div>
        </div>
      </div>
    @endforeach

    <div class="card">
      <div class="card-footer text-end">
        <a href="{{ route('admin.applications.show', $application) }}" class="btn btn-light">رجوع</a>
        <button class="btn btn-primary">حفظ الإجابات</button>
      </div>
    </div>

  </form>

</div>
@endsection
