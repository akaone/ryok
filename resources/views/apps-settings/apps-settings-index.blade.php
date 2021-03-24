<div class="flex flex-col items-start px-4">
    @section('title', trans('apps.apps-settings.index.title'))

    <div class="font-thin text-md text-blue-600 mt-4">Settings</div>

    @component('components.alert')@endcomponent

    <div class="flex items-center border-b py-2 font-medium w-full">
        <x-heroicon-o-chart-pie class="w-6 h-6 text-gray-500 mr-2"/>
        <span>Carriers</span>
    </div>

    <span class="font-light text-black text-lg py-2">
        Below are all the countries we currently support. Check or uncheck the countries that you want to accept payment from
    </span>

    <button
        wire:click="updateAppCarriers"
        wire:loading.attr="disabled"
        wire:loading.class="cursor-wait"
        wire:target="pickedCarriers, updateAppCarriers"
        class="shadow rounded py-1 px-6 text-white bg-blue-600 hover:bg-blue-700 my-2">
        Click here to save
    </button>
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

</div>
