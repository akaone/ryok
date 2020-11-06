<div class="bg-gray-200 min-h-screen">

    <div class="bg-white border px-8 mx-auto w-full md:w-8/12 m-4 rounded py-6">
        <div class='pb-2'>
            <span class="text-lg text-pblue">Add a new carrier</span>
        </div>


        <div>
            <form wire:submit.prevent="createCarrier" class="flex flex-wrap space-y-2 font-light" action="">

                <h3 class="border-b border-blue-400 text-blue-400 pt-4 mb-2 w-full font-normal">Basic information</h3>
                
                <div class="flex flex-col w-9/12">
                    <label for="">Carrier name</label>
                    <input wire:model="carrierName" type="text" class="border rounded h-8 px-2">
                    @error('carrierName') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div class="flex flex-col w-4/12 mr-4">
                    <label for="">Country</label>
                    <select wire:model="country" class="border rounded h-8 px-2">
                        <option value="">Pick a country</option>
                        @foreach($countryList as $key => $value)
                            <option value="{{ $value->code }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                    @error('country') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div class="flex flex-col w-2/12 mr-4">
                    <label for="">Mmc</label>
                    <input wire:model="mmc" type="text" class="border rounded h-8 px-2">
                    @error('mmc') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div class="flex flex-col w-2/12">
                    <label for="">Mnc</label>
                    <input wire:model="mnc" type="text" class="border rounded h-8 px-2">
                    @error('mnc') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div> 
                
                <div class="flex flex-col w-9/12">
                    <label for="">Phone numbers starting with (separated with comma)</label>
                    <input wire:model="startWith" type="text" class="border rounded h-8 px-2">
                    @error('startWith') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <h3 class="border-b border-blue-400 text-blue-400 pt-4 mb-2 w-full font-normal">Client ussd configuration</h3>

                <div class="flex flex-col w-9/12">
                    <label for="">Client ussd format</label>
                    <input wire:model="clientUssdFormat" type="text" class="border rounded h-8 px-2">
                    @error('clientUssdFormat') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-col w-6/12">
                    <label for="">Client ussd amount regex</label>
                    <input wire:model="clientUssdAmountRegex" type="text" class="border rounded h-8 px-2">
                    @error('clientUssdAmountRegex') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex flex-col w-5/12 ml-4">
                    <label for="">Client ussd transfert id regex</label>
                    <input wire:model="clientUssdTransfertIdRegex" type="text" class="border rounded h-8 px-2">
                    @error('clientUssdTransfertIdRegex') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <h3 class="border-b border-blue-400 text-blue-400 pt-4 mb-2 w-full font-normal">Merchant ussd configuration</h3>

                <div class="flex flex-col w-9/12">
                    <label for="">Merchant ussd format</label>
                    <input wire:model="merchantUssdFormat" type="text" class="border rounded h-8 px-2">
                    @error('merchantUssdFormat') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-col w-6/12">
                    <label for="">Merchant ussd amount regex</label>
                    <input wire:model="merchantUssdAmountRegex" type="text" class="border rounded h-8 px-2">
                    @error('merchantUssdAmountRegex') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex flex-col w-5/12 ml-4">
                    <label for="">Merchant ussd transfert id regex</label>
                    <input wire:model="merchantUssdTransfertIdRegex" type="text" class="border rounded h-8 px-2">
                    @error('merchantUssdTransfertIdRegex') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>



                <h3 class="border-b border-blue-400 text-blue-400 pt-4 mb-2 w-full font-normal">Received ussd configuration</h3>

                <div class="flex flex-col w-6/12">
                    <label for="">Received sms amount regex</label>
                    <input wire:model="receivedSmsAmountRegex" type="text" class="border rounded h-8 px-2">
                    @error('receivedSmsAmountRegex') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex flex-col w-5/12 ml-4">
                    <label for="">Received sms transfert id regex</label>
                    <input wire:model="receivedSmsTransfertIdRegex" type="text" class="border rounded h-8 px-2">
                    @error('receivedSmsTransfertIdRegex') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>



                <div class="flex w-full pt-8 space-x-4">
                    <button
                        wire:loading.attr="disabled"
                        wire:loading.class="bg-gray-500 cursor-wait"
                        wire:loading.class.remove="bg-green-400"
                        wire:target="createCarrier"
                        class="flex items-center justify-center rounded bg-green-400 shadow text-white py-1 px-6">
                        <x-icon-spinner wire:loading wire:target="createCarrier" class="animate-spin w-4 h-4 mr-3 text-white" />
                        <span>Enregistrer</span>
                    </button>
                </div>
            
            </form>
        </div>

    </div>


</div>
