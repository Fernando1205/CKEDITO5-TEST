<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="https://kit.fontawesome.com/80c9d698bb.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

        @livewireStyles

        @stack('css')

        <title>@yield('title','Laravel')</title>

    </head>
    <body class="bg-slate-100">
        @include('partials.nav')

        @yield('content')

        @livewireScripts

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

        @stack('script')

    </body>
</html>
