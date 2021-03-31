<div class="flex flex-col px-4 items-start mb-6">
    @section('title', trans('apps.apps-api.index.title'))

    <div class="font-thin text-md text-blue-600 my-4">{{trans('apps.apps-api.index.app-keys-title')}}</div>

    <x-alert class="mb-4" />

    <livewire:components.livewire-apps-key appId="{{$appId}}" />

    <div class="font-thin text-md text-blue-600 mt-4">{{ __('apps.apps-api.index.app-webhook-title') }}</div>
    <form wire:submit.prevent="updateAppWebhook" class="w-7/12" action="#">
        <label class="font-light" for="">
            {{ __('apps.apps-api.index.app-webhook-description') }}
            <span class="text-red-600 underline">{{ __('apps.apps-api.index.app-webhook-https') }}</span>
        </label>
        <div class="flex">
            <div class="rounded-l text-green-600 bg-gray-200 font-medium px-2 py-1">POST</div>
            <input wire:model="webhookUrl" placeholder="{{ $appInfos->webhook_url }}" type="text" class="border flex-grow px-2">
        </div>
        @error('webhookUrl') <span class="text-red-600 text-sm pb-2">{{ $message }}</span> @enderror
        <x-user-can acl="app-keys-reset" id="{{ $appId }}">
            <button
                type="submit"
                class="flex items-center justify-center px-4 h-8 shadow hover:bg-blue-700 bg-blue-500 rounded text-white font-light my-2">
                {{ __('apps.apps-api.index.app-webhook-update-button') }}
            </button>
        </x-user-can>
    </form>


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
