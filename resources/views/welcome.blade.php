<x-app-layout>
    <section class="bg-gray-100 dark:bg-gray-900">


        <div class="container mx-auto ">
            <div class="grid grid-cols-1 md:grid-cols-2 ">
                <div class="flex justify-center md:justify-end text-6xl ">
                    <img src="{{ asset('images/sourov.webp') }}" class="max-w-sm w-9/12 " alt="">
                </div>

                <div class="flex justify-center md:justify-start md:order-first items-center ">

                    <div class="flex-col items-center text-center md:text-start pt-5 pb-10 px-2">

                        <div class="social-buttons ">

                            {{-- <x-socialButton>
                                <x-ri-facebook-fill />
                            </x-socialButton>


                            <x-socialButton>
                                <x-ri-linkedin-fill />
                            </x-socialButton>


                            <x-socialButton>
                                <x-ri-stack-overflow-line />

                            </x-socialButton>


                            <x-socialButton>
                                <x-ri-github-fill />

                            </x-socialButton>


                            <x-socialButton>
                                <x-ri-whatsapp-line />
                            </x-socialButton> --}}

                        </div>


                        <h3 class="text-3xl mt-10 font-bold dark:text-white ">{{ __('Hello') }}</h3>


                        <h2 class="text-4xl my-2 font-bold dark:text-white ">{{ __('My name is') }} <span
                                class="text-blue-600 dark:text-blue-500">{{ __('Sourov Biswas') }}</span></h2>

                        <p class="text-base my-2 text-gray-900 dark:text-white">
                            {{ __('Web developer, WordPress Expert. App developer! I can build website and app for you!') }}
                        </p>
                        <a href="{{ route('pages.contact') }}" type="button"
                            class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ __('Contact us') }}
                        </a>





                    </div>



                </div>


            </div>
        </div>



    </section>

    <section class="bg-gray-200 dark:bg-gray-800 px-2">
        <div class="container mx-auto ">
            <div class="py-14">
                <h2 class="text-2xl  font-medium dark:text-white ">{{ __('Things i do') }}</h2>
                <p class="text-base my-2 text-gray-900 dark:text-white">
                    {{ __('Here is some list of my service that I provide with MONEY back guarantee.') }}</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6 text-center">

                    @php
                        
                        $jobs = [
                            [
                                'title' => 'Web development',
                                'desc' => 'Create a custom website for your personal or business uses.',
                                'image' => 'images/jobs/website.webp',
                            ],
                            [
                                'title' => 'Mobile app',
                                'desc' => 'Turn your business idea into an Android or IOS application',
                                'image' => 'images/jobs/app.webp',
                            ],
                            [
                                'title' => 'Virtual assistant',
                                'desc' => 'I will help you with your digital tasks as your Virtual assistant',
                                'image' => 'images/jobs/assistant.webp',
                            ],
                        ];
                    @endphp

                    @foreach ($jobs as $job)
                        <div
                            class="block p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-900 dark:border-gray-700 dark:hover:bg-gray-700">
                            <img src="{{ asset($job['image']) }}" alt="" class="mx-auto"
                                style="max-width: 80px">
                            <h3 class="text-2xl  dark:text-white ">{{ $job['title'] }}</h3>
                            <p class="font-normal text-gray-700 dark:text-gray-400"> {{ $job['desc'] }}</p>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-100 dark:bg-gray-900 px-2">


        <div class="container mx-auto py-14">
            <h2 class="text-2xl font-medium dark:text-white ">{{ __('Languages I speak') }}</h2>

            <div class="flex flex-wrap gap-6 mt-6">
                @php
                    $languages = [
                        [
                            'image' => 'images/languages/java.webp',
                        ],
                        [
                            'image' => 'images/languages/php.webp',
                        ],
                        [
                            'image' => 'images/languages/dart.webp',
                        ],
                        [
                            'image' => 'images/languages/js.webp',
                        ],
                        [
                            'image' => 'images/languages/html.webp',
                        ],
                        [
                            'image' => 'images/languages/css.webp',
                        ],
                    ];
                @endphp

                @foreach ($languages as $language)
                    <div
                        class="text-center basis-0 flex-grow shrink-0 p-3 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 ">


                        <img class="inline-block" src="{{ asset($language['image']) }}" alt=""
                            style=" min-width: 80px;max-width: 100%;">
                    </div>
                @endforeach
            </div>
        </div>
    </section>





</x-app-layout>
