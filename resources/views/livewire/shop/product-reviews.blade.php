<div class="space-y-4">
    <h4 class="text-base font-bold ml-1">{{ __('Reviews') }}</h4>
    @if ($isPurchased)
        <x-card>
            <form class="space-y-4" wire:submit.prevent="createNew">
                <h4 class="text-base font-bold ml-1">{{ __('Give a new Review') }}</h4>
                <div class="grid grid-cols-2 gap-4 ">
                    <div>
                        <x-input.label value="{{ __('Name') }}" required="true" />
                        <x-input.text placeholder="{{ __('Name') }}" value="{{ auth()->user()?->name }}" disabled />
                    </div>
                    <div>
                        <x-input.label value="{{ __('Email') }}" required="true" />
                        <x-input.text placeholder="{{ __('Enter Email here') }}" value="{{ auth()->user()?->email }}" />
                    </div>
                </div>
                <div>
                    <x-input.label value="{{ __('Rating') }}" required="true" />
                    <x-input.text placeholder="{{ __('Enter Rating here...') }}" wire:model.lazy="newComment.rating" />
                </div>
                <div>
                    <x-input.label value="{{ __('Review') }}" required="true" />
                    <x-input.textarea wire:model.lazy="newComment.comment"></x-input.textarea>
                </div>
                <div>
                    <x-error-list :errors="$errors->get('newComment.*')" />
                </div>
                <x-button.primary class="text-sm">{{ __('Submit') }}</x-button.primary>
            </form>
        </x-card>
    @endif
    <div>
        <div class="grid gap-3">
            @foreach ($reviews as $review)
                <x-card>
                    <div class="user-info flex items-start gap-3">
                        <img class="rounded-full w-10 h-10"
                            src={{ $review->user->getFirstMedia('profile-images')?->getUrl('preview') ?? asset('images/user.png') }}
                            alt="">
                        <div>
                            <p class="text-sm">{{ $review->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $review->created_at->format('d M, Y') }}</p>
                            <div class="rating text-yellow-300 ">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= ceil($product->reviews_avg_rating))
                                        <x-svg.star-solid class="w-4 h-4 inline" />
                                    @else
                                        <x-svg.star-outlined class="w-4 h-4 inline" />
                                    @endif
                                @endfor
                                <span class="text-gray-500 text-sm">({{ $review->rating }})</span>
                            </div>
                            <p class="mt-1">{{ $review->comment }}</p>
                        </div>
                    </div>

                </x-card>
            @endforeach
        </div>
        <div class="my-2">
            {{ $reviews->links('pagination.tailwind-livewire') }}
        </div>
    </div>
    <div wire:loading wire:target="deleteComment, addComment,addReply,gotoPage">
        <div
            class="fixed z-40 flex tems-center justify-center inset-0 bg-gray-700 dark:bg-gray-900 dark:bg-opacity-50 bg-opacity-50 transition-opacity">
            <div class="flex items-center justify-center ">
                <div class="w-40 h-40 border-t-4 border-b-4 border-green-900 rounded-full animate-spin">
                </div>
            </div>
        </div>
    </div>



</div>
