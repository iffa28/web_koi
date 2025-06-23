@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 bg-blue-800 text-white'
            : 'flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 text-gray-400 hover:bg-gray-700 hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
