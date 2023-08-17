<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if(auth()->user()->projectName()) {{ auth()->user()->teamName(). ' - ' . auth()->user()->projectName() . ' | ' }} @endif {{ config('app.name', 'Farming Simulator Lohnunternehmer Abrechnungstool') }}</title>

    <meta name="author" content="{{ env('META_AUTHOR') }}">
    <meta name="generator" content="{{ env('APP_NAME') }} V:{{ env('META_VERSION') }}">

    <link rel="canonical" href="{{ canonical_url() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @laravelPWA
    @stack('css')
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-800 text-gray-500 dark:text-gray-400">
@include('layouts.partials.navigation')
<div class="flex pt-16 overflow-hidden bg-gray-100 dark:bg-gray-900">
    @include('layouts.partials.sidebar')
    <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-100 lg:ml-64 dark:bg-gray-900">
        <div class="flex flex-col h-screen justify-between -mt-16">
            <!-- Page Content -->
            <main class="mb-auto bg-gray-100 dark:bg-gray-900 pt-16">
                {{ $slot }}
            </main>
            @include('layouts.partials.footer')
        </div>
    </div>
</div>
@livewireScripts
@stack('js')
@stack('scripts')
</body>
</html>
