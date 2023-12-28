<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Post Details') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8">
        <a href="{{ route('home') }}" class="text-indigo-500 hover:underline mb-4 block">
            &larr; Back to Home
        </a>
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="mx-auto max-w-full md:max-w-2xl rounded-lg mb-4">

            <h1 class="text-3xl font-bold mb-2 text-center">{{ $post->title }}</h1>
            <p class="text-gray-500 text-sm mb-4 text-center">Category: {{ $post->category->name }}</p>

            <p class="text-gray-700 mb-4 text-center">{{ $post->content }}</p>

            <div class="flex justify-between items-center text-gray-500 text-sm p-4">
                <p>Created at: {{ $post->created_at->format('d.m.Y H:i') }}</p>
                <p>Last Updated at: {{ $post->updated_at->format('d.m.Y H:i') }}</p>
            </div>
        </div>
    </div>


</x-app-layout>
