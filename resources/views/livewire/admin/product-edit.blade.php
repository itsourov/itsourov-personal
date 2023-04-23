<div class="container px-2 mx-auto">

    <x-card>

        <div class="space-y-5 md:p-3">
            <div class="heading  py-4 ">
                <h3 class=" font-medium text-lg">{{ $title }}</h3>
            </div>
            <div>
                @if ($errors->get('product.*'))
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="rounded-md bg-red-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <!-- Heroicon name: solid/x-circle -->
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">There were error in
                                    {{ count($errors->get('product.*')) }} feild</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul role="list" class="list-disc pl-5 space-y-1">

                                        @foreach ($errors->get('product.*') as $item)
                                            @foreach ($item as $error)
                                                <li>{{ App\Http\Helpers\Error::formatArrayError($error) }}</li>
                                            @endforeach
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>



            <div class=" border-t border-b dark:border-gray-700 py-2">
                <div class="grid grid-cols-2 gap-1 md:block md:space-y-1">
                    <x-admin.tab-button :tabItem='$tabItem' name="info">Info</x-admin.tab-button>
                    <x-admin.tab-button :tabItem='$tabItem' name="description">Descriptions</x-admin.tab-button>
                    <x-admin.tab-button :tabItem='$tabItem' name="images">Images</x-admin.tab-button>
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
                        <x-input.text wire:model="product.title" type="text" class="mt-1 block w-full" />
                    </div>
                    <div>
                        <x-input.label :value="__('Slug')" required="true" />
                        <x-input.text wire:model="product.slug" type="text" class="mt-1 block w-full" />
                    </div>

                    <div>
                        <x-input.label :value="__('Selling price')" required="true" />
                        <x-input.text wire:model="product.selling_price" type="text" class="mt-1 block w-full" />
                    </div>

                    <div>
                        <x-input.label :value="__('Regular Price')" required="false" />
                        <x-input.text wire:model="product.original_price" type="text" class="mt-1 block w-full" />
                    </div>
                    <div>
                        <x-input.label :value="__('Featured Image')" required="false" />
                        <div class="flex mt-1 gap-2">
                            <x-input.text wire:model="product.featured_image" type="url" class=" block w-full" />
                            <button onclick="openFileManager('product.featured_image')"
                                class="border border-gray-200 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 px-2">Select</button>
                        </div>

                    </div>

                </div>
                <div id="description-container" class="" {!! $tabItem == 'description' ? '' : 'style="display: none"' !!}>
                    <div class="space-y-6">
                        <div>
                            <x-input.label :value="__('Short Description')" required="true" />
                            <x-input.text wire:model="product.short_description" type="text"
                                class="mt-1 block w-full" />
                        </div>

                        <div wire:ignore>
                            <x-input.label :value="__('Long Description')" required="true" />
                            <textarea wire:model="product.long_description" class=" " id="long_description">{{ $product['long_description'] }}</textarea>
                        </div>
                    </div>
                </div>
                <div id="images-container" class="" {!! $tabItem == 'images' ? '' : 'style="display: none"' !!}>
                    <div class="space-y-6">
                        @if ($images)

                            @foreach ($images as $index => $item)
                                <div>
                                    <x-input.label :value="__('Image') . ' ' . ($index + 1)" required="true" />

                                    <img class=" w-14 h-14 object-cover ml-1" src="{{ $images[$index] }}"
                                        alt="">
                                    <div class="flex mt-1 gap-2">
                                        <x-input.text wire:model="images.{{ $index }}" type="url"
                                            class=" block w-full" />
                                        <button onclick="openFileManager('images.{{ $index }}')"
                                            class="border border-gray-200 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 px-2 product-images-select-btn">
                                            <x-svg.folder class="inline w-5 h-5" />
                                        </button>
                                        <button wire:click="removeImage({{ $index }})"
                                            class="border border-gray-200 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 px-2">
                                            <x-svg.trash class="inline w-5 h-5" />
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <x-button.primary wire:click="addNewImage">Add</x-button.primary>


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
                @if ($errors->get('product.*'))
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="rounded-md bg-red-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <!-- Heroicon name: solid/x-circle -->
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">There were error in
                                    {{ count($errors->get('product.*')) }} feild</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul role="list" class="list-disc pl-5 space-y-1">

                                        @foreach ($errors->get('product.*') as $item)
                                            @foreach ($item as $error)
                                                <li>{{ App\Http\Helpers\Error::formatArrayError($error) }}</li>
                                            @endforeach
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
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
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
        </script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script>
            const FMButton = function(context) {
                const ui = $.summernote.ui;
                const button = ui.button({
                    contents: '<i class="note-icon-picture"></i> ',
                    tooltip: 'File Manager',
                    click: function() {
                        window.open('/file-manager/summernote', 'fm', 'width=1400,height=800');
                    }
                });
                return button.render();
            };
            $('#long_description').summernote({
                tabsize: 2,
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['fm-button', ['fm']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('product.long_description', contents);
                    }
                },
                buttons: {
                    fm: FMButton
                }
            });

            // set file link
            function fmSetLink(url) {
                $('#long_description').summernote('insertImage', url);
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
