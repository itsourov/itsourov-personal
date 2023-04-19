<x-app-layout>
    <section class="">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="flex items-center justify-center px-4 py-10  sm:px-6 lg:px-8 sm:py-16 lg:py-24">
                <div class="xl:w-full xl:max-w-sm 2xl:max-w-md xl:mx-auto">
                    <h2 class="text-3xl font-bold leading-tight  sm:text-4xl">{{ __('Sign in to') }}
                        {{ config('app.name') }}</h2>
                    <p class="mt-2 text-base text-gray-600 dark:text-gray-300">
                        {{ _('Don’t have an account?') }}
                        <a href="{{ route('register') }}" title=""
                            class="font-medium text-blue-600 transition-all duration-200 hover:text-blue-700 hover:underline focus:text-blue-700">
                            {{ __('Create a free account') }}
                        </a>
                    </p>

                    <div class="mt-8 space-y-3">
                        <x-social-login-button.google />
                        <x-social-login-button.facebook />


                    </div>
                    <form action="{{ route('login') }}" method="POST" class="mt-6">
                        @csrf
                        <div class="space-y-5">
                            <div>

                                <x-input.label>{{ __('Email address') }}</x-input.label>

                                <x-input.text class="p-4" type="email" name="email"
                                    placeholder="{{ __('Enter email to get started') }}" />

                                <x-input.error :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <div class="flex items-center justify-between">
                                    <x-input.label>{{ __('Password') }}</x-input.label>
                                    <a href="{{ route('password.request') }}" title=""
                                        class="text-sm font-medium text-blue-600 hover:underline hover:text-blue-700 focus:text-blue-700">
                                        {{ __('Forgot password?') }} </a>
                                </div>

                                <x-input.text class="p-4" type="password" name="password"
                                    placeholder="{{ __('Enter your password') }}" />

                                <x-input.error :messages="$errors->get('password')" />
                            </div>

                            <div>
                                <x-button.primary class="w-full py-4 px-4">{{ __('Log in') }}</x-button.primary>
                            </div>
                        </div>
                    </form>


                </div>
            </div>

            @include('auth.inc.right-section')
        </div>
    </section>

</x-app-layout>
