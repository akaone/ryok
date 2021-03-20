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
    <body class="flex flex-col min-h-screen bg-gray-200">
        <div class="bg-white py-2 border-b sticky top-0 px-8 md:px-0">
            <div class="mx-auto w-full md:w-8/12 flex items-center text-blue-600">
                <a href="{{  url()->previous() }}" class="hover:bg-gray-100 p-2 rounded-full cursor-pointer mr-2">
                    <x-heroicon-s-arrow-left class="w-4 h-4"/>
                </a>
                <span class="font-medium">Ryok</span>
            </div>
        </div>

        @yield('body')
        {{ $slot }}

        <livewire:scripts />
        <script src="{{ asset('js/alpine.js') }}"></script>
    </body>
</html>
