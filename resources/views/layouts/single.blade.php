<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="{{ env('META_AUTHOR') }}">
    <meta name="generator" content="{{ env('APP_NAME') }} V:{{ env('META_VERSION') }}">

{{--    <title>{!! Meta::get('title') !!}</title>--}}
    <link rel="canonical" href="{{ canonical_url() }}">

    @include('layouts.partials.stylesheet')
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body>
    @yield('content')
</body>
</html>
