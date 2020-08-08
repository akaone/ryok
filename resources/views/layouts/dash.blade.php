<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ryok - @yield('title')</title>
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
        <livewire:styles />
    </head>
    <body class="flex flex-col bg-red-500 min-h-screen">
        @yield('body')
        
        <script src="{{ asset('js/alpine.js') }}"></script>
        <livewire:scripts />
    </body>
</html>
