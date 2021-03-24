@if(count($allApps) <= 0)
    <a href="{{ route('dashboard.apps.create') }}" class="py-2 px-6 flex hover:bg-gray-200 items-center">
        <span class="mr-2">Créer une app</span>
        <x-heroicon-s-star class="w-4 h-4 text-gray-500"/>
    </a>
@else
    <div x-data="DATA()" class="flex flex-col cursor-pointer .relative">
        <div class="py-2 px-6 flex dark:hover:bg-blue-400 hover:bg-gray-200 items-center justify-between" x-on:click="toggle">
            <div class="flex flex-col items-start">
                <span class="mr-2 dark:text-white text-black">{{ $currentApp->name }}</span>
                <span class="lowercase bg-gray-400 rounded px-2 pb-1 text-xs">{{ $currentApp->state }}</span>
            </div>
            <x-heroicon-s-chevron-down class="w-4 h-4 text-gray-500"/>
        </div>
        <div
        x-on:click.away="isOpen = false"
        x-show="isOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-50 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100"
        class="bg-white shadow-md border absolute w-5/12 md:w-3/12 z-50 ml-1 mt-1 rounded">
            @foreach($allApps as $app)
                <a @if($app->id != request()->appId) href="{{ route('dashboard.apps.index', ['appId' => $app->id ]) }}" @endif>
                    <div x-on:click="toggle" class="flex flex-col items-start py-2 px-6 flex border-b hover:bg-gray-200">
                        @if($app->id == request()->appId)
                            <span class="mr-2 underline text-pblue">{{ $app->name }}</span>
                        @endif
                        @if($app->id != request()->appId)
                            <span class="mr-2">{{ $app->name }}</span>
                        @endif
                        <span class="lowercase bg-gray-400 rounded px-2 pb-1 text-xs">{{ $app->state }}</span>
                    </div>
                </a>
            @endforeach
            <a href="{{ route('dashboard.apps.create') }}" class="py-2 px-6 flex hover:bg-gray-200 items-center">
                <span class="mr-2">Créer une app</span>
                <x-heroicon-s-star class="w-4 h-4 text-gray-500"/>
            </a>
        </div>
    </div>
@endif

<script>
    function DATA() {
        return {
            isOpen: false,
            toggle() { this.isOpen = !this.isOpen },
        }
    }
</script>
