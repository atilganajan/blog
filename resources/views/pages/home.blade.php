<x-app-layout>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mt-4 p-3">

        <!-- Display categories on the left (solda) -->
        <div class="sm:col-span-1">
            @foreach($categories as $category)
                <x-category-item :category="$category"/>
            @endforeach
        </div>

        <!-- Display posts in a grid -->
        <div class="sm:col-span-1 md:col-span-2 lg:col-span-5">
            @if(count($posts) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4  gap-4">
                    @foreach($posts as $post)
                        <x-card-item :post="$post"/>
                    @endforeach
                </div>

                <div class="mt-4 justify-center">
                    {{$posts->links()}}
                </div>
            @else
                <p class="text-gray-600">{{ __("There are no posts yet") }}</p>
            @endif
        </div>
    </div>
</x-app-layout>
