@props([
    'name',
    'options' => [],
    'selected' => null, 
    'label' => null])

@if ($label)
<label for="{{ $name }}" class="form-label small fw-bold text-muted text-uppercase">{{ $label }}</label>
@endif


<select name="{{ $name }}" style="font-size: medium;"
    {{ $attributes->class(['form-control form-control-lg  bg-light shadow-none', 'is-invalid' => $errors->has($name)]) }}>
    <option value="" selected disabled>Choose...</option>
    @foreach ($options as $value => $text)
        <option value="{{ $text }}" {{-- @selected(old($name, $selected) == $value) --}}>
            {{ $text }}
        </option>
    @endforeach
</select>

@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
