<div class="space-y-6" wire:init="init">

    <div class="bg-red-100">
        {{ $tokenExpired }}
    </div>
    <x-card>
        @foreach ($data as $key => $value)
            <p>{{ $key }} - {{ $value }}</p>
        @endforeach
    </x-card>

    <a class="inline-block" href="{{ route('google-drive.redirect') }}">
        <x-button.primary>
            {{ __('Redirect') }}
        </x-button.primary>
    </a>
</div>
