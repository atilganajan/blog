
@props(['disabled' => false, 'accept' => "image/*"])

<input type="file" {{ $disabled ? 'disabled' : '' }} accept="{{ $accept }}" {!! $attributes->merge(['class' => 'w-full border-gray-300 rounded-md p-2 focus:outline-none focus:border-indigo-500']) !!}></input>
