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
        
            <!-- Statistiques -->
            <a class="block px-4 mt-4 " href="{{ route('dashboard.stats.index') }}">
                <div
                    class="py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer hover:bg-gray-200"
                >
                    <x-heroicon-s-chart-pie class="w-4 h-4 mr-3 text-gray-500"/>
                    <span>Statisques</span>
                </div>
            </a>

            <!-- Payments -->
            <a class="block px-4" href="#">
                <div
                    class="py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer hover:bg-gray-200"
                >
                    <x-heroicon-s-currency-dollar class="w-4 h-4 mr-3 text-gray-500"/>
                    <span>Payments</span>
                </div>
            </a>

            <!-- Members -->
            <a class="block px-4" href="#">
                <div
                    class="py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer hover:bg-gray-200"
                >
                    <x-heroicon-s-user-group class="w-4 h-4 mr-3 text-gray-500"/>
                    <span>Members</span>
                </div>
            </a>
            </a>

            <!-- API -->
            <a class="block px-4" href="#">
                <div
                    class="py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer hover:bg-gray-200"
                >
                    <x-heroicon-s-document class="w-4 h-4 mr-3 text-gray-500"/>
                    <span>API</span>
                </div>
            </a>

            <!-- Settings -->
            <a class="block px-4" href="#">
                <div
                    class="py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer hover:bg-gray-200"
                >
                    <x-heroicon-s-cog class="w-4 h-4 mr-3 text-gray-500"/>
                    <span>Settings</span>
                </div>
            </a>


            <!-- Apps -->
            <a class="block px-4 mt-6" href="#">
                <div
                    class="py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer hover:bg-gray-200"
                >
                    <x-heroicon-s-view-grid class="w-4 h-4 mr-3 text-gray-500"/>
                    <span>Apps</span>
                </div>
            </a>


            <!-- Carriers -->
            <a class="block px-4" href="#">
                <div
                    class="py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer hover:bg-gray-200"
                >
                    <x-heroicon-s-status-online class="w-4 h-4 mr-3 text-gray-500"/>
                    <span>Carriers</span>
                </div>
            </a>

            <!-- Clients -->
            <a class="block px-4" href="#">
                <div
                    class="py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer hover:bg-gray-200"
                >
                    <x-heroicon-s-briefcase class="w-4 h-4 mr-3 text-gray-500"/>
                    <span>Clients</span>
                </div>
            </a>
            
            <!-- Users -->
            <a class="block px-4" href="#">
                <div
                    class="py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer hover:bg-gray-200"
                >
                    <x-heroicon-s-user-group class="w-4 h-4 mr-3 text-gray-500"/>
                    <span>Users</span>
                </div>
            </a>

        </div>
        <div class="flex flex-col flex-1 h-screen overflow-y-scroll relative">
            <div class="border-b py-2 px-4 cursor-pointer flex justify-end">
                <span class="font-light">de SOUZA Kevin</span>
            </div>
            <div class="flex-grow">
                @yield('body')
            </div>
        </div>
        
        <script src="{{ asset('js/alpine.js') }}"></script>
        <livewire:scripts />
    </body>
</html>
