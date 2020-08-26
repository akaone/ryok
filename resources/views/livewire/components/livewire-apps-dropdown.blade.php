@if(count($allApps) <= 0)
    <a href="{{ route('dashboard.apps.create') }}" class="py-2 px-6 flex hover:bg-gray-200 items-center">
        <span class="mr-2">Créer une app</span>
        <x-heroicon-s-star class="w-4 h-4 text-gray-500"/>
    </a>
@else
    <div x-data="DATA()" class="flex flex-col cursor-pointer relative">
        <div class="py-2 px-6 flex hover:bg-gray-200 items-center" x-on:click="toggle">
            <span class="mr-2">{{ $currentApp->name }}</span>
            <x-heroicon-s-chevron-down class="w-4 h-4 text-gray-500"/>
        </div>
        <div
        x-on:click.away="isOpen = false"
        x-show="isOpen"
        class="bg-white shadow absolute w-full">
            @foreach($allApps as $app)
                <a href="{{ route('dashboard.apps.index', ['appId' => $app->id ]) }}">
                    <div x-on:click="toggle" .wire:click="$emit('appSelected', '{{$app->id}}')" class="py-2 px-6 flex border-b hover:bg-gray-200">
                        @if($app->id == request()->appId)
                            <span class="mr-2 underline text-pblue">{{ $app->name }}</span>
                        @endif
                        @if($app->id != request()->appId)
                            <span class="mr-2">{{ $app->name }}</span>
                        @endif
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