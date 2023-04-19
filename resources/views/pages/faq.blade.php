<x-app-layout>
    <section class="py-10  sm:py-16 lg:py-24 font-sl">
        <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl font-bold leading-tight  sm:text-4xl lg:text-5xl">প্রায়শই জিজ্ঞাসিত প্রশ্ন</h2>
                <p class="max-w-xl mx-auto mt-4 text-base leading-relaxed text-gray-500">আমাদের ওয়েবসাইট সম্পর্কে আপনার
                    কোন কৌতূহল থাকলে আপনি এখানে এটি খুঁজে পেতে পারেন</p>
            </div>

            <div class="max-w-3xl mx-auto mt-8 space-y-4 md:mt-16 faq-container">
                <x-faq-item>
                    @slot('q')
                        কিভাবে একটি অ্যাকাউন্ট তৈরি করতে হয়?
                    @endslot
                    @slot('a')
                        <p>আপনি সহজেই আমাদের <a href="{{ route('register') }}" title=""
                                class="text-blue-600 transition-all duration-200 hover:underline">রেজিস্ট্রেশন পেজে</a> যেয়ে
                            আপনার জিমেইল টি ব্যবহার করে অথবা ইমেইল পাসওয়ার্ড ব্যবহার করে রেজিস্ট্রেশন করতে পারবেন </p>
                    @endslot
                </x-faq-item>




            </div>

            <p class="text-center text-gray-600 textbase mt-9">আপনি যে উত্তরটি খুঁজছেন তা খুঁজে পান নি? <a
                    href="{{ route('pages.contact') }}" title=""
                    class="font-medium text-blue-600 transition-all duration-200 hover:text-blue-700 focus:text-blue-700 hover:underline">যোগাযোগ
                    করুন</a></p>
        </div>
    </section>

</x-app-layout>
