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
            pre {
                line-height: 0;
                counter-reset: line;
            }
            pre span {
                display: block;
                line-height: 1.5rem;
            }
            pre span:before {
                counter-increment: line;
                content: counter(line);
                display: inline-block;
                border-right: 1px solid #ddd;
                padding: 0 .5em;
                margin-right: .5em;
                color: #888;
            }
        </style>
    </head>
    <body class="flex flex-row min-h-screen" style="min-width: 930px !important;">
        <div class="w-1/5 border-r h-screen dark:bg-gray-900 bg-gray-100 overflow-y-scroll">

            @if(auth()->user()->type == 'member')
                <div x-cloak x-data="LIMKS_DATA()">
                    <livewire:components.livewire-apps-dropdown />
                    <livewire:components.livewire-sidemenu  />
                </div>
            @endif

            @if(auth()->user()->type == 'staff')
                <div x-cloak x-data="LIMKS_DATA()">
                    <!-- Apps -->
                    <a class="block px-4 mt-12" href="{{ route('dashboard.staff.apps.list') }}">
                        <div
                            :class="{ 'bg-gray-200 dark:bg-blue-400': isActiveRoute('/list') }"
                            class="my-1 py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer dark:hover:bg-blue-400 hover:bg-gray-200"
                        >
                            <x-heroicon-s-view-grid class="w-4 h-4 mr-3 dark:text-white text-gray-500"/>
                            <span class="dark:text-white text-black">Apps</span>
                        </div>
                    </a>


                    <!-- Carriers -->
                    <a class="block px-4" href="{{ route('dashboard.carriers.index') }}">
                        <div
                            :class="{ 'bg-gray-200 dark:bg-blue-400': isActiveRoute('/carriers') }"
                            class="my-1 py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer dark:hover:bg-blue-400 hover:bg-gray-200"
                        >
                            <x-heroicon-s-status-online class="w-4 h-4 mr-3 dark:text-white text-gray-500"/>
                            <span class="dark:text-white text-black">Carriers</span>
                        </div>
                    </a>

                    <!-- Clients -->
                    <a class="block px-4" href="{{ route('dashboard.staff.clients.index') }}">
                        <div
                            :class="{ 'bg-gray-200 dark:bg-blue-400': isActiveRoute('/staff/clients') }"
                            class="my-1 py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer dark:hover:bg-blue-400 hover:bg-gray-200"
                        >
                            <x-heroicon-s-briefcase class="w-4 h-4 mr-3 dark:text-white text-gray-500"/>
                            <span class="dark:text-white text-black">Clients</span>
                        </div>
                    </a>

                    <!-- Merchants -->
                    <a class="block px-4" href="{{ route('dashboard.staff.merchants.index') }}">
                        <div
                            :class="{ 'bg-gray-200 dark:bg-blue-400': isActiveRoute('/staff/merchants') }"
                            class="my-1 py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer dark:hover:bg-blue-400 hover:bg-gray-200"
                        >
                            <x-heroicon-s-collection class="w-4 h-4 mr-3 dark:text-white text-gray-500"/>
                            <span class="dark:text-white text-black">Merchants</span>
                        </div>
                    </a>

                    <!-- Operations -->
                    <a class="block px-4" href="{{ route('dashboard.staff.operations.index') }}">
                        <div
                            :class="{ 'bg-gray-200 dark:bg-blue-400': isActiveRoute('/staff/operations') }"
                            class="my-1 py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer dark:hover:bg-blue-400 hover:bg-gray-200"
                        >
                            <x-heroicon-s-view-boards class="w-4 h-4 mr-3 dark:text-white text-gray-500"/>
                            <span class="dark:text-white text-black">Operations</span>
                        </div>
                    </a>

                    <!-- Messages -->
                    <a class="block px-4" href="{{ route('dashboard.staff.messages.index') }}">
                        <div
                            :class="{ 'bg-gray-200 dark:bg-blue-400': isActiveRoute('/staff/messages') }"
                            class="my-1 py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer dark:hover:bg-blue-400 hover:bg-gray-200"
                        >
                            <x-heroicon-s-beaker class="w-4 h-4 mr-3 dark:text-white text-gray-500"/>
                            <span class="dark:text-white text-black">Messages</span>
                        </div>
                    </a>

                    <!-- Users -->
                    <a class="block px-4" href="{{ route('dashboard.staff.users.index') }}">
                        <div
                            :class="{ 'bg-gray-200 dark:bg-blue-400': isActiveRoute('/staff/users') }"
                            class="my-1 py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer dark:hover:bg-blue-400 hover:bg-gray-200"
                        >
                            <x-heroicon-s-user-group class="w-4 h-4 mr-3 dark:text-white text-gray-500"/>
                            <span class="dark:text-white text-black">Users</span>
                        </div>
                    </a>

                    <!-- Named Entity Recognition -->
                    <a class="block px-4" href="{{ route('dashboard.staff.ner.index') }}">
                        <div
                            :class="{ 'bg-gray-200 dark:bg-blue-400': isActiveRoute('staff/named-entity-recognition') }"
                            class="my-1 py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer dark:hover:bg-blue-400 hover:bg-gray-200"
                        >
                            <x-heroicon-s-cloud class="w-4 h-4 mr-3 dark:text-white text-gray-500"/>
                            <span class="dark:text-white text-black">Named Entity Recognition</span>
                        </div>
                    </a>
                </div>
            @endif

        </div>
        <div class="flex flex-col flex-1 h-screen overflow-y-scroll relative">
            <livewire:components.livewire-top />
            <div class="flex-grow dark:bg-gray-800">
                @yield('body')
            </div>
        </div>

        <livewire:scripts />
        <script src="{{ asset('js/alpine.js') }}"></script>
    </body>
</html>

<script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.querySelector('html').classList.add('dark')
    } else {
        document.querySelector('html').classList.remove('dark')
    }
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
