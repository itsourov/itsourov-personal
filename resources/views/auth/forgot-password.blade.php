<x-app-layout>
    <section class="">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="flex items-center justify-center px-4 py-10  sm:px-6 lg:px-8 sm:py-16 lg:py-24">
                <div class="xl:w-full xl:max-w-sm 2xl:max-w-md xl:mx-auto space-y-6">
                    <h2 class="text-3xl font-bold leading-tight  sm:text-4xl">{{ __('Password Reset') }}</h2>
                    <p class="text-gray-500">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </p>



                    <form action="{{ route('password.email') }}" method="POST" class="">
                        @csrf
                        <div class="space-y-5">
                            <div>

                                <x-input.label>{{ __('Email address') }}</x-input.label>

                                <x-input.text class="p-4" type="email" name="email"
                                    placeholder="{{ __('Enter email to get started') }}" />

                                <x-input.error :messages="$errors->get('email')" />
                                @if (session()->has('status'))
                                    <p class="text-orange-400">{{ session('status') }}</p>
                                @endif
                            </div>



                            <div>
                                <x-button.primary class="w-full py-4 px-4">{{ __('Reseet Password') }}
                                </x-button.primary>
                            </div>
                        </div>
                    </form>
                    <p class="mt-2 text-base text-gray-600 dark:text-gray-300">
                        {{ _('Don’t have an account?') }}
                        <a href="{{ route('register') }}" title=""
                            class="font-medium text-blue-600 transition-all duration-200 hover:text-blue-700 hover:underline focus:text-blue-700">
                            {{ __('Create a free account') }}
                        </a>
                    </p>


                </div>
            </div>

            @include('auth.inc.right-section')
        </div>
    </section>

</x-app-layout>
