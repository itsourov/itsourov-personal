<article
    class="{{ $isReply ? 'ml-4 sm:ml-10' : '' }} p-3 lg:p-5  mb-6 text-base  bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-gray-100"
    id="comment_{{ $comment->id }}" x-data="{ open: false }">
    <footer class="flex justify-between items-center mb-2">
        <div class="flex items-center">
            <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white"><img
                    class="mr-2 w-6 h-6 rounded-full border-primary-500 border-2"
                    src="{{ $comment->user->getMedia('profileImages')->last()? $comment->user->getMedia('profileImages')->last()->getUrl('preview'): asset('images/user.png') }}"
                    alt="{{ $comment->user->name }}">{{ $comment->user->name }}</p>
            <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                    title="February 8th, 2022">{{ $comment->created_at->format('M. d, y') }}</time></p>
        </div>
        <button id="dropdownComment{{ $comment->id }}Button" data-dropdown-toggle="dropdownComment{{ $comment->id }}"
            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            type="button">
            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                </path>
            </svg>
            <span class="sr-only">Comment settings</span>
        </button>
        <!-- Dropdown menu -->
        <div id="dropdownComment{{ $comment->id }}"
            class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                aria-labelledby="dropdownMenuIconHorizontalButton">
                <li>
                    <a href="#"
                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                </li>
                <li>
                    <form action="" method="post" id="form-{{ $comment->id }}">
                        @method('DELETE')
                        @csrf

                        <button type="submit"
                            class="block w-full text-start py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            remove</button>
                    </form>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                </li>
            </ul>
        </div>
    </footer>
    <p>{{ $comment->comment }}</p>
    <div class="flex items-center mt-4 space-x-4">
        <button type="button" x-on:click="open = !open"
            class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
            <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                </path>
            </svg>
            Reply
        </button>
    </div>
    <form x-show="open" x-transition class="my-6" style="display: none" method="POST" action="">
        @csrf
        <input type="hidden" name="parent_id" value="{{ $parentId }}">
        <div
            class="py-2 px-4  bg-gray-100 rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-700">
            <label for="comment" class="sr-only">Your comment</label>
            <textarea id="comment" rows="4" name="comment"
                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 dark:text-white dark:placeholder-gray-400 bg-gray-100 dark:bg-gray-700"
                placeholder="Write a comment..."></textarea>

        </div>
        @error('comment')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        <button type="submit"
            class="mt-4 inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
            Post Reply
        </button>
    </form>
</article>
