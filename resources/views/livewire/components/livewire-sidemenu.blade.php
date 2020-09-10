<div>
    <!-- Statistiques -->
    <a class="block px-4 mt-4" href="{{ route('dashboard.apps.index', ['appId' => $selectedApp ]) }}">
        <div
            :class="{ 'bg-gray-200': isActiveRoute('/dashboard/apps/{{$selectedApp}}', true) }"
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
    <a class="block px-4" href="{{ route('dashboard.apps.users.index', ['appId' => $selectedApp ]) }}">
        <div
            :class="{ 'bg-gray-200': isActiveRoute('/apps/{{$selectedApp}}/users') }"
            class="py-2 px-2 rounded flex items-center text-sm font-light cursor-pointer hover:bg-gray-200"
        >
            <x-heroicon-s-user-group class="w-4 h-4 mr-3 text-gray-500"/>
            <span>Members</span>
        </div>
    </a>
    </a>

    <!-- API -->
    <a class="block px-4" href="{{ route('dashboard.apps.api.index', ['appId' => $selectedApp]) }}">
        <div
            :class="{ 'bg-gray-200': isActiveRoute('/apps/{{$selectedApp}}/api') }"
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

</div>