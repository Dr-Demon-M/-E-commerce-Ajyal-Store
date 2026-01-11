@props([
        'name',
        'options' => [],
        'checked' => null,
        'label' => null])


<label class="form-label small fw-bold text-muted text-uppercase">{{ $label }}</label>


@foreach ($options as $value => $text)
    <div class="form-check">
        <input class="form-check-input @error($name) is-invalid @enderror" type="radio" name="{{ $name }}"
            value="{{ $value }}" {{ old($name, $checked) == $value ? 'checked' : '' }}>

        <label class="form-check-label">{{ $text }}</label>
    </div>
@endforeach

@error($name)
    <div class="invalid-feedback d-block">{{ $message }}</div>
@enderror
