 <x-card class="py-5 px-3 md:px-5">
     <header>
         <h2 class="text-lg font-medium  ">
             {{ __('Delete Account') }}
         </h2>

         <p class="mt-1 text-sm text-gray-500 ">
             {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
         </p>
     </header>

     <x-button.danger class="mt-3" x-data=""
         x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
         {{ __('Delete Account') }}
     </x-button.danger>

     <x-modal-static name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
         <form method="post" action="{{ route('my-account.profile.destroy') }}" class="p-6">
             @csrf
             @method('delete')

             <h2 class="text-lg font-medium  ">
                 {{ __('Are you sure you want to delete your account?') }}
             </h2>

             <p class="mt-1 text-sm text-gray-500 ">
                 {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please fill in the form below to confirm you would like to permanently delete your account.') }}
             </p>
             @if (auth()->user()->password)
                 <div class="mt-6">
                     <x-input.label for="password" value="Password" class="sr-only" />

                     <x-input.text id="password" name="password" type="password" class="mt-1 block "
                         placeholder="Password" />

                     <x-input.error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                 </div>
             @else
                 <div class="mt-6">
                     <x-input.label for="confirmation" value="confirmation" />

                     <x-input.text id="confirmation" name="confirmation" type="text" class="mt-1 block "
                         placeholder="type 'delete' here" />

                     <x-input.error :messages="$errors->userDeletion->get('confirmation')" class="mt-2" />
                 </div>
             @endif
             <div class="mt-6 flex justify-end">
                 <x-button.secondary x-on:click="$dispatch('close')">
                     {{ __('Cancel') }}
                 </x-button.secondary>

                 <x-button.danger class="ml-3">
                     {{ __('Delete Account') }}
                 </x-button.danger>
             </div>
         </form>
     </x-modal-static>
 </x-card>
