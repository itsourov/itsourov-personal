<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin.js'])
    @livewireStyles

    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="bg-white text-gray-900 dark:text-gray-100 dark:bg-gray-900 antialiased">




    @include('admin.inc.admin-navbar')
    <div class="flex pt-16 overflow-hidden ">



        @include('admin.inc.sidebar')

        <div id="main-content" class="relative w-full h-full overflow-y-auto lg:ml-64 ">
            <main>
                {{ $slot }}




            </main>

        </div>

    </div>



    @livewireScripts
    @include('inc.notification')

    <script src="{{ asset('js/jquery-min.js') }}"></script>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
