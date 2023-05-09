<div>
    <h2 class="text-lg font-bold">{{ $title }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 mt-5">
        <div class="lg:col-span-2">
            <x-card>
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
        </div>
        <div class="space-y-4">
            <x-card>
                <h2 class="py-2">Product Image</h2>
                <hr class="dark:border-gray-700">

                <div>

                    <div class="py-4">
                        <x-input.label :value="__('Product Featured image')" />

                        @foreach ($product->getMedia('product-thumbnails') as $media)
                            <div class="aspect-w-16 aspect-h-9 rounded overflow-hidden">
                                {{ $media }}
                            </div>
                        @endforeach

                    </div>
                    <div>
                        <x-input.livewire-filepond wire:model="featuredImage" accept="image/*" />
                    </div>
                    <div>
                        <x-error-list :errors="$errors->get('featuredImage')" />
                    </div>
                </div>
                <div class="mt-6 space-y-4">

                    <div>
                        <x-input.label :value="__('Product image Gellery')" />
                        <div class="flex flex-wrap gap-3">
                            @foreach ($product->getMedia('product-images') as $productImage)
                                <div class="w-20 flex-grow relative" wire:key="item-{{ $productImage->uuid }}">
                                    <img class=" " src="{{ $productImage->getUrl('preview') }}" alt=""
                                        wire:key="image-{{ $productImage->uuid }}">
                                    <button wire:click="removeImage({{ $productImage->id }})"
                                        class=" absolute top-0 right-0 bg-gray-500 p-1 rounded">
                                        <x-svg.trash class="w-5 h-5" />
                                        <span wire:loading
                                            wire:target="removeImage({{ $productImage->id }})">Deleting</span>
                                    </button>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div>
                        <x-input.livewire-filepond wire:model="productImages" multiple accept="image/*" />
                        <x-error-list :errors="$errors->get('productImages.*')" />
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
