@props([
    'name',
    'options' => [],
    'selected' => null, 
    'label' => null])

@if ($label)
<label for="{{ $name }}" class="form-label small fw-bold text-muted text-uppercase">{{ $label }}</label>
@endif


<select name="{{ $name }}"
    {{ $attributes->class(['form-select', 'is-invalid' => $errors->has($name)]) }}>
    @foreach ($options as $value => $text)
        <option value="{{ $value }}" @selected(old($name, $selected) == $value)>
            {{ $text }}
        </option>
    @endforeach
</select>

@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
