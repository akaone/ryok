@if(count($allApps) <= 0)
    <a href="{{ route('dashboard.apps.create') }}" class="py-2 px-6 flex hover:bg-gray-200 items-center">
        <span class="mr-2">Créer une app</span>
        <x-heroicon-s-star class="w-4 h-4 text-gray-500"/>
        <div ></div>
    </a>
@else
    <div x-data="DATA()" class="flex flex-col cursor-pointer relative">
        <div class="py-2 px-6 flex hover:bg-gray-200" x-on:click="toggle">
            <span class="mr-2">Cactus Practile</span>
            <span>+</span>
        </div>
        <div
        x-on:click.away="isOpen = false"
        x-show="isOpen"
        class="bg-white shadow absolute w-full">
            @foreach($allApps as $app)
                <div class="py-2 px-6 flex border-b hover:bg-gray-200">
                    <span class="mr-2">Shared movies</span>
                </div>
            @endforeach
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