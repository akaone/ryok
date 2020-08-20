<div class="px-8">
    <div class='.border-b .border-gray-200 pt-6 pb-2'>
        <span class="text-lg">Nouvelle application</span>
    </div>

    <form action="" class="my-6">

        <h3 class="border-b mt-4 mb-2">Application Informations</h3>
        <div class='flex'>
            <div class="w-24 h-24 bg-gray-200 rounded"></div>

            <div class="ml-6 flex-1">
            
                <div class="flex flex-col mb-4 w-6/12">
                    <label class="font-thin">Application name:</label>
                    <span class="font-thin text-gray-600 text-sm mt-1 pr-1">
                        This the name of your application it will be shown to user. Make sure that you type it correctly.
                    </span>
                    <input type="text" class="border rounded h-8 px-2" >
                </div>
            
                <div class="flex flex-col mb-4 w-6/12">
                    <label class="font-thin">Website url:</label>
                    <span class="font-thin text-gray-600 text-sm mt-1 pr-1">
                        This is your website url it will be provided to the user to check your identity.
                    </span>
                    <input type="text" class="border rounded h-8 px-2" >
                </div>
                
                <div class="flex flex-col mb-4 w-6/12">
                    <label class="font-thin">Webhook url:</label>
                    <span class="font-thin text-gray-600 text-sm mt-1 pr-1">
                        This the webhook to witch we will send the result of your paiement requests.
                    </span>
                    <input type="text" class="border rounded h-8 px-2" >
                </div>
            
            </div>
        </div>

        <h3 class="border-b mt-4 mb-2">Legal Documents</h3>

        <div class='flex'>
            <div class="w-24 h-24 bg-white rounded"></div>

            <div class="ml-6 flex-1">
            
                <div class="flex flex-col mb-4 w-6/12">
                    <label class="font-thin">Organisation name:</label>
                    <span class="font-thin text-gray-600 text-sm mt-1 pr-1">
                        This is the organisation name
                    </span>
                    <input type="text" class="border rounded h-8 px-2" >
                </div>
            
                <div class="flex flex-col mb-4 w-6/12">
                    <label class="font-thin">Organisation NIF:</label>
                    <span class="font-thin text-gray-600 text-sm mt-1 pr-1">
                        This is the NIF of your organisation. Make sure that you type it correctly.
                    </span>
                    <input type="text" class="border rounded h-8 px-2" >
                </div>
            
            </div>
        </div>
    </form>

</div>
