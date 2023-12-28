<a href="{{ route('category.posts', ['category' => $category->name]) }}" class="block p-2 border border-gray-300 mb-2 hover:bg-gray-100 hover:border-blue-400 transition duration-300 rounded-md flex justify-between">
    <h2 class="text-lg font-semibold text-gray-800 hover:text-blue-600">{{ $category->name }}</h2>
    <h2 class="text-lg font-semibold text-gray-800 hover:text-blue-600">({{count($category->posts ?? 0)}})</h2>
</a>
