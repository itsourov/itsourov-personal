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
                    <x-input.text placeholder="{{ __('My site title') }}" wire:model.lazy="site_settings.title" />
                </div>
                <div>
                    <x-input.label value="{{ __('Site Description') }}" required="true" />
                    <x-input.textarea placeholder="{{ __('A laravel website') }}" rows="4"
                        wire:model.lazy="site_settings.title"></x-input.textarea>
                </div>
                <div>
                    <x-input.label value="{{ __('Site Logo') }}" required="true" />
                    <x-input.livewire-filepond wire:model="site_settings.logo" />
                </div>
                <x-button.primary class="flex items-center gap-2">
                    <x-svg.spinner class="w-3.5 h-3.5 animate-spin" wire:loading wire:target="save" />
                    <span>{{ __('Save') }}</span>
                </x-button.primary>
            </div>
        </form>

    </x-card>
</div>
