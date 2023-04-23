<x-my-account.layout title="Profile Edit">
    <div class="container mx-auto px-2">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @include('my-account.profile.partial.profile-info-update')
            <div class="grid gap-6">
                @include('my-account.profile.partial.password-change')
                @include('my-account.profile.partial.delete-user')
            </div>

        </div>
    </div>



</x-my-account.layout>
