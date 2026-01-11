@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300',
'style'=> "color: #6c757d !important; display: block; margin-bottom: 5px;"]) }}>
    {{ $value ?? $slot }}
</label>
