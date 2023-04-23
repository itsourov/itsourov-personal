<x-admin-layout>

    <div class="space-y-5 container mx-auto px-2 py-4">
        <div class="flex flex-col md:flex-row gap-3">
            <div class=" flex-grow">
                <h2 class="text-lg ml-1">{{ __('Create new Download Link') }}</h2>
                <x-card class="mt-4">

                    <form action="{{ route('admin.products.store-downloadables', $product) }}" method="post"
                        class="space-y-3">
                        @csrf
                        <div>
                            <x-input.label :value="__('Link Title')" required="true" />
                            <x-input.text name="title" :value="old('title')" type="text" class="mt-1 block w-full" />
                            <x-input.error :messages="$errors->get('title')" />
                        </div>
                        <div class="flex flex-col lg:flex-row gap-3">
                            <div class="flex-grow">
                                <x-input.label :value="__('Link Content')" required="true" />
                                <x-input.text name="content" :value="old('content')" type="text" id="content"
                                    class="mt-1 block w-full" />
                                <x-input.error :messages="$errors->get('content')" />
                            </div>
                            <div>
                                <x-input.label :value="__('Link Content')" required="true" />
                                <x-input.select name="type" class="mt-1 block w-full">
                                    <option value="" selected disabled>Select an option</option>
                                    @foreach (\App\Enums\DownloadLinkType::toArray() as $type)
                                        <option {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}
                                        </option>
                                    @endforeach
                                </x-input.select>
                                <x-input.error :messages="$errors->get('type')" />
                            </div>

                        </div>
                        <x-button.primary>Save</x-button.primary>
                        <x-button.primary type="button" onclick="openFileManager('content')">Open Filemanager
                        </x-button.primary>

                    </form>
                </x-card>
            </div>
            <div>
                <h2 class="text-lg ml-1">{{ __('Parent Product') }}</h2>

                <x-admin.shop.product-item :product="$product" />
            </div>
        </div>
        <div>
            <h2 class="text-lg ml-1">{{ __('Create new Download Link') }}</h2>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-3">
                                Link Title
                            </th>
                            <th scope="col" class="p-3">
                                Link type
                            </th>
                            <th scope="col" class="p-3">
                                Link content
                            </th>

                            <th scope="col" class="p-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product->downloadItems as $downloadable)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="p-3 max-w-xs truncate font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $downloadable->title }}
                                </th>
                                <td class="p-3">
                                    {{ $downloadable->type }}
                                </td>

                                <td class="p-3">
                                    {{ $downloadable->content }}
                                </td>
                                <td class="p-3 text-right flex gap-2">
                                    <form action="{{ route('admin.products.delete-downloadables', $downloadable) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</button>
                                    </form>
                                    <a href="#"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function openFileManager(model) {
                window.open('{{ route('elfinder.popup', 'a') }}?model=' + model, 'fm', 'width=1280,height=720');
            }

            // set file link
            function standAloneFmSetLink($url, model) {


                document.getElementById(model).value = $url;
            }
        </script>
    @endpush
</x-admin-layout>
