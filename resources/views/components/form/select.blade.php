@props(['name', 'options' => [], 'selected' => null, 'label' => null])

@if ($label)
    <label for="{{ $name }}"
        class="form-label small fw-bold text-muted text-uppercase">{{ $label }}</label>
@endif


<select  style="font-size: 16px;" name="{{ $name }}" style=""
    {{ $attributes->class([
        'form-control form-control-lg bg-light shadow-none',
        'is-invalid' => $errors->has($name),
    ])  }}>

    <option value="" disabled {{ old($name, $selected) ? '' : 'selected' }}>
        Choose...
    </option>

    <option value="" @selected(old($name, $selected) ? '' : '')>
        NULL
    </option>
    @foreach ($options as $value => $text)
        <option value="{{ $value }}" @selected(old($name, $selected) == $value)>
            {{ $text }}
        </option>
    @endforeach
</select>


@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
