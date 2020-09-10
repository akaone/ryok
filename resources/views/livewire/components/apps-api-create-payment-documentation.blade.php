<div class="flex flex-col w-full mb-4">
    
    <div class="flex items-center border-b py-2 font-medium">
        <x-heroicon-o-cog class="w-6 h-6 text-gray-500 mr-2"/>
        <span>{{trans('apps.apps-api.index.doc-create-payment-title')}}</span>
    </div>

    <div class="flex flex-col py-2 w-11/12 font-light text-black text-lg">
        <h3 class="underline text-lg font-light text-blue-600">Description</h3>
        <span class="mb-2">
            {{trans('apps.apps-api.index.doc-create-payment-description')}}
        </span>
        <span class="mb-2">
            {{trans('apps.apps-api.index.doc-create-payment-demo-title')}}
        </span>
    </div>

    <div class="flex flex-col my-4">
        <h3 class="underline text-lg font-light text-blue-600">{{trans('apps.apps-api.index.doc-create-payment-params')}}</h3>
        <table>
            <tr class="border text-black">
                <td class="text-sm py-3 px-2 font-light text-left w-4/12 border-r">secret_key</td>
                <td class="text-sm py-3 px-2 font-light text-left w-2/12 border-r">
                    <span class="border px-2 rounded-full">{{trans('apps.apps-api.index.doc-create-payment-params-required')}}</span>
                </td>
                <td class="text-sm py-3 px-2 font-light text-left w-6/12">{{trans('apps.apps-api.index.doc-create-payment-params-secret-description')}}</td>
            </tr>
            <tr class="border text-black">
                <td class="text-sm py-3 px-2 font-light text-left w-4/12 border-r">amount</td>
                <td class="text-sm py-3 px-2 font-light text-left w-2/12 border-r">
                    <span class="border px-2 rounded-full">{{trans('apps.apps-api.index.doc-create-payment-params-required')}}</span>
                </td>
                <td class="text-sm py-3 px-2 font-light text-left w-6/12">{{trans('apps.apps-api.index.doc-create-payment-params-amount-description')}}</td>
            </tr>
            <tr class="border text-black">
                <td class="text-sm py-3 px-2 font-light text-left w-4/12 border-r">currency (XOF USD EUR)</td>
                <td class="text-sm py-3 px-2 font-light text-left w-2/12 border-r">
                    <span class="border px-2 rounded-full">{{trans('apps.apps-api.index.doc-create-payment-params-required')}}</span>
                </td>
                <td class="text-sm py-3 px-2 font-light text-left w-6/12">{{trans('apps.apps-api.index.doc-create-payment-params-currency-description')}}</td>
            </tr>
        </table>
    </div>
    
    <div class="flex flex-col my-4">
        <h3 class="underline text-lg font-light text-blue-600">{{trans('apps.apps-api.index.doc-create-payment-responses')}}</h3>
        <table>
            <tr class="border text-black">
                <td class="text-sm py-3 px-2 font-light text-left w-2/12 border-r">status 200</td>
                <td class="text-sm py-3 px-2 font-light text-left w-4/12 border-r">Everything went well</td>
                <td class="text-sm py-3 px-2 font-light text-left w-6/12">[]</td>
            </tr>
        </table>
    </div>

    <div class="flex flex-col my-4">
        <h3 class="underline text-lg font-light text-blue-600">{{trans('apps.apps-api.index.doc-create-payment-code')}}</h3>
    </div>

</div>