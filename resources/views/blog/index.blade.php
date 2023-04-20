<x-app-layout>

    <div class="container my-10  mx-auto gap-5 px-2  ">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 ">
            <div class=" md:col-span-2">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($posts as $post)
                        <x-card class="px-0 py-0 overflow-hidden">
                            <a href="{{ route('blog.show', $post) }}">
                                <div class=" aspect-w-16 aspect-h-9 ">

                                    {{ $post->getMedia('post-thumbnails')->last() }}
                                </div>

                            </a>
                            <div class="p-3 grid gap-3">
                                <a href="{{ route('blog.show', $post) }}">
                                    <h2 class="text-lg font-medium line-clamp-2">{{ $post->title }}</h2>
                                </a>
                                <div>
                                    <a href="{{ route('blog.show', $post) }}">
                                        <button
                                            class="border border-primary-600 rounded py-1.5 px-3 hover:bg-primary-600 hover:text-gray-100 transition-all">
                                            {{ __('Read more') }}
                                            <i class="ml-1 fa-solid fa-arrow-right"></i>
                                        </button>
                                    </a>

                                </div>
                            </div>
                        </x-card>
                    @endforeach
                </div>
            </div>
            <div class=" relative">
                <div class="sticky top-0">

                    <x-blog.searchbox />
                    <x-blog.popular-posts />

                    {{-- <x-posts.searchbox />
                    <x-posts.popular-posts />
                    <x-posts.category-list /> --}}

                </div>

            </div>
        </div>

    </div>



</x-app-layout>
