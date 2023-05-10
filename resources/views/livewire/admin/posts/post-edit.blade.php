<div>
    <h2 class="text-lg font-bold">{{ $title }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 mt-5">
        <div class="lg:col-span-2">
            <x-card>
                <h2 class="py-2">Post Info</h2>
                <hr class="dark:border-gray-700">
                <div class="form mt-4 space-y-3">
                    <div>
                        <x-input.label :value="__('Title')" required="true" />
                        <x-input.text wire:model.lazy="post.title" type="text" class="mt-1" />
                    </div>
                    <div>
                        <x-input.label :value="__('Slug')" required="true" />
                        <x-input.text wire:model.lazy="post.slug" type="text" class="mt-1" />
                    </div>


                    <div wire:ignore class="space-y-1">
                        <x-input.label :value="__('Content')" required="true" />
                        <x-input.textarea wire:model="post.content" class=" mt-1 block w-full" id="post_content"
                            rows="6">
                            {{ $post['content'] }}</x-input.textarea>

                    </div>
                    <div>
                        <x-error-list :errors="$errors->get('post.*')" />
                    </div>
                    <x-button.primary wire:click="update">Update</x-button.primary>

                </div>
            </x-card>
        </div>
        <div class="space-y-4">
            <x-card class="space-y-2">
                <h2 class="">Post Status</h2>
                <hr class="dark:border-gray-700">

                <div>

                    <x-input.select wire:model="post.status" class="mt-1 block w-full">
                        <option value="" disabled>Select an option</option>
                        @foreach (\App\Enums\VisibilityStatus::toArray() as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </x-input.select>

                </div>
            </x-card>
            <x-card>
                <h2 class="py-2">Post Image</h2>
                <hr class="dark:border-gray-700">

                <div>

                    <div class="py-4">
                        <x-input.label :value="__('Post Featured image')" />

                        <div class=" space-y-2">
                            @foreach ($post->getMedia('post-thumbnails') as $media)
                                <div class="aspect-w-16 aspect-h-9 rounded overflow-hidden">
                                    {{ $media }}
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div>
                        <x-input.livewire-filepond wire:model="featuredImage" accept="image/*" />
                    </div>
                    <div>
                        <x-error-list :errors="$errors->get('featuredImage')" />
                    </div>
                </div>

            </x-card>
            <x-card class="space-y-2">
                <h2 class="">Product Category</h2>
                <hr class="dark:border-gray-700">

                <div>
                    <x-input.select multiple class="w-full h-60 space-y-2" wire:model.lazy="selectedCategories">
                        @foreach ($categories as $category)
                            <option class="p-2 border dark:border-gray-800 rounded" value="{{ $category->id }}">
                                {{ $category->title }}</option>
                        @endforeach
                    </x-input.select>

                </div>
            </x-card>
        </div>
    </div>

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
                            var img = editor.selection.getNode();
                            img.setAttribute('src', img.src)
                            img.setAttribute('srcset', img.title)
                            img.setAttribute('title', img.alt)
                            img.setAttribute('class', 'w-full h-full object-cover')
                            img.setAttribute('onload',
                                "window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});"
                            )

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
                image_title: true,
                // forced_root_block: 'p',
                convert_urls: false,
                extended_valid_elements: 'img[srcset|onload|sizes=50px|src|width|height|class|alt|title]',


            });




            function elFinderBrowser(callback, value, meta) {
                tinymce.activeEditor.windowManager.openUrl({
                    title: 'File Manager',
                    url: "{{ route('admin.media-library') }}",
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
                            console.log(file);
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
                                    alt: info,
                                    title: file.srcset
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
        </script>
    @endpush
</div>
