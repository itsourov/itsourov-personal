<div>
    <div class="space-y-2">
        <div class="flex justify-end gap-3">
            <x-dropdown :hoverAction="false">
                <x-slot name="trigger">
                    <x-button.secondary class="space-x-1 text-sm">
                        <x-svg.chevron-down class="w-4 h-4" />
                        <span>{{ __('Bulk Action') }}</span>
                    </x-button.secondary>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link class="flex gap-1 cursor-pointer" wire:click="deleteSelected">
                        <x-svg.trash class="w-5 h-5" />
                        <span>{{ __('Delete') }}</span>
                    </x-dropdown-link>
                    <x-dropdown-link class="flex gap-1 cursor-pointer" wire:click="exportSelected">
                        <x-svg.arrow-down-tray class="w-5 h-5" />
                        <span>{{ __('Export') }}</span>
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>

            <x-button.primary class="space-x-1 text-sm" wire:click="create">
                <x-svg.plus class="w-4 h-4" /> <span>{{ __('Add new') }}</span>
            </x-button.primary>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="p-2">
                            <input type="checkbox">
                        </th>
                        <th scope="col" class="p-3">
                            Short Url
                        </th>
                        <th scope="col" class="p-3">
                            Long Url
                        </th>
                        <th scope="col" class="p-3">
                            Actions
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($shortLinks as $shortLink)
                        <tr wire:key="row-{{ $shortLink->id }}"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="p-2">
                                <input type="checkbox" wire:model="selectedShortLinks" value="{{ $shortLink->id }}">
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 max-w-xs dark:text-white">
                                {{ route('shortlink.show', $shortLink) }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $shortLink->long_url }}
                            </td>


                            <td class="px-6 py-4 text-right">
                                <button wire:click.defer="edit({{ $shortLink->id }})"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div>
            {{ $shortLinks->links('pagination.tailwind-livewire') }}
        </div>
    </div>
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model="showEditModal">

            <x-slot name="title">
                {{ __('Edit Short-Link') }}

            </x-slot>
            <x-slot name="content">
                <div class="space-y-4">
                    <div>
                        <x-error-list :errors="$errors->get('editing.*')" />
                    </div>
                    <div>
                        <x-input.label value="{{ __('Short ID') }}" required="true" />
                        <x-input.text placeholder="{{ __('Short_ID..') }}" wire:model.lazy="editing.short_id" />
                    </div>
                    <div>
                        <x-input.label value="{{ __('Long URL') }}" required="true" />
                        <x-input.text placeholder="{{ __('Long URL...') }}" wire:model.lazy="editing.long_url" />
                    </div>


                </div>

            </x-slot>
            <x-slot name="footer">
                <x-button.secondary class="text-sm" wire:click="$set('showEditModal', false)">{{ __('Cancel') }}
                </x-button.secondary>
                <x-button.primary class="text-sm" type="submit">
                    {{ __('Save') }}</x-button.primary>
            </x-slot>

        </x-modal.dialog>
    </form>
</div>
