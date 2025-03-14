@props(['active'])

@php
$classes = ($active ?? false) ? 'text-red-800 text-xl transition duration-150 ease-in-out'
            :'text-[#7C7A79] text-xl hover:text-red-800 transition duration-150 ease-in-out' ;
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
