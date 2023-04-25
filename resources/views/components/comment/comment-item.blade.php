@props(['isReply' => false, 'comment', 'parentComment'])
<x-card class="space-y-3 px-4 py-4 {{ $isReply ? ' ml-4 md:ml-8' : '' }}"
    id="{{ $isReply ? 'reply' : 'comment' }}-{{ $comment->id }}">
    <div class="flex justify-between">
        <div class="flex flex-wrap items-center gap-2">
            <img class="h-6 w-6 rounded-full border dark:border-gray-700"
                src="{{ $comment->user->getFirstMedia('profile-images')?->getUrl('preview') ?? asset('images/user.png') }}"
                alt="">
            <p class="text-sm font-medium">{{ $comment->user->name }}</p>
            <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
        </div>
        @if ($comment->user->id == auth()->user()?->id)
            <button class="text-sm  hover:text-primary-500 flex items-center gap-1"
                wire:click="deleteCommentId({{ $comment->id }})" x-on:click="deleteModal = !deleteModal">
                <x-svg.trash class="inline w-4 h-4" />{{ __('Delete') }}
            </button>
        @endif

    </div>
    <div>
        <p>{{ $comment->comment }}</p>
    </div>
    @if ($isReply)
        <x-comment.reply-box :comment="$parentComment" />
    @else
        <x-comment.reply-box :comment="$comment" />
    @endif
</x-card>
