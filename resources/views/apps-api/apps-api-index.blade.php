<div class="flex flex-col px-4 items-start mb-6">
    @section('title', trans('apps.apps-api.index.title'))

    <div class="font-thin text-md text-blue-600 my-4">{{trans('apps.apps-api.index.app-keys-title')}}</div>

    <livewire:components.livewire-apps-key appId="{{$appId}}" />

    <div class="font-thin text-md text-blue-600 my-4">Documentation</div>

    <!-- process to get the qr code and android deeplink -->
    <livewire:components.apps-api-create-payment-documentation />

    <!-- check a payment status -->
    <div class="flex flex-col w-full mb-4">

        <div class="flex items-center border-b py-2 font-medium">
            <x-heroicon-o-chart-pie class="w-6 h-6 text-gray-500 mr-2"/>
            <span>Check payment status</span>
        </div>

    </div>

    <!-- webhook documentation -->
    <div class="flex flex-col w-full mb-4">

        <div class="flex items-center border-b py-2 font-medium">
            <x-heroicon-o-link class="w-6 h-6 text-gray-500 mr-2"/>
            <span>Webhook configuration</span>
        </div>

    </div>

    <!-- process to get activate only some country -->
    <div class="flex flex-col w-full mb-4">

        <div class="flex items-center border-b py-2 font-medium">
            <x-heroicon-o-flag class="w-6 h-6 text-gray-500 mr-2"/>
            <span>Manage countries</span>
        </div>

    </div>

</div>
