<div>
    <h2 class="text-lg font-bold">{{ $title }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 mt-5">
        <x-card class="lg:col-span-2">
            <h2 class="py-2">Product Info</h2>
            <hr class="dark:border-gray-700">
            <div class="form mt-4 space-y-3">
                <div>
                    <x-input.label :value="__('Title')" required="true" />
                    <x-input.text wire:model.lazy="product.title" type="text" class="mt-1" />
                </div>
                <div>
                    <x-input.label :value="__('Slug')" required="true" />
                    <x-input.text wire:model.lazy="product.slug" type="text" class="mt-1" />
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <x-input.label :value="__('Selling price')" required="true" />
                        <x-input.text wire:model.lazy="product.selling_price" type="number" class="mt-1" />
                    </div>

                    <div>
                        <x-input.label :value="__('Regular Price')" required="false" />
                        <x-input.text wire:model.lazy="product.original_price" type="number" class="mt-1" />
                    </div>
                </div>

                <div>
                    <x-input.label :value="__('Short Description')" required="true" />
                    <x-input.textarea wire:model.lazy="product.short_description" type="text" class="mt-1"
                        rows="4">
                    </x-input.textarea>
                </div>
                <div wire:ignore class="space-y-1">
                    <x-input.label :value="__('Long Description')" required="true" />
                    <x-input.textarea wire:model="product.long_description" class=" mt-1" id="long_description"
                        rows="6">
                        {{ $product['long_description'] }}</x-input.textarea>

                </div>
                <div>
                    <x-error-list :errors="$errors->get('product.*')" />
                </div>
                <x-button.primary wire:click="update">Update</x-button.primary>

            </div>
        </x-card>
        <x-card>
            <h2 class="py-2">Product Image</h2>
            <hr class="dark:border-gray-700">

            <div class="p-4">
                @if ($product->getMedia('product-thumbnails')->last())
                    <div class="aspect-w-16 aspect-h-9 rounded overflow-hidden">
                        {{ $product->getMedia('product-thumbnails')->last() }}
                    </div>
                @endif
            </div>
            <div>
                <x-input.livewire-filepond wire:model="featuredImage" />
            </div>
            <div>
                <x-error-list :errors="$errors->get('featuredImage')" />
            </div>
        </x-card>
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
                selector: '#long_description',
                plugins: 'anchor  code autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                setup: function(editor) {
                    editor.on('init change', function() {
                        editor.save();
                    });
                    editor.on('change', function(e) {
                        @this.set('product.long_description', editor.getContent());
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

                extended_valid_elements: 'img[class|src|alt|title|width|loading=lazy]',

            });
        </script>
    @endpush
</div>
