<x-admin-layout>


    <div class="space-y-5 container mx-auto px-4 py-4">
        <div class=" grid grid-cols-1 lg:grid-cols-5 gap-3 ">
            <div class="lg:col-span-2">
                <x-card>
                    <form action="{{ route('admin.categories.store') }}" method="post" class="space-y-3">
                        @csrf
                        <div>
                            <x-input.label :value="__('Category Title')" required="true" />
                            <x-input.text name="title" :value="old('title')" type="text" class="mt-1 block w-full" />
                            <x-input.error :messages="$errors->get('title')" />
                        </div>
                        <div>
                            <x-input.label :value="__('Category slug')" required="true" />
                            <x-input.text name="slug" :value="old('slug')" type="text" class="mt-1 block w-full" />
                            <x-input.error :messages="$errors->get('slug')" />
                        </div>
                        <div>
                            <x-input.label :value="__('Category description')" required="true" />
                            <x-input.text name="description" :value="old('description')" type="text"
                                class="mt-1 block w-full" />
                            <x-input.error :messages="$errors->get('description')" />
                        </div>
                        <div>
                            <x-input.label :value="__('Category Type')" required="true" />
                            <x-input.select name="type" class="mt-1 block w-full">
                                <option value="" selected disabled>Select an option</option>
                                @foreach (\App\Enums\CategoryType::toArray() as $type)
                                    <option {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </x-input.select>

                            <x-input.error :messages="$errors->get('type')" />
                        </div>

                        <x-button.primary>Save</x-button.primary>
                    </form>
                </x-card>
            </div>
            <div class="lg:col-span-3">

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-3">
                                    Category Title
                                </th>
                                <th scope="col" class="p-3">
                                    Slug
                                </th>
                                <th scope="col" class="p-3">
                                    Category type
                                </th>
                                <th scope="col" class="p-3">
                                    Actions
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $category->title }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $category->slug }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $category->type }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
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
    </div>
</x-admin-layout>
