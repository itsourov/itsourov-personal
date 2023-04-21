<div class="container px-2 mx-auto">

    <x-card>

        <div class="space-y-5 md:p-3">
            <div class="heading  py-4 ">
                <h3 class=" font-medium text-lg">{{ $title }}</h3>
            </div>
            <div>
                @if ($errors->get('post.*'))
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
                                    {{ count($errors->get('post.*')) }} feild</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul role="list" class="list-disc pl-5 space-y-1">

                                        @foreach ($errors->get('post.*') as $item)
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
                <div id="content-container" class="tab-content" {!! $tabItem == 'description' ? '' : 'style="display: none"' !!}>
                    <div class="space-y-6">


                        <div wire:ignore>
                            <x-input.label :value="__('Content')" required="true" />
                            <textarea wire:model="post.content" class=" " id="post_content">{{ $post['content'] }}</textarea>
                        </div>
                    </div>
                </div>



            </div>
            <div>
                @if ($errors->get('post.*'))
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
                                    {{ count($errors->get('post.*')) }} feild</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul role="list" class="list-disc pl-5 space-y-1">

                                        @foreach ($errors->get('post.*') as $item)
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
</div>
