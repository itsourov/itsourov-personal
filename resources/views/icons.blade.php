<x-app-layout>
    <div class="container mx-auto px-2 py-10">
        <div class="flex flex-wrap gap-3">

            @foreach (Storage::disk('views')->files('components/svg') as $item)
                <x-card class="flex flex-col items-center">
                    @php
                        $iconName = str_replace('components/svg/', '', str_replace('.blade.php', '', $item));
                    @endphp


                    @include(str_replace('.blade.php', '', $item), [
                        'attributes' => 'class=icon-preview',
                    ])
                    <p class="select-all text-orange-400 text-sm">
                        @php
                            $iconCode = '<x-svg.' . $iconName . ' class="w-5 h-5" />';
                        @endphp
                        {{ $iconCode }}
                    </p>
                </x-card>
            @endforeach
        </div>

    </div>

    <style>
        .icon-preview {
            width: 50px;
            height: 50px;
        }
    </style>

</x-app-layout>
