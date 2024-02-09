@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-white border-gray-400 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm']) !!}>
