<div class="space-y-4 container mx-auto px-2 py-4">

    <x-card class="px-4 py-4 space-y-6">
        <div class="flex flex-wrap justify-between">
            <div class="relative ">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-svg.search class="w-5 h-5" />
                </div>

                <x-input.text class="pl-10 py-2" name="search" id="simple-search" value="{{ request('search') ?? '' }}"
                    required />
            </div>

            <x-button.primary class="space-x-1 text-sm" wire:click="$set('showFileUploadModal', true)">
                <x-svg.plus class="w-4 h-4" /> <span>{{ __('Add new') }}</span>
            </x-button.primary>

        </div>


    </x-card>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        @foreach ($images as $image)
            <div wire:click="previewFile({{ $image->id }})">
                <img class="h-auto max-w-full rounded-lg" src="{{ $image->getUrl() }}" alt="">
            </div>
        @endforeach
    </div>
    <div>
        {{ $images->links('pagination.tailwind-livewire') }}
    </div>


    <x-modal.dialog wire:model="showFileUploadModal">
        @slot('title')
            File Upload
        @endslot
        @slot('content')
            <div>

                <x-input.label :value="__('Upload File')" required="false" />
                <x-input.livewire-filepond wire:model="uploadFile" accept="image/*" />

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
                <img src="{{ $previewFile['url'] ?? '' }}" alt="" class=" max-w-xs rounded">
                <div class="flex flex-wrap gap-2">
                    <p class="font-bold">File Name:</p>
                    <p>{{ $previewFile['name'] ?? '' }}</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <p class="font-bold">File Size:</p>
                    <p>{{ $previewFile['size'] ?? '' }}</p>
                </div>


            </div>
        @endslot
        @slot('footer')
            <x-button.secondary class="text-sm" wire:click="$set('showDetailsModal', false)">{{ __('Cancel') }}
            </x-button.secondary>
            <x-button.primary class="text-sm"
                x-on:click="
        
                FileBrowserDialogue.mySubmit({{ json_encode($previewFile) }}); 
                {{-- if( window.opener){
                    window.opener.googleDriveExplorarCallback({{ json_encode($previewFile) }});
                        window.close();

                }else{
                    alert('no callback found')
                } --}}
            ">

                {{ __('Inseart') }}
            </x-button.primary>
        @endslot
    </x-modal.dialog>

    @push('scripts')
        <script>
            var FileBrowserDialogue = {
                init: function() {
                    // Here goes your code for setting your custom things onLoad.
                },
                mySubmit: function(file) {
                    window.parent.postMessage({
                        mceAction: 'fileSelected',
                        data: {
                            file: file
                        }
                    }, '*');
                }
            };
        </script>
    @endpush
</div>
