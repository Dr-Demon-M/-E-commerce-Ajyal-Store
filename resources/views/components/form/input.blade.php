@props([
    'name',
    'type' => 'text',
    'value' => null,
    'label' => null,
])
@if ($label)
<label for={{ $name }} class="form-label small fw-bold text-muted text-uppercase">{{ $label }}</label>
@endif
<input
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{old($name, $value)}}"
    {{ $attributes->class([
        'form-control',
    ]) }}
>

@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
