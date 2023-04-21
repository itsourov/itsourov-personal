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


                <div id="info-container" class="tab-content space-y-5" {!! $tabItem == 'info' ? '' : 'style="display: none"' !!}>


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
                        <div class="flex mt-1 gap-2">
                            <x-input.text wire:model="post.featured_image" type="url" class=" block w-full" />
                            <button onclick="openFileManager('post.featured_image')"
                                class="border border-gray-200 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 px-2">Select</button>
                        </div>

                    </div>

                </div>
                <div id="content-container" class="tab-content" {!! $tabItem == 'content' ? '' : 'style="display: none"' !!}>
                    <div class="space-y-6">


                        <div wire:ignore>
                            <x-input.label :value="__('Content')" required="true" />
                            <x-input.textarea wire:model="post.content" class=" mt-1 block w-full" id="post_content"
                                rows="6">
                                {{ $post['content'] }}</x-input.textarea>

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
                plugins: 'anchor code autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                setup: function(editor) {
                    editor.on('init change', function() {
                        editor.save();
                    });
                    editor.on('change', function(e) {
                        @this.set('post.content', editor.getContent());
                    });
                }
            });
        </script>
    @endpush
</div>
