 <x-card class="py-5 px-3 md:px-5">
     <header>
         <h2 class="text-lg font-medium  ">
             Profile Information
         </h2>

         <p class="mt-1 text-sm text-gray-500">
             Update your account's profile information and email address.
         </p>
     </header>

     <form id="send-verification" method="post" action="{{ route('verification.send') }}">
         @csrf
     </form>

     <div>

         <a class="spotlight inline-block"
             href="{{ auth()->user()->getMedia('profile-images')->last()?->getUrl() ?? asset('images/user.png') }}">
             <img class="rounded shadow h-36 w-36 my-4"
                 src="{{ auth()->user()->getMedia('profile-images')->last()?->getUrl() ?? asset('images/user.png') }}"
                 alt="">
         </a>
     </div>
     <form method="post" action="{{ route('my-account.profile.update') }}" class="mt-2 space-y-6"
         enctype="multipart/form-data">
         @csrf
         @method('patch')

         <div x-show="showProfileImageUploader" x-transition>
             <input type="file" id="profilePicInput" accept="image/*" name="profileImage">
         </div>


         <div>
             <x-input.label for="name" :value="__('Name')" />
             <x-input.text id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                 required autofocus autocomplete="name" />
             <x-input.error class="mt-2" :messages="$errors->get('name')" />
         </div>

         <div>
             <x-input.label for="email" :value="__('Email')" />
             <x-input.text id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                 required autocomplete="email" />
             <x-input.error class="mt-2" :messages="$errors->get('email')" />

             @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                 <div>
                     <p class="text-sm mt-2 text-gray-800 ">
                         {{ __('Your email address is unverified.') }}

                         <button form="send-verification"
                             class="underline text-sm text-gray-500  hover:  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ">
                             {{ __('Click here to re-send the verification email.') }}
                         </button>
                     </p>

                     @if (session('status') === 'verification-link-sent')
                         <p class="mt-2 font-medium text-sm text-green-600 ">
                             {{ __('A new verification link has been sent to your email address.') }}
                         </p>
                     @endif
                 </div>
             @endif
         </div>



         <div class="flex items-center gap-4">
             <x-button.primary>{{ __('Save') }}</x-button.primary>
             @if (session('status') === 'profile-updated')
                 <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                     class="text-sm text-gray-500 ">{{ __('Saved.') }}</p>
             @endif
         </div>
     </form>
 </x-card>

 <script type="module">
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[id="profilePicInput"]');
    // Create a FilePond instance
    const pond = FilePond.create(inputElement, {
        // Only accept images
        acceptedFileTypes: ['image/*'],

    });
    FilePond.setOptions({
           storeAsFile: true,

    });
</script>
