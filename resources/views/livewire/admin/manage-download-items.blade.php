<div>
    {{ $product->title }}

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

                        </th>
                        <th scope="col" class="p-3">
                            downloadItem Title
                        </th>
                        <th scope="col" class="p-3">
                            Content
                        </th>
                        <th scope="col" class="p-3">
                            downloadItem type
                        </th>
                        <th scope="col" class="p-3">
                            File size
                        </th>
                        <th scope="col" class="p-3">
                            Actions
                        </th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($downloadItems as $downloadItem)
                        <tr wire:key="row-{{ $downloadItem->id }}"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="p-2">
                                <input type="checkbox" wire:model="selectedDownloadItems"
                                    value="{{ $downloadItem->id }}">
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 max-w-xs dark:text-white">
                                {{ $downloadItem->title }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $downloadItem->content }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $downloadItem->type }}
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                {{ $downloadItem->size }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button wire:click.defer="edit({{ $downloadItem->id }})"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div>
            {{ $downloadItems->links('pagination.tailwind-livewire') }}
        </div>
    </div>
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model="showEditModal">

            <x-slot name="title">
                {{ __('Edit Download Item') }}

            </x-slot>
            <x-slot name="content">
                <div class="space-y-4">
                    <div>
                        <x-error-list :errors="$errors->get('editing.*')" />
                    </div>
                    <div>
                        <x-input.label value="{{ __('Title') }}" required="true" />
                        <x-input.text placeholder="{{ __('Download Item title...') }}"
                            wire:model.lazy="editing.title" />
                    </div>
                    <div>
                        <x-input.label value="{{ __('Content') }}" required="true" />
                        <x-input.text placeholder="{{ __('Download Item content...') }}"
                            wire:model.lazy="editing.content" />
                    </div>
                    <div>
                        <x-input.label value="{{ __('Size') }}" />
                        <x-input.text placeholder="{{ __('Download Size') }}" wire:model.lazy="editing.size" />
                    </div>

                    <div>
                        <x-input.label :value="__('Download Item Type')" required="true" />
                        <x-input.select wire:model="editing.type" class="mt-1 block w-full">
                            <option value="" disabled>Select an option</option>
                            @foreach (\App\Enums\DownloadLinkType::toArray() as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </x-input.select>


                    </div>
                    <div>
                        @if ($editing['type'] == \App\Enums\DownloadLinkType::googleDriveId)
                            <x-button.secondary class="text-sm px-1 py-1" onclick="openGoogleDriveExplorar()">
                                {{ __('Google Drive Explorer') }}
                            </x-button.secondary>
                        @endif
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

    @push('scripts')
        <script>
            function openGoogleDriveExplorar() {
                window.open('{{ route('admin.google-drive.index') }}?model=', 'fm', 'width=1280,height=720');
            }

            function googleDriveExplorarCallback(data) {
                @this.set('editing.title', data.name)
                @this.set('editing.content', data.id)
                @this.set('editing.size', data.size)
            }
        </script>
    @endpush
</div>
