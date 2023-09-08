@props(['field', 'label', 'type', 'placeholder'])

<div class="input-field input-row">
    <input id="{{ $field }}" type="{{ $type }}"
           class="form-control @error($field) is-invalid @enderror"
           name="{{ $field }}" placeholder="{{ $placeholder }}"
           value="{{ old($field) }}" autocomplete="{{ $field }}" autofocus>
    <div>
        <label for="{{ $field }}" class="input-label">{{ $label }}</label>
        @error($field)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
