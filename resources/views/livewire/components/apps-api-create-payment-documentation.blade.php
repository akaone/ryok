<div class="flex flex-col w-full mb-4">

    <div class="flex items-center border-b py-2 font-medium sticky top-0 bg-white">
        <x-heroicon-o-cog class="w-6 h-6 text-gray-500 mr-2"/>
        <span>{{__('apps.apps-api.index.doc-create-payment-title')}}</span>
    </div>

    <div class="flex flex-col py-2 w-11/12 font-light text-black text-lg">
        <h3 class="underline text-lg font-light text-blue-600">Description</h3>
        <span class="mb-2">
            {{__('apps.apps-api.index.doc-create-payment-description')}}
        </span>
        <span class="mb-2">
            {{__('apps.apps-api.index.doc-create-payment-demo-title')}}
        </span>
    </div>

    <div class="flex flex-col py-2 w-11/12 font-light text-black text-lg items-start">
        <h3 class="underline text-lg font-light text-blue-600">
            {{ __('apps.apps-api.index.doc-create-payment-request-url') }}
        </h3>
        <span class="mb-2 rounded-md bg-gray-100 text-black py-1 pl-2 pr-4 font-medium">
            <span class="rounded-md border bg-red-400 text-sm px-2 mr-1 text-white select-none">POST</span>
            <span class="select-all">{{ route('api.payment-request.index') }}</span>
        </span>
    </div>

    <div class="flex flex-col mb-4">
        <h3 class="underline text-lg font-light text-blue-600">{{__('apps.apps-api.index.doc-create-payment-params')}}</h3>
        <table>
            <tr class="border text-black">
                <td class="text-sm py-3 px-2 font-light text-left w-3/12 border-r">apikey</td>
                <td class="text-sm py-3 px-2 font-light text-left w-3/12 border-r">
                    <div class="flex gap-1">
                        <span class="border border-red-400 px-2 rounded-full text-red-400 font-medium">
                            {{__('apps.apps-api.index.doc-create-payment-params-required')}}
                        </span>
                            <span class="border border-red-400 px-2 rounded-full text-red-400 font-medium">
                            in header
                        </span>
                    </div>
                </td>
                <td class="text-sm py-3 px-2 font-light text-left w-6/12">{{__('apps.apps-api.index.doc-create-payment-params-secret-description')}}</td>
            </tr>
            <tr class="border text-black">
                <td class="text-sm py-3 px-2 font-light text-left w-3/12 border-r">amount</td>
                <td class="text-sm py-3 px-2 font-light text-left w-3/12 border-r">
                    <span class="border border-red-400 px-2 rounded-full text-red-400 font-medium">
                        {{__('apps.apps-api.index.doc-create-payment-params-required')}}
                    </span>
                </td>
                <td class="text-sm py-3 px-2 font-light text-left w-6/12">{{__('apps.apps-api.index.doc-create-payment-params-amount-description')}}</td>
            </tr>
            <tr class="border text-black">
                <td class="text-sm py-3 px-2 font-light text-left w-3/12 border-r">currency (XOF USD EUR)</td>
                <td class="text-sm py-3 px-2 font-light text-left w-3/12 border-r">
                    <span class="border border-red-400 px-2 rounded-full text-red-400 font-medium">
                        {{__('apps.apps-api.index.doc-create-payment-params-required')}}
                    </span>
                </td>
                <td class="text-sm py-3 px-2 font-light text-left w-6/12">{{__('apps.apps-api.index.doc-create-payment-params-currency-description')}}</td>
            </tr>
        </table>
    </div>

    <div class="flex flex-col my-4">
        <h3 class="underline text-lg font-light text-blue-600">{{__('apps.apps-api.index.doc-create-payment-responses')}}</h3>
        <table class="select-none">
            <!-- start status 200 -->
            <tr class="border text-black">
                <td class="text-sm py-3 px-2 font-light text-left w-3/12 border-r">
                    {{__('apps.apps-api.index.doc-api-status', ['number' => 200])}}
                </td>
                <td class="text-sm py-3 px-2 font-light text-left w-3/12 border-r">
                    {{__('apps.apps-api.index.doc-api-create-payment-success')}}
                </td>
                <td class="text-sm font-light text-left w-6/12">
                    <div class="text-xs p-2">
                        <pre>
                        <span>[</span>
                        <span>    'success' => true,</span>
                        <span>    'errorCode' => '',</span>
                        <span>    'data' => [</span>
                        <span>        'id' => {{__('apps.apps-api.index.doc-api-payment-id')}},</span>
                        <span>        'url' => {{__('apps.apps-api.index.doc-api-payment-url')}},</span>
                        <span>        'live' => {{__('apps.apps-api.index.doc-api-payment-live')}},</span>
                        <span>    ]</span>
                        <span>]</span>
                    </pre>
                    </div>
                </td>
            </tr>
            <!-- end status 200 -->

            <!-- start status 400 -->
            <tr class="border text-black">
                <td class="text-sm py-3 px-2 font-light text-left w-3/12 border-r">
                    {{ __('apps.apps-api.index.doc-api-status', ['number' => 400]) }}
                </td>
                <td class="text-sm py-3 px-2 font-light text-left w-3/12 border-r">
                    {{ __('apps.apps-api.index.doc-api-app-not-activated') }}
                </td>
                <td class="text-sm py-3 px-2 font-light text-left w-6/12">
                    <div class="text-xs p-2">
                        <pre>
                            <span>[</span>
                            <span>    'success' => false,</span>
                            <span>    'errorCode' => {{ \App\Responses\ApiErrorCode::MERCHANT_APP_IS_NOT_ACTIVATED }},</span>
                            <span>]</span>
                        </pre>
                    </div>
                </td>
            </tr>
            <!-- end status 400 -->
        </table>
    </div>

</div>
