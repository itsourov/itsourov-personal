<x-app-layout>
    <section class="pt-10 overflow-hidden md:pt-0 sm:pt-16 2xl:pt-16">
        <div class="px-2 mx-auto container">
            <div class="grid items-center grid-cols-1 md:grid-cols-2">
                <div>
                    <h2 class="text-3xl font-bold leading-tight  sm:text-4xl lg:text-5xl">{{ __('Hey') }} 👋
                        {{ __('I am') }} <br class="block sm:hidden" />{{ __('Sourov Biswas') }}</h2>
                    <p class="max-w-lg mt-3 leading-relaxed text-gray-500 md:mt-8">Welcome to
                        <span class="font-bold">{{ config('app.name') }}</span> ! I'm Sourov Biswas, a semi-professional
                        developer and CSE student with
                        4 years of
                        experience in the tech industry. On this website, you'll find a range of technical blog posts
                        covering web development, software engineering, data science, and more. Plus, I offer digital
                        products and courses to help you expand your technical skills. Thanks for visiting, and let's
                        explore the world of technology together!
                    </p>

                    <p class="mt-4 text-xl text-gray-600 dark:text-gray-300 md:mt-8">
                        <span class="relative inline-block">
                            <span
                                class="absolute inline-block w-full bottom-0.5 h-2 bg-yellow-300 dark:bg-yellow-800"></span>
                            <span class="relative"> Have a question? </span>
                        </span>
                        <br class="block sm:hidden" />Ask me on <a href="{{ route('pages.contact') }}" title=""
                            class="transition-all duration-200 text-sky-500 hover:text-sky-600 hover:underline">{{ __('Contact') }}</a>
                        {{ __('page') }}
                    </p>
                </div>

                <div class="relative">
                    <img class="absolute inset-x-0 bottom-0 -mb-48 -translate-x-1/2 left-1/2"
                        src="https://cdn.rareblocks.xyz/collection/celebration/images/team/1/blob-shape.svg"
                        alt="" />

                    <img class="relative w-full xl:max-w-lg xl:mx-auto 2xl:origin-bottom 2xl:scale-110"
                        src="{{ asset('images/sourov.webp') }}" alt="" />
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="py-10 bg-gray-100 dark:bg-gray-800 sm:py-16 lg:py-24">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center">
                <h4 class="text-xl font-medium">Numbers tell the hard works we’ve done in last 6 years
                </h4>
            </div>

            <div class="grid grid-cols-1 gap-6 px-6 mt-8 sm:px-0 lg:mt-16 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-12">
                <div
                    class="overflow-hidden bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg">
                    <div class="px-4 py-6">
                        <div class="flex items-start">
                            <svg class="flex-shrink-0 w-12 h-12 text-fuchsia-600" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <div class="ml-4">
                                <h4 class="text-4xl font-bold ">6+</h4>
                                <p class="mt-1.5 text-lg font-medium leading-tight text-gray-500">Years in business</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="overflow-hidden bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg">
                    <div class="px-4 py-6">
                        <div class="flex items-start">
                            <svg class="flex-shrink-0 w-12 h-12 text-fuchsia-600" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <div class="ml-4">
                                <h4 class="text-4xl font-bold ">37+</h4>
                                <p class="mt-1.5 text-lg font-medium leading-tight text-gray-500">Team members</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="overflow-hidden bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg">
                    <div class="px-4 py-6">
                        <div class="flex items-start">
                            <svg class="flex-shrink-0 w-12 h-12 text-fuchsia-600" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <div class="ml-4">
                                <h4 class="text-4xl font-bold ">3,274</h4>
                                <p class="mt-1.5 text-lg font-medium leading-tight text-gray-500">Projects delivered</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="overflow-hidden bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg">
                    <div class="px-4 py-6">
                        <div class="flex items-start">
                            <svg class="flex-shrink-0 w-12 h-12 text-fuchsia-600" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <div class="ml-4">
                                <h4 class="text-4xl font-bold ">98%</h4>
                                <p class="mt-1.5 text-lg font-medium leading-tight text-gray-500">Customer success</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


</x-app-layout>
