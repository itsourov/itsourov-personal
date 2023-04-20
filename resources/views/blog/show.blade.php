<x-app-layout>
    {{ Breadcrumbs::render('blog.article', $post->title) }}
    <div class="container my-6  mx-auto gap-5 px-2  ">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 ">
            <div class=" md:col-span-2">
                <x-card class="space-y-4">
                    <h2 class="font-bold text-xl md:text-3xl">
                        {{ $post->title }}</h2>
                    <div class="flex flex-wrap justify-between text-xs text-gray-700 dark:text-gray-300">
                        <p class="">By <span class=" font-bold">{{ $post->user->name }}</span> -
                            {{ $post->created_at->format('d M, Y') }}</p>
                        <div class="space-x-2 whitespace-nowrap">
                            <div class="inline">
                                <i class="fa-solid fa-eye fa-xs"></i>
                                <span>11</span>
                            </div>
                            <div class="inline">
                                <i class="fa-solid fa-comments fa-xs"></i>
                                <span>11</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex  gap-2 flex-wrap">
                        <button
                            class="text-sm rounded-full py-2 border dark:border-gray-700 flex items-center gap-2 px-4 divide-x dark:divide-gray-700">
                            <i class="fa-brands fa-facebook-f text-blue-500"></i>

                            <p class="pl-2">Facebook</p>
                        </button>
                        <button
                            class="text-sm rounded-full py-2 border dark:border-gray-700 flex items-center gap-2 px-4 divide-x dark:divide-gray-700">
                            <i class="fa-brands fa-twitter text-blue-400"></i>

                            <p class="pl-2">Twitter</p>
                        </button>

                    </div>

                    @if ($post->getMedia('post-thumbnails')->last())
                        <a class="spotlight inline-block rounded overflow-hidden"
                            href="{{ $post->getMedia('post-thumbnails')->last()->getUrl() }}">
                            {{ $post->getMedia('post-thumbnails')->last() }}
                        </a>
                    @endif


                    <hr class="mt-6 mb-6 border-gray-200 dark:border-gray-700">
                    <article>
                        <div class="prose md:prose-lg prose-zinc dark:prose-invert max-w-none prose-a:text-blue-600 ">
                            {!! $post->content !!}
                        </div>
                    </article>
                </x-card>
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

</x-app-layout>
