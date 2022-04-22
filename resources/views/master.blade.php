<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="https://kit.fontawesome.com/80c9d698bb.js" crossorigin="anonymous"></script>

        <title>@yield('title','Laravel')</title>

        @livewireStyles
    </head>
    <body class="bg-slate-100">
        @include('partials.nav')

        @yield('content')

        @livewireScripts
        <script src="{{ asset('js/app.js') }}"></script>

    </body>
</html>
