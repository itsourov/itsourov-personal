<div class="space-y-4 container mx-auto px-2">


    @if ($unAuthorized)
        <a class="inline-block" href="{{ route('admin.google-drive.redirect') }}">
            <x-button.primary>
                {{ __('Redirect') }}
            </x-button.primary>
        </a>
    @else
        <x-card class="px-4 py-4 space-y-6">
            <div class="flex flex-wrap justify-between">
                <div class="relative ">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <x-svg.search class="w-5 h-5" />
                    </div>

                    <x-input.text class="pl-10 py-2" name="search" id="simple-search"
                        value="{{ request('search') ?? '' }}" required />
                </div>

                <x-dropdown :hoverAction="false" wire:loading.remove wire:target="loadMore, open, openFromPath">
                    <x-slot name="trigger">
                        <x-button.primary class="space-x-1 text-sm">
                            <x-svg.plus class="w-4 h-4" /> <span>{{ __('Add new') }}</span>
                        </x-button.primary>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link class="flex gap-1 cursor-pointer"
                            wire:click="$set('showFileUploadModal', true)">
                            <x-svg.plus class="w-5 h-5" />
                            <span>{{ __('Upload File') }}</span>
                        </x-dropdown-link>
                        <x-dropdown-link class="flex gap-1 cursor-pointer"
                            wire:click="$set('showAddFolderModal', true)">
                            <x-svg.folder class="w-5
                        h-5" />
                            <span>{{ __('Add Folder') }}</span>
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>
            @if ($data)
                <div class=" max-w-sm rounded border dark:border-gray-700  p-2 flex flex-wrap gap-3 items-center">
                    <img class=" rounded-full w-12 h-12" src="{{ $data['photoLink'] }}" alt="">
                    <div>
                        <p class="text-sm">{{ $data['name'] ?? '' }}</p>
                        <p class="text-sm">{{ $data['email'] ?? '' }}</p>
                    </div>
                </div>
            @else
                <div
                    class=" animate-pulse max-w-sm rounded border dark:border-gray-700  p-2 flex flex-wrap gap-3 items-center">
                    <div class=" rounded-full w-12 h-12 bg-slate-200 dark:bg-slate-600"></div>
                    <div class="grid grid-cols-1 gap-2 flex-grow">
                        <div class="rounded h-3 bg-slate-200 dark:bg-slate-600"></div>
                        <div class="rounded h-3 bg-slate-200 dark:bg-slate-600"></div>
                    </div>
                </div>
            @endif


        </x-card>


        <div>
            <h2 class=" font-medium ml-1">{{ __('My Files') }}</h2>

            <div class="flex flex-wrap">
                @foreach ($currentPath as $folder)
                    <button wire:click="openFromPath('{{ $folder['id'] ?? null }}',{{ $loop->index }})"
                        class="border dark:border-gray-700  px-2 py-1 rounded flex items-center gap-1">
                        <x-svg.folder class="w-4 h-4" />
                        <span> {{ $folder['name'] }}</span>
                    </button>
                @endforeach

            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700  uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-full">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3  whitespace-nowrap">
                                Size
                            </th>

                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 6; $i++)
                            <tr wire:key="loading-row-{{ $i }}" wire:loading.remove.class="hidden"
                                wire:target="openFolder, openFromPath" class="hidden"
                                wire:loading.class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 animate-pulse">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900  dark:text-white flex items-center gap-2">

                                    <div class="rounded h-3 w-full bg-slate-200 dark:bg-slate-600"></div>
                                </th>
                                <td class="px-6 py-4">
                                    <div class="rounded h-3 w-full bg-slate-200 dark:bg-slate-600"></div>
                                </td>

                                <td class="px-6 py-4 flex justify-end">
                                    <div class="rounded h-3 w-full bg-slate-200 dark:bg-slate-600"></div>
                                </td>
                            </tr>
                        @endfor

                        @forelse ($files as $file)
                            <tr wire:loading.remove wire:target="openFolder, openFromPath"
                                wire:key="data-row-{{ $loop->index }}"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">


                                <th scope="row" class="font-medium text-gray-900 p-2 dark:text-white ">

                                    <button
                                        wire:click="{{ $file['mimeType'] == 'application/vnd.google-apps.folder' ? "openFolder($loop->index)" : "previewFile($loop->index)" }}"
                                        class="flex items-center gap-2 cursor-pointer px-2 py-2 rounded  hover:bg-gray-100 dark:hover:bg-gray-600  ">
                                        <img src="{{ $file['iconLink'] }}" alt="" class="h-4 w-4">
                                        <p class="text-start"> {{ $file['name'] ?? __('undefined') }}</p>

                                    </button>
                                </th>
                                <td class="px-6 py-4">
                                    <p class=" whitespace-nowrap"> {{ $file['size'] ?? __('undefined') }}</p>
                                </td>

                                <td class="px-6 py-4 flex justify-end">
                                    <button wire:click="showEditModal({{ $loop->index }})"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                                </td>
                            </tr>
                        @empty

                            @if (!Auth::user())
                                Falback text
                            @else
                                {{ Auth::user()->email }}
                            @endif



                            <tr wire:loading.remove class="bg-white border-b dark:bg-gray-800 dark:border-gray-700  ">
                                <th colspan="3" class="text-center p-2">
                                    {{ __('No Files found') }}
                                </th>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="mt-4 text-center">
                @if ($hasMorePage)
                    <x-button.primary class="text-sm" wire:click="loadMore">
                        <span wire:loading wire:target="loadMore">
                            <x-svg.spinner class="w-4 h-4 mr-1 animate-spin" />
                        </span>
                        <span>
                            {{ __('Load more') }}
                        </span>
                    </x-button.primary>
                @endif
            </div>


        </div>
        <form wire:submit.prevent="update">
            <x-modal.dialog wire:model="showEditModal">
                @slot('title')
                    File Details
                @endslot
                @slot('content')
                    <div class="space-y-4">
                        <div>
                            <x-error-list :errors="$errors->get('editingFile.*')" />
                        </div>
                        <div>
                            <x-input.label value="{{ __('Name') }}" required="true" />
                            <x-input.text placeholder="{{ __('File title...') }}" wire:model.lazy="editingFile.name" />
                        </div>


                    </div>
                @endslot
                @slot('footer')
                    <x-button.secondary class="text-sm" wire:click="$set('showEditModal', false)">{{ __('Cancel') }}
                    </x-button.secondary>
                    <x-button.primary class="text-sm flex items-center gap-1" type="submit">
                        <x-svg.spinner class="w-3 h-3 animate-spin" wire:loading wire:target="update" />
                        {{ __('Save') }}
                    </x-button.primary>
                @endslot
            </x-modal.dialog>
        </form>
        <form wire:submit.prevent="makeFolder">
            <x-modal.dialog wire:model="showAddFolderModal">
                @slot('title')
                    Add a new folder
                @endslot
                @slot('content')
                    <div class="space-y-4">
                        <div>
                            <x-error-list :errors="$errors->get('newFolder.*')" />
                        </div>
                        <div>
                            <x-input.label value="{{ __('Name') }}" required="true" />
                            <x-input.text placeholder="{{ __('Folder Name...') }}" wire:model.lazy="newFolder.name" />
                        </div>


                    </div>
                @endslot
                @slot('footer')
                    <x-button.secondary class="text-sm" wire:click="$set('showAddFolderModal', false)">
                        {{ __('Cancel') }}
                    </x-button.secondary>
                    <x-button.primary class="text-sm flex items-center gap-1" type="submit">
                        <x-svg.spinner class="w-3 h-3 animate-spin" wire:loading wire:target="makeFolder" />
                        {{ __('Save') }}
                    </x-button.primary>
                @endslot
            </x-modal.dialog>
        </form>
        <x-modal.dialog wire:model="showFileUploadModal">
            @slot('title')
                File Upload
            @endslot
            @slot('content')
                <div>
                    <p>Upload Files to Folder id : {{ $currentFolderId }}</p>
                    <x-input.label :value="__('Upload File')" required="false" />
                    <x-input.livewire-filepond wire:model="uploadFile" />

                    @error('uploadFile')
                        <x-input.livewire-error>
                            {{ $message }}
                        </x-input.livewire-error>
                    @enderror
                </div>
            @endslot
            @slot('footer')
                <x-button.secondary class="text-sm" wire:click="$set('showFileUploadModal', false)">{{ __('Cancel') }}
                </x-button.secondary>
                <x-button.primary class="text-sm flex items-center gap-1" wire:click="saveFileToDrive">
                    <x-svg.spinner class="w-3 h-3 animate-spin" wire:loading wire:target="saveFileToDrive" />
                    {{ __('Save') }}
                </x-button.primary>
            @endslot
        </x-modal.dialog>
        <x-modal.dialog wire:model="showDetailsModal">
            @slot('title')
                File Details
            @endslot
            @slot('content')
                <div class="space-y-4">
                    <img src="{{ $editingFile['thumbnailLink'] ?? '' }}" alt="" class="w-22 rounded">
                    <div class="flex flex-wrap gap-2">
                        <p class="font-bold">File Name:</p>
                        <p>{{ $editingFile['name'] ?? '' }}</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <p class="font-bold">File Size:</p>
                        <p>{{ $editingFile['size'] ?? '' }}</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <p class="font-bold">File Id:</p>
                        <p>{{ $editingFile['id'] ?? '' }}</p>
                    </div>


                </div>
            @endslot
            @slot('footer')
                <x-button.secondary class="text-sm" wire:click="$set('showDetailsModal', false)">{{ __('Cancel') }}
                </x-button.secondary>
                <x-button.primary class="text-sm"
                    x-on:click="
                    if( window.opener){
                        window.opener.googleDriveExplorarCallback({{ json_encode($editingFile) }});
                            window.close();

                    }else{
                        alert('no callback found')
                    }
                ">

                    {{ __('Inseart') }}
                </x-button.primary>
            @endslot
        </x-modal.dialog>
    @endif

</div>
