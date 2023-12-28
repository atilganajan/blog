
@props(['disabled' => false, 'rows' => 6])

<textarea {{ $disabled ? 'disabled' : '' }} rows="{{ $rows }}" {!! $attributes->merge(['class' => 'w-full border-gray-300 rounded-md p-2 focus:outline-none focus:border-indigo-500']) !!}>{{ $slot }}</textarea>
