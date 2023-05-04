<div>
    <x-card>
        <div class="header border-b dark:border-gray-600 p-1">
            <h2 class=" font-medium text-lg">{{ __('Site Settings') }}</h2>
            <p class="text-sm text-gray-500">{{ __("Manage settings for the site's info") }}</p>
        </div>


        <form wire:submit.prevent="save">
            <div class="content my-3 grid gap-3">
                <div>
                    <x-input.label value="{{ __('Site Title') }}" required="true" />
                    <x-input.text placeholder="{{ __('My site title') }}" wire:model.lazy="siteSettings.site_title" />
                </div>
                <div>
                    <x-input.label value="{{ __('Site Tagline') }}" required="true" />
                    <x-input.text placeholder="{{ __('My site tagline') }}"
                        wire:model.lazy="siteSettings.site_tagline" />
                </div>
                <div>
                    <x-input.label value="{{ __('Site Description') }}" required="true" />
                    <x-input.textarea placeholder="{{ __('A laravel website') }}" rows="4"
                        wire:model.lazy="siteSettings.site_description"></x-input.textarea>
                </div>
                <div>
                    <x-input.label value="{{ __('Site Logo') }}" required="true" />
                    <x-input.livewire-filepond wire:model="siteSettings.site_logo" />
                </div>
                <x-button.primary class="flex items-center gap-2">
                    <x-svg.spinner class="w-3.5 h-3.5 animate-spin" wire:loading wire:target="save" />
                    <span>{{ __('Save') }}</span>
                </x-button.primary>
                <div>
                    <x-error-list :errors="$errors->get('siteSettings.*')" />
                </div>
                <div>
                    @if ($message)
                        <div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-700 dark:text-blue-400"
                            role="alert">
                            <x-svg.info class="flex-shrink-0 inline w-5 h-5 mr-3" />
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $message }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </form>

    </x-card>
</div>
