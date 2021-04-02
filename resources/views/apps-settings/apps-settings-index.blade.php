<div x-data="APPS_SETTINGS_INDEX_DATA()" x-cloak class="flex flex-col items-start px-4">
    @section('title', trans('apps.apps-settings.index.title'))

    <div class="font-thin text-md text-blue-600 mt-4">{{ __('apps.apps-settings.index.title') }}</div>

    <x-alert />

    <!-- start Apps carriers list -->
    <div class="flex items-center border-b py-2 font-medium w-full">
        <x-heroicon-o-chart-pie class="w-6 h-6 text-gray-500 mr-2"/>
        <span>{{ __('apps.apps-settings.index.carriers-title') }}</span>
    </div>

    <span class="font-light text-black text-lg py-2 w-10/12">
        {{ __('apps.apps-settings.index.carriers-description') }}
    </span>

    <x-user-can acl="app-edit" id="{{ $appId }}" >
        <button
            wire:click="updateAppCarriers"
            wire:loading.attr="disabled"
            wire:loading.class="cursor-wait"
            wire:target="pickedCarriers, updateAppCarriers"
            class="shadow rounded py-1 px-6 text-white bg-blue-600 hover:bg-blue-700 my-2">
            {{ __('apps.apps-settings.index.carriers-update-button') }}
        </button>
    </x-user-can>
    @error('pickedCarriers') <span class="text-red-600 text-sm pb-2">{{ $message }}</span> @enderror
    <div class="flex flex-wrap w-full">
        @foreach($appCarriers as $key => $item)
            <div wire:key="{{$key}}" class="w-4/12 border-l">
                <div class="flex bg-gray-100 items-center px-2 py-1">
                    <input wire:model="pickedCarriers" @if(collect($pickedCarriers)->contains($key)) checked @endif type="checkbox" value="{{ $key }}">
                    <span class="flex items-center font-bolf text-xl pl-2">
                        {{$key}}
                    </span>
                </div>
                <div class="flex flex-wrap p-2 border-b">
                    @foreach($item as $index => $value)
                        <div wire:key="{{$value->id}}" class="w-4/12 p-1">
                            <label class="pr-6 py-2" for="">
                                {{ $value->name }}
                            </label>

                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

    </div>
    <!-- end Apps carriers list -->

    <!-- Apps delete -->
    <x-user-can acl="app-state" id="{{ $appId }}" >
        <div class="flex items-center border-b py-2 font-medium w-full mt-6">
            <x-heroicon-o-trash class="w-6 h-6 text-red-500 mr-2"/>
            <span class="text-red-500">
                {{ __('apps.apps-settings.index.delete-section-title') }}
            </span>
        </div>

        <span class="font-light text-black text-lg py-2 w-10/12">
            {{ __('apps.apps-settings.index.delete-section-description') }}
        </span>

        <button
            x-on:click="toggleAppDeleteModal"
            class="shadow rounded py-1 px-6 text-white bg-red-500 hover:bg-red-600 my-2">
            {{ __('apps.apps-settings.index.delete-section-button') }}
        </button>

        <div x-show="showAppDeleteModal" class="bg-gray-100 bg-opacity-30 absolute inset-0 flex items-center justify-center">
            <div
                x-on:click.away="toggleAppDeleteModal"
                x-show="showAppDeleteModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                class="flex bg-white p-6 w-6/12 shadow-xl border-t-4 border-red-500">
                <x-heroicon-o-trash class="w-10 h-10 p-2 rounded-full border border-red-500 text-red-500 mr-4 mt-2"/>
                <div class="flex flex-col w-full">
                    <div class="flex flex-col items-start">
                        <span class="text-lg w-8/12">
                            {{ __('apps.apps-settings.index.delete-confirm') }}
                        </span>

                        <button
                            wire:loading.attr="disabled"
                            wire:loading.class="bg-gray-300 cursor-wait"
                            wire:loading.class.remove="bg-red-500 hover:bg-red-600 shadow"
                            wire:target="deleteApp"
                            wire:click="deleteApp"
                            class="flex items-center justify-center bg-red-500 hover:bg-red-600 rounded text-white px-4 py-1 w-4/12 shadow mt-4 font-light">
                            <x-icon-spinner wire:loading wire:target="deleteApp" class="animate-spin w-4 h-4 mr-3 my-1 text-white" />
                            <span wire:loading.remove wire:target="deleteApp">
                                {{ __('apps.apps-settings.index.delete-confirm-button') }}
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </x-user-can>




    <script>
        function APPS_SETTINGS_INDEX_DATA() {
            return {
                showAppDeleteModal: false,
                toggleAppDeleteModal() {
                    this.showAppDeleteModal = !this.showAppDeleteModal;
                },
            }
        }
    </script>



</div>
