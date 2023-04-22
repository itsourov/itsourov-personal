<div>
    <div x-data="{ deleteModal: false }">

        <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white mt-6">Discussion</h2>
        <div class="space-y-2">

            <div
                class="py-2 px-4  bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <label for="comment" class="sr-only">Your comment</label>
                <textarea rows="6" wire:model.lazy="commentBoxText"
                    class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                    placeholder="Write a comment..."></textarea>

            </div>

            @error('commentBoxText')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <x-button.primary class="text-sm" wire:click="addComment">
                <div wire:loading wire:target="addComment">
                    <svg aria-hidden="true" role="status" class="inline w-4 h-4  text-white animate-spin"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="#E5E7EB" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentColor" />
                    </svg>
                    {{ __('Submitting') }}...
                </div>
                <div wire:loading.remove wire:target="addComment">
                    {{ __('Post Comment') }}
                </div>

            </x-button.primary>
        </div>

        <div class="grid gap-4 mt-8">
            @foreach ($comments as $comment)
                @if (!$comment->deleted_at)
                    <x-card class="space-y-3 px-4 py-4" x-data="{ replyBoxOpen: false }">
                        <div class="flex justify-between">
                            <div class="flex flex-wrap items-center gap-2">
                                <img class="h-6 w-6 rounded-full"
                                    src="{{ $comment->user->getFirstMedia('profile-images')?->getUrl('preview') }}"
                                    alt="">
                                <p class="text-sm font-medium">{{ $comment->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                            <button class="text-sm  hover:text-primary-500"
                                wire:click="deleteCommentId({{ $comment->id }})"
                                x-on:click="deleteModal = !deleteModal"><i
                                    class="fa-solid fa-trash fa-xs mr-1"></i>{{ __('Delte') }}</button>
                        </div>
                        <div>
                            <p>{{ $comment->comment }}</p>
                        </div>
                        <x-comment.reply-box :comment="$comment" />
                    </x-card>
                @else
                    <x-card>
                        This comment was deleted
                    </x-card>
                @endif

                @foreach ($comment->replies as $reply)
                    @if (!$reply->deleted_at)
                        <x-card class="space-y-3 px-4 py-4 ml-4 md:ml-8" x-data="{ replyBoxOpen: false }"
                            id="reply-{{ $reply->id }}">
                            <div class="flex justify-between">
                                <div class="flex flex-wrap items-center gap-2">
                                    <img class="h-6 w-6 rounded-full"
                                        src="{{ $reply->user->getFirstMedia('profile-images')?->getUrl('preview') }}"
                                        alt="">
                                    <p class="text-sm font-medium">{{ $reply->user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $reply->created_at->diffForHumans() }}</p>
                                </div>
                                <button x-on:click="deleteModal = !deleteModal" class="text-sm  hover:text-primary-500"
                                    wire:click="deleteCommentId({{ $reply->id }})"><i
                                        class="fa-solid fa-trash fa-xs mr-1"></i>{{ __('Delte') }}</button>
                            </div>
                            <div>
                                <p>{{ $reply->comment }}</p>
                            </div>
                            <x-comment.reply-box :comment="$comment" />
                        </x-card>
                    @else
                        <x-card class="ml-4 md:ml-8">
                            This reply was deleted
                        </x-card>
                    @endif
                @endforeach
            @endforeach
        </div>
        <div class="my-4">
            {{ $comments->links('pagination.tailwind-livewire') }}
        </div>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
            x-cloak x-show="deleteModal">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                <div x-cloak x-show="deleteModal" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>


                <div x-cloak x-show="deleteModal" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                        <button type="button" x-on:click="deleteModal = !deleteModal"
                            class=" rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Close</span>
                            <!-- Heroicon name: outline/x -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <!-- Heroicon name: outline/exclamation -->
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium ">
                                {{ __('Delte Comment') }}
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    {{ __('If you delete this comment you can no longer undo this action normaly') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse gap-2">
                        <x-button.secondary x-on:click="deleteModal = !deleteModal" class="">
                            {{ __('Cancel') }}
                        </x-button.secondary>
                        <x-button.danger x-on:click="deleteModal = !deleteModal" wire:click="deleteComment">
                            {{ __('Delete') }}</x-button.danger>

                    </div>
                </div>
            </div>
        </div>
    </div>



    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function() {


                document.addEventListener('scroll-to-element', function(params) {
                    console.log(params);
                    let element = document.getElementById(params.detail.elementId);
                    if (element) {
                        element.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
            $('.replyButton').on('click', function() {
                console.log(this);
            });
        </script>
    @endpush
</div>
