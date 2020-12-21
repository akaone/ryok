<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ryok - @yield('title')</title>
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
        <livewire:styles />
        <style>
            [x-cloak] { display: none; }
        </style>
    </head>
    <body class="flex flex-col min-h-screen">
        @yield('body')

        <livewire:scripts />
        <script src="{{ asset('js/alpine.js') }}"></script>
    </body>
</html>
