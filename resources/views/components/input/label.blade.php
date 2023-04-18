@props(['value'])
@props(['required' => false])
<label {{ $attributes->merge(['class' => 'text-sm font-medium text-gray-500 ml-1']) }}>
    {{ $value ?? $slot }} 
    @if ($required)
        <span class="text-red-500 text-sm">*</span>
    @endif
</label>
