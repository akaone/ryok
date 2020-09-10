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
    <body class="flex flex-row min-h-screen" style="min-width: 930px !important;">
        <div class="w-1/5 border-r h-screen bg-gray-100 overflow-y-scroll">
            
            @if(auth()->user()->type == 'member')
                <div  x-data="LIMKS_DATA()">
                    <livewire:components.livewire-apps-dropdown />
                    <livewire:components.livewire-sidemenu />
                </div>
            @endif
            
            @if(auth()->user()->type == 'staff')
                <div  x-data="LIMKS_DATA()">
                    <!-- Apps -->
                    <a class="block px-4 mt-12" href="{{ route('dashboard.apps.list') }}">
                        <div
                            :class="{ 'bg-gray-200': isActiveRoute('/apps/list') }"
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
            @endif
            
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

<script>
    function LIMKS_DATA() {
        return {
            isActiveRoute(url, isExact = false) {
                if(isExact){
                    return window.location.pathname == url
                }
                return window.location.pathname.includes(url)
            },
        }
    }
</script>