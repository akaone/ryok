<div>
    <!-- Statistiques -->
    <a class="block px-4 mt-4" href="{{ route('dashboard.apps.index', ['appId' => $selectedApp ]) }}">
        <div
            :class="{ 'bg-gray-200 dark:bg-blue-400': isActiveRoute('/dashboard/apps/{{$selectedApp}}', true) }"
            class="py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer dark:hover:bg-blue-400 hover:bg-gray-200"
        >
            <x-heroicon-s-chart-pie class="w-4 h-4 mr-3 dark:text-white text-gray-500"/>
            <span class="dark:text-white text-black">Statisques</span>
        </div>
    </a>

    <!-- Payments -->
    <a class="block px-4" href="{{ route('dashboard.apps.operations.index', ['appId' => $selectedApp ]) }}">
        <div
            :class="{ 'bg-gray-200 dark:bg-blue-400': isActiveRoute('/apps/{{$selectedApp}}/operations') }"
            class="py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer dark:hover:bg-blue-400 hover:bg-gray-200"
        >
            <x-heroicon-s-currency-dollar class="w-4 h-4 mr-3 dark:text-white text-gray-500"/>
            <span class="dark:text-white text-black">Payments</span>
        </div>
    </a>

    <!-- Members -->
    <a class="block px-4" href="{{ route('dashboard.apps.users.index', ['appId' => $selectedApp ]) }}">
        <div
            :class="{ 'bg-gray-200 dark:bg-blue-400': isActiveRoute('/apps/{{$selectedApp}}/users') }"
            class="py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer dark:hover:bg-blue-400 hover:bg-gray-200"
        >
            <x-heroicon-s-user-group class="w-4 h-4 mr-3 dark:text-white text-gray-500"/>
            <span class="dark:text-white text-black">Members</span>
        </div>
    </a>
    </a>

    <!-- API -->
    <a class="block px-4" href="{{ route('dashboard.apps.api.index', ['appId' => $selectedApp]) }}">
        <div
            :class="{ 'bg-gray-200 dark:bg-blue-400': isActiveRoute('/apps/{{$selectedApp}}/api') }"
            class="py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer dark:hover:bg-blue-400 hover:bg-gray-200"
        >
            <x-heroicon-s-document class="w-4 h-4 mr-3 dark:text-white text-gray-500"/>
            <span class="dark:text-white text-black">API</span>
        </div>
    </a>

    <!-- Settings -->
    <a class="block px-4" href="{{ route('dashboard.apps.settings.index', ['appId' => $selectedApp]) }}">
        <div
            :class="{ 'bg-gray-200 dark:bg-blue-400': isActiveRoute('/apps/{{$selectedApp}}/settings') }"
            class="py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer dark:hover:bg-blue-400 hover:bg-gray-200"
        >
            <x-heroicon-s-cog class="w-4 h-4 mr-3 dark:text-white text-gray-500"/>
            <span class="dark:text-white text-black">Settings</span>
        </div>
    </a>

</div>
