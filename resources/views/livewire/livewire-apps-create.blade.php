<div class="bg-gray-200">

    <div class="bg-white border px-8 mx-auto w-full md:w-8/12 m-4 rounded">
        <div class='pt-6 pb-2'>
            <span class="text-lg text-pblue">{{trans('apps.create.section-title')}}</span>
        </div>

        <form wire:submit.prevent="save" class="my-6">

            <h3 class="border-b mt-4 mb-2">{{trans('apps.create.app-infos')}}</h3>
            <div class="flex flex-col md:flex-row">
                <label class="cursor-pointer w-24 h-24 bg-gray-200 hover:bg-gray-300 rounded">
                    <input type="file" wire:model="appIcon" class="absolute opacity-0 -z-1">
                    <div wire:loading wire:target="appIcon" class='absolute z-10'>{{trans('apps.create.loading')}}</div>
                    @if ($appIcon)
                        <img class="object-cover h-24 w-full p-1 rounded" src="{{ $appIcon->temporaryUrl() }}">
                    @endif
                    @error('appIcon') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </label>

                <div class="md:ml-6 flex-1">
                
                    <div class="flex flex-col mb-4 md:w-8/12">
                        <label class="">{{trans('apps.create.app-name')}}</label>
                        <span class=" text-gray-600 text-sm mt-1 pr-1">
                            {{trans('apps.create.app-name-desc')}}
                        </span>
                        <input wire:model="appName" type="text" class="border rounded h-8 px-2" >
                        @error('appName') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                
                    <div class="flex flex-col mb-4 md:w-8/12">
                        <label class="">{{trans('apps.create.app-siteweb')}}</label>
                        <span class=" text-gray-600 text-sm mt-1 pr-1">
                            {{trans('apps.create.app-siteweb-desc')}}
                        </span>
                        <input wire:model="website" type="text" class="border rounded h-8 px-2" >
                        @error('website') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="flex flex-col mb-4 md:w-8/12">
                        <label class="">{{trans('apps.create.app-webhook')}}</label>
                        <span class=" text-gray-600 text-sm mt-1 pr-1">
                        {{trans('apps.create.app-webhook-desc')}}
                        </span>
                        <input wire:model="webhookUrl" type="text" class="border rounded h-8 px-2" >
                        @error('webhookUrl') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                
                </div>
            </div>

            <h3 class="border-b mt-4 mb-2">{{trans('apps.create.app-legal-infos')}}</h3>

            <div class='flex'>
                <div class="w-24 h-24 bg-white rounded hidden md:block"></div>

                <div class="md:ml-6 flex-1">
                
                    <div class="flex flex-col mb-4 md:w-8/12">
                        <label class="">{{trans('apps.create.app-organisation-name')}}</label>
                        <span class=" text-gray-600 text-sm mt-1 pr-1">
                            {{trans('apps.create.app-organisation-name-desc')}}
                        </span>
                        <input wire:model="organization" type="text" class="border rounded h-8 px-2" >
                        @error('organization') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                
                    <div class="flex flex-col mb-4 md:w-8/12">
                        <label class="">{{trans('apps.create.app-organisation-nif')}}</label>
                        <span class="font-thin text-gray-600 text-sm mt-1 pr-1">
                            {{trans('apps.create.app-organisation-nif-desc')}}
                        </span>
                        <input wire:model="nif" type="text" class="border rounded h-8 px-2" >
                        @error('nif') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>


                    <label class="font-thin">{{trans('apps.create.app-organisation-cfe-recto')}}</label>
                    <label class="cursor-pointer bg-gray-200 hover:bg-gray-300 rounded md:w-6/12 h-32 flex items-center justify-center border mb-4">
                        <input type="file" wire:model="cfe_recto" class="absolute opacity-0 -z-1">
                        <div wire:loading wire:target="cfe_recto" class='absolute z-10'>{{trans('apps.create.loading')}}</div>
                        @if ($cfe_recto)
                            <img class="object-cover h-32 w-full p-1 rounded" src="{{ $cfe_recto->temporaryUrl() }}">
                        @endif
                        @error('cfe_recto') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </label>

                    <label class="font-thin">{{trans('apps.create.app-organisation-cfe-verso')}}</label>
                    <label class="cursor-pointer bg-gray-200 hover:bg-gray-300 rounded md:w-6/12 h-32 flex items-center justify-center border mb-4">
                        <input type="file" wire:model="cfe_verso" class="absolute opacity-0 -z-1">
                        <div wire:loading wire:target="cfe_verso" class='absolute z-10'>{{trans('apps.create.loading')}}</div>
                        @if ($cfe_verso)
                            <img class="object-cover h-32 w-full p-1 rounded" src="{{ $cfe_verso->temporaryUrl() }}">
                        @endif
                        @error('cfe_verso') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </label>

                    <button class="bg-pblue rounded text-white p-2 w-full md:w-6/12 mt-4">{{trans('apps.create.app-create-submit')}}</button>
                
                </div>
            </div>

        </form>

    </div>


</div>