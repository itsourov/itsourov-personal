<x-admin-layout>

    <div class="space-y-5 container mx-auto px-4 py-4">
        <h2 class="text-lg ml-1">{{ __('Download Links') }}</h2>
        <livewire:admin.manage-download-items :product="$product" />
    </div>


</x-admin-layout>
