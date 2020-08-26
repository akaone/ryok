<div class="bg-gray-200">

    <div class="bg-white border px-8 mx-auto w-full md:w-8/12 m-4 rounded">
        <div class='pt-6 pb-2'>
            <span class="text-lg text-pblue">Nouvelle application</span>
        </div>

        <form wire:submit.prevent="save" class="my-6">

            <h3 class="border-b mt-4 mb-2">Application Informations</h3>
            <div class="flex flex-col md:flex-row">
                <label class="cursor-pointer w-24 h-24 bg-gray-200 hover:bg-gray-300 rounded">
                    <input type="file" wire:model="appIcon" class="absolute opacity-0 -z-1">
                    <div wire:loading wire:target="appIcon" class='absolute z-10'>Chargement...</div>
                    @if ($appIcon)
                        <img class="object-cover h-32 w-full p-1 rounded" src="{{ $appIcon->temporaryUrl() }}">
                    @endif
                    @error('appIcon') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </label>

                <div class="md:ml-6 flex-1">
                
                    <div class="flex flex-col mb-4 md:w-8/12">
                        <label class="font-thin">Application name:</label>
                        <span class="font-thin text-gray-600 text-sm mt-1 pr-1">
                            This the name of your application it will be shown to user. Make sure that you type it correctly.
                        </span>
                        <input wire:model="appName" type="text" class="border rounded h-8 px-2" >
                        @error('appName') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                
                    <div class="flex flex-col mb-4 md:w-8/12">
                        <label class="font-thin">Website url:</label>
                        <span class="font-thin text-gray-600 text-sm mt-1 pr-1">
                            This is your website url it will be provided to the user to check your identity.
                        </span>
                        <input wire:model="website" type="text" class="border rounded h-8 px-2" >
                        @error('website') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="flex flex-col mb-4 md:w-8/12">
                        <label class="font-thin">Webhook url:</label>
                        <span class="font-thin text-gray-600 text-sm mt-1 pr-1">
                            This the webhook to witch we will send the result of your paiement requests.
                        </span>
                        <input wire:model="webhookUrl" type="text" class="border rounded h-8 px-2" >
                        @error('webhookUrl') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                
                </div>
            </div>

            <h3 class="border-b mt-4 mb-2">Legal Documents</h3>

            <div class='flex'>
                <div class="w-24 h-24 bg-white rounded hidden md:block"></div>

                <div class="md:ml-6 flex-1">
                
                    <div class="flex flex-col mb-4 md:w-8/12">
                        <label class="font-thin">Organisation name:</label>
                        <span class="font-thin text-gray-600 text-sm mt-1 pr-1">
                            This is the organisation name
                        </span>
                        <input wire:model="organization" type="text" class="border rounded h-8 px-2" >
                        @error('organization') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                
                    <div class="flex flex-col mb-4 md:w-8/12">
                        <label class="font-thin">Organisation NIF:</label>
                        <span class="font-thin text-gray-600 text-sm mt-1 pr-1">
                            This is the NIF of your organisation. Make sure that you type it correctly.
                        </span>
                        <input wire:model="nif" type="text" class="border rounded h-8 px-2" >
                        @error('nif') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>


                    <label class="font-thin">Photo CFE recto:</label>
                    <label class="cursor-pointer bg-gray-200 hover:bg-gray-300 rounded md:w-6/12 h-32 flex items-center justify-center border mb-4">
                        <input type="file" wire:model="cfe_recto" class="absolute opacity-0 -z-1">
                        <div wire:loading wire:target="cfe_recto" class='absolute z-10'>Chargement...</div>
                        @if ($cfe_recto)
                            <img class="object-cover h-32 w-full p-1 rounded" src="{{ $cfe_recto->temporaryUrl() }}">
                        @endif
                        @error('cfe_recto') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </label>

                    <label class="font-thin">Photo CFE verso:</label>
                    <label class="cursor-pointer bg-gray-200 hover:bg-gray-300 rounded md:w-6/12 h-32 flex items-center justify-center border mb-4">
                        <input type="file" wire:model="cfe_verso" class="absolute opacity-0 -z-1">
                        <div wire:loading wire:target="cfe_verso" class='absolute z-10'>Chargement...</div>
                        @if ($cfe_verso)
                            <img class="object-cover h-32 w-full p-1 rounded" src="{{ $cfe_verso->temporaryUrl() }}">
                        @endif
                        @error('cfe_verso') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </label>

                    <button class="bg-pblue rounded text-white p-2 w-full md:w-6/12 mt-4">Creer l'application</button>
                
                </div>
            </div>

        </form>

    </div>


</div>