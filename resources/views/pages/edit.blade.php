<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Edit Blog Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('home') }}" class="text-indigo-500 hover:underline mb-4 block">
                        &larr; Back to Home
                    </a>
                    <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="mx-auto max-w-full md:max-w-2xl rounded-lg mb-4">
                    <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="slug" value="{{$post->slug}}">


                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Title')"/>
                            <x-text-input id="title"
                                          class="w-full border-gray-300 rounded-md p-2 focus:outline-none focus:border-indigo-500"
                                          type="text" name="title"
                                          :value="old('title', $post->title)" required autofocus autocomplete="title"/>
                            <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                        </div>


                        <div class="mb-4">
                            <x-input-label for="content" :value="__('Content')"/>
                            <x-textarea id="content"
                                        class="w-full border-gray-300 rounded-md p-2 focus:outline-none focus:border-indigo-500"
                                        name="content"
                                        :value="old('content', $post->content)" required autocomplete="content">{{old('title', $post->content)}}</x-textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2"/>

                        </div>

                        <div class="mb-4">
                            <x-input-label for="content" :value="__('category')"/>
                            <x-select id="category"
                                      class="w-full border-gray-300 rounded-md p-2 focus:outline-none focus:border-indigo-500"
                                      name="category" :value="old('category', $post->category)" required autocomplete="category">
                                <option value="">Categories</option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{ $category->name }}" {{ $post->category->name == $category->name ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </x-select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2"/>

                        </div>

                        <div class="mb-4">
                            <label for="showImage" class="block text-sm font-medium text-gray-700">
                                Change Image
                                <input type="checkbox" id="showImage" {{old('change_image') === "on" ? "checked" : ""}} name="change_image" class="ml-2" onchange="toggleImageVisibility()">
                            </label>
                        </div>

                        <div class="mb-4" id="imageInputContainer" style="display: none;">
                            <x-input-label for="image" :value="__('Image')"/>
                            <x-file-input id="image"
                                          class="w-full border-gray-300 rounded-md p-2 focus:outline-none focus:border-indigo-500"
                                          name="image"
                                          :value="old('image')"  autocomplete="image"/>
                            <x-input-error :messages="$errors->get('image')" class="mt-2"/>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center">
                            <button type="submit"
                                    class="bg-indigo-500 text-white font-semibold px-4 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">
                                Update Post
                            </button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script>
            function toggleImageVisibility() {
                const showImageCheckbox = document.getElementById("showImage");
                const imageInputContainer = document.getElementById("imageInputContainer");
                const imageInput = document.getElementById("image");


                if (showImageCheckbox.checked) {
                    imageInputContainer.style.display = "block";
                } else {
                    imageInputContainer.style.display = "none";
                }
            }
            toggleImageVisibility();
        </script>
    @endsection

</x-app-layout>
