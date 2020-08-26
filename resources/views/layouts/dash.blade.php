<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ryok - @yield('title')</title>
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
        <livewire:styles />
    </head>
    <body class="flex flex-row min-h-screen" style="min-width: 930px !important;">
        <div class="w-1/5 border-r h-screen bg-gray-100 overflow-y-scroll">

            <livewire:components.livewire-apps-dropdown />
            <livewire:components.livewire-sidemenu />
            
        </div>
        <div class="flex flex-col flex-1 h-screen overflow-y-scroll relative">
            <livewire:components.livewire-top />
            <div class="flex-grow">
                @yield('body')
            </div>
        </div>
        
        <script src="{{ asset('js/alpine.js') }}"></script>
        <livewire:scripts />
    </body>
</html>
