<x-app-layout>
    <section class="">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="flex items-center justify-center px-4 py-10  sm:px-6 lg:px-8 sm:py-16 lg:py-24">
                <div class="xl:w-full xl:max-w-sm 2xl:max-w-md xl:mx-auto">
                    <h2 class="text-3xl font-bold leading-tight sm:text-4xl">{{ __('Sign up to') }}
                        {{ config('app.name') }}</h2>
                    <p class="mt-2 text-base text-gray-600">{{ __('Already have an account?') }} <a
                            href="{{ route('login') }}" title=""
                            class="font-medium text-blue-600 transition-all duration-200 hover:text-blue-700 hover:underline focus:text-blue-700">{{ __('Login') }}</a>
                    </p>

                    <div class="mt-8 space-y-3">
                        <x-social-login-button.google />
                        <x-social-login-button.facebook />
                    </div>
                    <form action="{{ route('register') }}" method="POST" class="mt-6">
                        @csrf
                        <div class="space-y-5">
                            <div>


                                <x-input.label>{{ __('Full Name') }}</x-input.label>

                                <x-input.text class="p-4" type="text" name="name"
                                    placeholder="{{ 'Enter your full name' }}" />

                                <x-input.error :messages="$errors->get('name')" />
                            </div>

                            <div>


                                <x-input.label>{{ __('Email address') }}</x-input.label>

                                <x-input.text class="p-4" type="email" name="email"
                                    placeholder="{{ __('Enter email to get started') }}" />

                                <x-input.error :messages="$errors->get('email')" />
                            </div>

                            <div>

                                <x-input.label>{{ __('Password') }}</x-input.label>

                                <x-input.text class="p-4" type="password" name="password"
                                    placeholder="Enter your password" />

                                <x-input.error :messages="$errors->get('password')" />
                            </div>
                            <div>

                                <x-input.label>{{ __('Confirm password') }}</x-input.label>

                                <x-input.text class="p-4" type="password" name="password_confirmation"
                                    placeholder="{{ __('Confirm your password') }}" />

                                <x-input.error :messages="$errors->get('password_confirmation')" />
                            </div>

                            <div class="flex items-center">


                                <label for="agree" class=" text-sm font-medium text-gray-500">
                                    {{ 'By clicking the button below I agree to' }}
                                    {{ config('app.name') }}{{ __('’s') }} <a href="#" title=""
                                        class="text-blue-600 hover:text-blue-700 hover:underline">{{ __('Terms of Service') }}</a>
                                    {{ __('and') }} <a href="#" title=""
                                        class="text-blue-600 hover:text-blue-700 hover:underline">{{ __('Privacy Policy') }}</a>
                                </label>
                            </div>

                            <div>

                                <x-button.primary class="w-full py-4 px-4">{{ __('Create free account') }}
                                </x-button.primary>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
            @include('auth.inc.right-section')
        </div>
    </section>



</x-app-layout>
