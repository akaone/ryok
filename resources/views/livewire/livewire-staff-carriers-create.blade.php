<div class="bg-gray-200 min-h-screen">

    <div class="bg-white border px-8 mx-auto w-full md:w-8/12 m-4 rounded py-6">
        <div class='pb-2'>
            <span class="text-lg text-pblue">Add a new carrier</span>
        </div>


        <div>
            <form class="flex flex-wrap space-y-2 font-light" action="">

                <h3 class="border-b border-blue-400 text-blue-400 pt-4 mb-2 w-full font-normal">Basic information</h3>
                
                <div class="flex flex-col w-9/12">
                    <label for="">Carrier name</label>
                    <input wire:model="carrierName" type="text" class="border rounded h-8 px-2">
                </div>
                
                <div class="flex flex-col w-4/12 mr-4">
                    <label for="">Country</label>
                    <select wire:model="country" class="border rounded h-8 px-2">
                        <option value="">Pick a country</option>
                        <option value="togo">togo</option>
                        <option value="benin">benin</option>
                        <option value="ghana">ghana</option>
                        <option value="ivory-coast">ivory-coast</option>
                    </select>
                </div>
                
                <div class="flex flex-col w-2/12 mr-4">
                    <label for="">Mmc</label>
                    <input wire:model="mmc" type="text" class="border rounded h-8 px-2">
                </div>
                
                <div class="flex flex-col w-2/12">
                    <label for="">Mnc</label>
                    <input wire:model="mnc" type="text" class="border rounded h-8 px-2">
                </div> 
                
                <div class="flex flex-col w-9/12">
                    <label for="">Phone numbers starting with</label>
                    <input wire:model="startWith" type="text" class="border rounded h-8 px-2">
                </div>

                <h3 class="border-b border-blue-400 text-blue-400 pt-4 mb-2 w-full font-normal">Client ussd configuration</h3>

                <div class="flex flex-col w-9/12">
                    <label for="">Client ussd format</label>
                    <input type="text" class="border rounded h-8 px-2">
                </div>

                <div class="flex flex-col w-6/12">
                    <label for="">Client ussd amount regex</label>
                    <input type="text" class="border rounded h-8 px-2">
                </div>
                <div class="flex flex-col w-5/12 ml-4">
                    <label for="">Client ussd transfert id regex</label>
                    <input type="text" class="border rounded h-8 px-2">
                </div>

                <h3 class="border-b border-blue-400 text-blue-400 pt-4 mb-2 w-full font-normal">Merchant ussd configuration</h3>

                <div class="flex flex-col w-9/12">
                    <label for="">Merchant ussd format</label>
                    <input type="text" class="border rounded h-8 px-2">
                </div>

                <div class="flex flex-col w-6/12">
                    <label for="">Merchant ussd amount regex</label>
                    <input type="text" class="border rounded h-8 px-2">
                </div>
                <div class="flex flex-col w-5/12 ml-4">
                    <label for="">Merchant ussd transfert id regex</label>
                    <input type="text" class="border rounded h-8 px-2">
                </div>



                <h3 class="border-b border-blue-400 text-blue-400 pt-4 mb-2 w-full font-normal">Received ussd configuration</h3>

                <div class="flex flex-col w-9/12">
                    <label for="">Received ussd format</label>
                    <input type="text" class="border rounded h-8 px-2">
                </div>

                <div class="flex flex-col w-6/12">
                    <label for="">Received ussd amount regex</label>
                    <input type="text" class="border rounded h-8 px-2">
                </div>
                <div class="flex flex-col w-5/12 ml-4">
                    <label for="">Merchant ussd transfert id regex</label>
                    <input type="text" class="border rounded h-8 px-2">
                </div>



                <div class="flex w-full pt-8 space-x-4">
                    <button class="rounded bg-green-400 shadow text-white py-1 px-6">Enregistrer</button>
                    <button class="rounded bg-yellow-400 shadow text-black py-1 px-6">Tester</button>
                </div>
            
            </form>
        </div>

    </div>


</div>
