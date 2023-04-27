<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="fb:app_id" content="550300976942417" />

    @hasSection('seo')
        @yield('seo')
    @else
        {!! seo() !!}
    @endif


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

<body
    class="bg-white text-gray-900 dark:text-gray-100 dark:bg-gray-900 antialiased flex flex-col min-h-screen {{ App::getLocale() == 'bn' ? 'font-sl' : '' }}">
    @include('inc.navbar')
    <main>
        {{ $slot }}
    </main>
    @include('inc.footer')
    @include('inc.notification')

    @livewireScripts

    <script src="{{ asset('js/jquery-min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
