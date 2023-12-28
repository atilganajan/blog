<div class="bg-white p-4 rounded-lg shadow-md text-center flex flex-col">
    @if($post->image)
        <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="w-full h-32 object-cover mb-4 rounded-md">
    @endif
    <h2 class="text-xl font-bold mb-2">{{ Str::limit($post->title, 20, '...') }}</h2>
    <div class="text-sm text-gray-500">{{ $post->category->name }}</div>
    <p class="text-gray-600 mb-2">{{ Str::limit($post->content, 50, '...') }}</p>
    <div class="flex-grow"></div>
        <div class="flex justify-center space-x-2">

            <a href="{{ route('show', ['slug' => $post->slug]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Show</a>

            @can('update', $post)
                <a href="{{ route('edit', $post->slug) }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                    Update
                </a>
            @endcan

            @can('delete', $post)
                <form action="{{ route('delete') }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="slug" value="{{$post->slug}}" >
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this post?')">
                        Delete
                    </button>
                </form>
            @endcan

        </div>


</div>
