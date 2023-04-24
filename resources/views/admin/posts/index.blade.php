<x-admin-layout>


    <div class="space-y-5 container mx-auto px-4 py-4">
        <h2 class="text-lg font-bold">Posts</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-3 gap-y-5">
            @foreach ($posts as $post)
                <x-card class="px-0 py-0 overflow-hidden">
                    <a href="{{ route('admin.posts.edit', $post) }}">
                        <div class=" aspect-w-16 aspect-h-9 ">

                            @if ($post->getMedia('post-thumbnails')->last())
                                {{ $post->getMedia('post-thumbnails')->last() }}
                            @else
                                {!! $post->getFallbackImage() !!}
                            @endif

                        </div>

                    </a>
                    <div class="p-3 grid gap-3">
                        <a href="{{ route('admin.posts.edit', $post) }}">
                            <h2 class="text-lg font-medium line-clamp-2">{{ $post->title }}</h2>
                        </a>
                        <div class="ml-auto">
                            <a href="{{ route('blog.show', $post) }}">
                                <button
                                    class="border border-primary-600 rounded py-1.5 px-3 hover:bg-primary-600 hover:text-gray-100 transition-all">
                                    <x-svg.eye class="inline w-5 h-5" />
                                </button>
                            </a>
                            <a href="{{ route('admin.posts.edit', $post) }}">
                                <button
                                    class="border border-primary-600 rounded py-1.5 px-3 hover:bg-primary-600 hover:text-gray-100 transition-all">
                                    <x-svg.edit class="inline w-5 h-5" />
                                </button>
                            </a>

                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>
        <div class="mt-2">
            {{ $posts->links('pagination.tailwind') }}
        </div>
    </div>
</x-admin-layout>
