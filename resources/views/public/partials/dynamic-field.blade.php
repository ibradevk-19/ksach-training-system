<label class="form-label">
    {{ $field->label }}

    @if($field->is_required)
        <span class="text-danger">*</span>
    @endif
</label>

@php
    $oldValue = old('answers.'.$field->id);
@endphp

@if($field->type === 'text')
    <input type="text"
           name="answers[{{ $field->id }}]"
           value="{{ $oldValue }}"
           placeholder="{{ $field->placeholder }}"
           class="form-control @error('answers.'.$field->id) is-invalid @enderror">

@elseif($field->type === 'number')
    <input type="number"
           name="answers[{{ $field->id }}]"
           value="{{ $oldValue }}"
           class="form-control @error('answers.'.$field->id) is-invalid @enderror">

@elseif($field->type === 'date')
    <input type="date"
           name="answers[{{ $field->id }}]"
           value="{{ $oldValue }}"
           class="form-control @error('answers.'.$field->id) is-invalid @enderror">

@elseif($field->type === 'textarea')
    <textarea name="answers[{{ $field->id }}]"
              rows="3"
              placeholder="{{ $field->placeholder }}"
              class="form-control @error('answers.'.$field->id) is-invalid @enderror">{{ $oldValue }}</textarea>

@elseif($field->type === 'select')
    <select name="answers[{{ $field->id }}]"
            class="form-select @error('answers.'.$field->id) is-invalid @enderror">
        <option value="">اختر</option>
        @foreach($field->options ?? [] as $option)
            <option value="{{ $option }}" {{ $oldValue == $option ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>

@elseif($field->type === 'radio')
    @foreach($field->options ?? [] as $option)
        <label class="form-check">
            <input type="radio"
                   name="answers[{{ $field->id }}]"
                   value="{{ $option }}"
                   class="form-check-input"
                   {{ $oldValue == $option ? 'checked' : '' }}>
            <span class="form-check-label">{{ $option }}</span>
        </label>
    @endforeach

@elseif($field->type === 'checkbox')
    @foreach($field->options ?? [] as $option)
        <label class="form-check">
            <input type="checkbox"
                   name="answers[{{ $field->id }}][]"
                   value="{{ $option }}"
                   class="form-check-input"
                   {{ is_array($oldValue) && in_array($option, $oldValue) ? 'checked' : '' }}>
            <span class="form-check-label">{{ $option }}</span>
        </label>
    @endforeach

@elseif($field->type === 'file')
    <input type="file"
           name="answers[{{ $field->id }}]"
           class="form-control @error('answers.'.$field->id) is-invalid @enderror">
@endif

@error('answers.'.$field->id)
    <div class="invalid-feedback d-block">{{ $message }}</div>
@enderror