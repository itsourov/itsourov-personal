<div>
    <section class="py-10 sm:py-16 ">
        <div class="container mx-auto px-2">
            <div class="text-center space-y-3">
                <h2 class="text-3xl font-bold leading-tight sm:text-4xl lg:text-5xl">{{ __('Contact us') }}</h2>
                <p class="max-w-xl mx-auto text-base leading-relaxed text-gray-500">
                    {{ __('Our goal is to assist you and address any inquiries you may have. We eagerly anticipate receiving your message.') }}
                </p>
            </div>
            <div class="mt-12 space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                    <x-card class="px-5 py-5 text-center">
                        <svg class="w-10 h-10 text-gray-500 mx-auto" fill="none" stroke="currentColor" stroke-width="1"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z">
                            </path>
                        </svg>
                        <a href="tel:+8801872934185">
                            <p class="mt-4">+8801872934185</p>
                        </a>

                    </x-card>

                    <x-card class="px-5 py-5 text-center">
                        <svg class="w-10 h-10 text-gray-500 mx-auto" fill="none" stroke="currentColor"
                            stroke-width="1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75">
                            </path>
                        </svg>
                        <a href="mailto:itsourov12@gmail.com">
                            <p class="mt-4">itsourov12@gmail.com</p>
                        </a>

                    </x-card>
                    <x-card class="px-5 py-5 text-center">
                        <svg class="w-10 h-10 text-gray-500 mx-auto" fill="none" stroke="currentColor"
                            stroke-width="1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"></path>
                        </svg>
                        <p class="mt-4">{{ __('Magura, Khulna, Bangladesh') }}</p>
                    </x-card>
                </div>
                <x-card class="py-10 px-4 space-y-4">
                    <h3 class="text-3xl font-semibold text-center">{{ __('Send us a message') }}</h3>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input.label :value="__('Your name')" required="true" />
                            <x-input.text wire:model.lazy="name" type="text" class="mt-1 block w-full"
                                autocomplete="name" />
                            <x-input.error :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input.label :value="__('Email address')" required="true" />
                            <x-input.text wire:model.lazy="email" type="text" class="mt-1 block w-full"
                                autocomplete="email" />
                            <x-input.error :messages="$errors->get('email')" />
                        </div>
                        <div>
                            <x-input.label :value="__('Phone number')" required="true" />
                            <x-input.text wire:model.lazy="phone" type="text" class="mt-1 block w-full"
                                autocomplete="phone" />
                            <x-input.error :messages="$errors->get('phone')" />
                        </div>
                        <div>
                            <x-input.label :value="__('Company name') . ' (' . __('if available') . ')'" />
                            <x-input.text wire:model.lazy="company" type="text" class="mt-1 block w-full"
                                autocomplete="company" />
                            <x-input.error :messages="$errors->get('company')" />
                        </div>
                        <div class=" col-span-2">
                            <x-input.label :value="__('Message')" required="true" />
                            <x-input.textarea wire:model.lazy="message" type="text" class="mt-1 block w-full"
                                rows="4"></x-input.textarea>
                            <x-input.error :messages="$errors->get('message')" />
                        </div>
                    </div>
                    <x-button.primary wire:click="submit" class="w-full mt-4 py-3">
                        <span wire:loading target="submit">
                            <x-svg.spinner class="w-4 h-4 mr-1 animate-spin" />
                        </span>
                        <span>
                            {{ __('Send') }}
                        </span>
                    </x-button.primary>

                </x-card>
            </div>
        </div>
    </section>

</div>
