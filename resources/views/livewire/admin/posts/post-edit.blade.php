<div class="container px-2 mx-auto">

    <x-card>

        <div class="space-y-5 md:p-3">
            <div class="heading  py-4 ">
                <h3 class=" font-medium text-lg">{{ $title }}</h3>
            </div>
            <div>
                <x-error-list :errors="$errors->get('post.*')" />
            </div>



            <div class=" border-t border-b dark:border-gray-700 py-2">
                <div class="grid grid-cols-2 gap-1 md:block md:space-y-1">
                    <x-admin.tab-button :tabItem='$tabItem' name="info">Info</x-admin.tab-button>
                    <x-admin.tab-button :tabItem='$tabItem' name="content">Content</x-admin.tab-button>
                    <x-admin.tab-button :tabItem='$tabItem' name="categories">Categories</x-admin.tab-button>



                </div>

            </div>
            <div class="content relative">
                <div wire:loading wire:target="setTab" class=" absolute w-full h-full z-30">

                    <div
                        class="bg-gray-500 text-primary-500 w-full h-full  flex items-center justify-center bg-opacity-25 z-30">
                        <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
                            role="status">
                            <span
                                class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                        </div>
                    </div>
                </div>


                <div id="info-container" class=" space-y-5" {!! $tabItem == 'info' ? '' : 'style="display: none"' !!}>


                    <div>
                        <x-input.label :value="__('Title')" required="true" />
                        <x-input.text wire:model="post.title" type="text" class="mt-1 block w-full" />
                    </div>
                    <div>
                        <x-input.label :value="__('Slug')" required="true" />
                        <x-input.text wire:model="post.slug" type="text" class="mt-1 block w-full" />
                    </div>


                    <div>
                        <x-input.label :value="__('Featured Image')" required="false" />
                        <x-input.livewire-filepond wire:model="featuredImage" />
                        @error('featuredImage')
                            <x-input.livewire-error>
                                {{ $message }}
                            </x-input.livewire-error>
                        @enderror
                    </div>

                </div>
                <div id="content-container" class="" {!! $tabItem == 'content' ? '' : 'style="display: none"' !!}>
                    <div class="space-y-6">


                        <div wire:ignore>
                            <x-input.label :value="__('Content')" required="true" />
                            <x-input.textarea wire:model="post.content" class=" mt-1 block w-full" id="post_content"
                                rows="6">
                                {{ $post['content'] }}</x-input.textarea>

                        </div>
                    </div>
                </div>
                <div id="categories-container" class="" {!! $tabItem == 'categories' ? '' : 'style="display: none"' !!}>

                    <div>

                        <h3>Select categories</h3>
                        <hr class="border-gray-300 dark:border-gray-700 my-2">
                        <div class="grid grid-cols-4 gap-3">
                            @foreach ($categories as $index => $category)
                                <div class="bg-gray-100 dark:bg-gray-700 px-2 rounded flex items-center gap-2">
                                    <input type="checkbox" wire:model="categoryIds" id="cat-item-{{ $index }}"
                                        value="{{ $category->id }}">

                                    <label class="block w-full py-3 select-none cursor-pointer"
                                        for="cat-item-{{ $index }}">{{ $category->title }}</label>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>



            </div>
            <div>
                <x-error-list :errors="$errors->get('post.*')" />
            </div>
            <x-button.primary wire:click="update">Update</x-button.primary>

        </div>
    </x-card>
    <div wire:loading wire:target="update">
        <div
            class="fixed z-40 flex tems-center justify-center inset-0 bg-gray-700 dark:bg-gray-900 dark:bg-opacity-50 bg-opacity-50 transition-opacity">
            <div class="flex items-center justify-center ">
                <div class="w-40 h-40 border-t-4 border-b-4 border-green-900 rounded-full animate-spin">
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            tinymce.init({
                selector: '#post_content',
                plugins: 'anchor  code autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                setup: function(editor) {
                    editor.on('init change', function() {
                        editor.save();
                    });
                    editor.on('change', function(e) {
                        @this.set('post.content', editor.getContent());
                    });
                    editor.on('ExecCommand', function(e) {
                        if (e.command === 'mceUpdateImage') {
                            const img = editor.selection.getNode();

                            var link = document.createElement("a");
                            link.href = img.src;
                            link.className = 'spotlight';
                            img.parentNode.insertBefore(link, img);

                            // Move the image inside the link element
                            link.appendChild(img);

                        }
                    });

                },
                file_picker_callback: elFinderBrowser,
                extended_valid_elements: 'img[class|src|alt|title|width|loading=lazy]',

            });




            function elFinderBrowser(callback, value, meta) {
                tinymce.activeEditor.windowManager.openUrl({
                    title: 'File Manager',
                    url: "{{ route('elfinder.tinymce5') }}",
                    /**
                     * On message will be triggered by the child window
                     * 
                     * @param dialogApi
                     * @param details
                     * @see https://www.tiny.cloud/docs/ui-components/urldialog/#configurationoptions
                     */
                    onMessage: function(dialogApi, details) {
                        if (details.mceAction === 'fileSelected') {
                            const file = details.data.file;

                            // Make file info
                            const info = file.name;

                            // Provide file and text for the link dialog
                            if (meta.filetype === 'file') {
                                callback(file.url, {
                                    text: info,
                                    title: info
                                });
                            }

                            // Provide image and alt text for the image dialog
                            if (meta.filetype === 'image') {
                                callback(file.url, {
                                    alt: info
                                });
                            }

                            // Provide alternative source and posted for the media dialog
                            if (meta.filetype === 'media') {
                                callback(file.url);
                            }

                            dialogApi.close();
                        }
                    }
                });
            }


            function openFileManager(model) {
                window.open('{{ route('elfinder.popup', 'a') }}?model=' + model, 'fm', 'width=1280,height=720');
            }

            // set file link
            function standAloneFmSetLink($url, model) {


                @this.set(model, $url);
            }
        </script>
    @endpush
</div>