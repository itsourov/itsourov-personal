<div>
    <div>

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
            <x-button.primary class="text-sm" wire:click="addComment">{{ __('Post comment') }}</x-button.primary>
        </div>

        <div class="grid gap-4 mt-8">
            @foreach ($comments as $comment)
                <x-card class="space-y-3 px-4 py-4" x-data="{ replyBoxOpen: false }">
                    <div class="flex flex-wrap items-center gap-2">
                        <img class="h-6 w-6 rounded-full"
                            src="{{ $comment->user->getFirstMedia('profile-images')?->getUrl('preview') }}"
                            alt="">
                        <p class="text-sm font-medium">{{ $comment->user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                    <div>
                        <p>{{ $comment->comment }}</p>
                    </div>
                    <div>
                        <button class="text-sm hover:text-primary-500" x-on:click="replyBoxOpen = !replyBoxOpen">
                            <i class="fa-solid fa-comment-dots"></i>
                            {{ __('Relpy') }}
                        </button>
                    </div>
                    <div class="space-y-3" x-transition x-show="replyBoxOpen" x-cloak>
                        <x-input.textarea wire:model.lazy="replyBoxTexts.{{ $comment->id }}" class=" text-sm "
                            placeholder="{{ __('Write a reply') }}...">

                        </x-input.textarea>
                        <x-button.primary class="text-xs" wire:click="addReply('{{ $comment->id }}')">
                            {{ __('Post Reply') }}</x-button.primary>
                        @error("replyBoxTexts.$comment->id")
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </x-card>
                @foreach ($comment->replies as $reply)
                    <x-card class="space-y-3 px-4 py-4 ml-4" x-data="{ replyBoxOpen: false }">
                        <div class="flex flex-wrap items-center gap-2">
                            <img class="h-6 w-6 rounded-full"
                                src="{{ $reply->user->getFirstMedia('profile-images')?->getUrl() }}" alt="">
                            <p class="text-sm font-medium">{{ $reply->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $reply->created_at->diffForHumans() }}</p>
                        </div>
                        <div>
                            <p>{{ $reply->comment }}</p>
                        </div>
                        <div>
                            <button class="text-sm hover:text-primary-500" x-on:click="replyBoxOpen = !replyBoxOpen">
                                <i class="fa-solid fa-comment-dots"></i>
                                {{ __('Relpy') }}
                            </button>
                        </div>
                        <div class="space-y-3" x-transition x-show="replyBoxOpen" x-cloak>
                            <x-input.textarea wire:model.lazy="replyBoxTexts.{{ $comment->id }}" class=" text-sm "
                                placeholder="{{ __('Write a reply') }}...">

                            </x-input.textarea>
                            <x-button.primary class="text-xs" wire:click="addReply('{{ $comment->id }}')">
                                {{ __('Post Reply') }}</x-button.primary>
                            @error("replyBoxTexts.$comment->id")
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </x-card>
                @endforeach
            @endforeach
        </div>
        <div>
            {{ $comments->links() }}
        </div>
    </div>
</div>
