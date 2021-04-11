<div x-cloak x-data="LIVEWIRE_APP_SHOW()" class="flex flex-col px-4 pb-16">
    @section('title', trans('apps.app.show.title'))

    <div class="font-thin text-md text-blue-600 mt-4">@lang('apps.app.show.section')</div>

@component('components.alert')@endcomponent

    <!-- start TABS -->
    <div class="flex w-full px-4 pt-2 mb-4 font-light text-gray-600 border-b sticky top-0 bg-white">
        <div
            x-on:click="changeTab('infos')"
            x-bind:class="{'border-b-2 border-green-600': activeTab == 'infos' }"
            class="cursor-pointer bg-white py-2 px-6 flex justify-center">
            @lang('apps.app.show.tab-infos')
        </div>
        <div
            x-on:click="changeTab('members')"
            x-bind:class="{'border-b-2 border-green-600': activeTab == 'members' }"
            class="cursor-pointer bg-white py-2 px-6 flex justify-center">
            @lang('apps.app.show.tab-members')
        </div>
        <div
            x-on:click="changeTab('carriers')"
            x-bind:class="{'border-b-2 border-green-600': activeTab == 'carriers' }"
            class="cursor-pointer bg-white py-2 px-6 flex justify-center">
            @lang('apps.app.show.tab-carriers')
        </div>
        <div
            x-on:click="changeTab('payments')"
            x-bind:class="{'border-b-2 border-green-600': activeTab == 'payments' }"
            class="cursor-pointer bg-white py-2 px-6 flex justify-center">
            @lang('apps.app.show.tab-payments')
        </div>
    </div>
    <!-- end TABS -->

    <!-- APP INFOS -->
    <div x-show="activeTab == 'infos'" class="flex flex-col items-start px-4">
        <div class="border border-green-400 rounded px-4 py-1 text-center">
            <span class="lowercase">{{ $infos->state }}</span>
        </div>
        <table class="my-2 rounded border w-full">
            <tr class="border-b  bg-gray-200 text-black">
                <th class="text-sm py-3 px-2 font-light text-left w-3/12">@lang('apps.app.show.infos-field')</th>
                <th class="text-sm py-3 px-2 font-light text-left w-9/12">@lang('apps.app.show.infos-details')</th>
            </tr>
            <tr class="border-t">
                <td class="py-2 px-2">@lang('apps.app.show.infos-app-name')</td>
                <td class="py-2 px-2">{{ $infos->name }}</td>
            </tr>
            <tr class="border-t">
                <td class="py-2 px-2">@lang('apps.app.show.infos-app-icon')</td>
                <td class="py-2 px-2"><img class="border rounded w-24 h-24" src="{{ asset($infos->icon) }}" alt="app icon"></td>
            </tr>
            <tr class="border-t">
                <td class="py-2 px-2">@lang('apps.app.show.infos-website')</td>
                <td class="py-2 px-2">{{ $infos->website_url }}</td>
            </tr>
            <tr class="border-t">
                <td class="py-2 px-2">@lang('apps.app.show.infos-webhook')</td>
                <td class="py-2 px-2">{{ $infos->webhook_url }}</td>
            </tr>
            <tr class="border-t">
                <td class="py-2 px-2">@lang('apps.app.show.infos-organization')</td>
                <td class="py-2 px-2">{{ $infos->organization }}</td>
            </tr>
            <tr class="border-t">
                <td class="py-2 px-2">@lang('apps.app.show.infos-nif')</td>
                <td class="py-2 px-2">{{ $infos->nif }}</td>
            </tr>
            <tr class="border-t">
                <td class="py-2 px-2">@lang('apps.app.show.infos-cfe')</td>
                <td class="py-2 px-2">
                    <div class="space-y-4">
                        <img class="border rounded" src="{{ asset($infos->cfe_recto) }}" alt="cfe recto">
                        <img class="border rounded" src="{{ asset($infos->cfe_verso) }}" alt="cfe verso">
                    </div>
                </td>
            </tr>
        </table>

        <div class="flex py-4 px-4 space-x-2 bg-gray-100 rounded">
            @switch($infos->state)
                @case('PENDING')
                <button
                    wire:loading.attr="disabled"
                    wire:loading.class="bg-gray-500 cursor-wait"
                    wire:loading.class.remove="bg-blue-600"
                    wire:target="activateApp"
                    wire:click="activateApp"
                    class="shadow rounded py-1 px-6 text-white bg-blue-600">
                    @lang('apps.app.show.infos-activate-btn')
                </button>
                <button
                    wire:loading.attr="disabled"
                    wire:loading.class="bg-gray-500 cursor-wait"
                    wire:loading.class.remove="bg-red-600"
                    wire:target="rejectApp"
                    wire:click="rejectApp"
                    class="shadow rounded py-1 px-6 text-white bg-red-600">
                    @lang('apps.app.show.infos-reject-btn')
                </button>
                @break

                @case('ACTIVATED')
                <button
                    wire:loading.attr="disabled"
                    wire:loading.class="bg-gray-500 cursor-wait"
                    wire:loading.class.remove="bg-yellow-600"
                    wire:target="deactivateApp"
                    wire:click="deactivateApp"
                    class="shadow rounded py-1 px-6 text-white bg-yellow-600">
                    @lang('apps.app.show.infos-deactivate-btn')
                </button>
                @break

                @case('DEACTIVATED')
                <button
                    wire:loading.attr="disabled"
                    wire:loading.class="bg-gray-500 cursor-wait"
                    wire:loading.class.remove="bg-blue-600"
                    wire:target="activateApp"
                    wire:click="activateApp"
                    class="shadow rounded py-1 px-6 text-white bg-blue-600">
                    @lang('apps.app.show.infos-activate-btn')
                </button>
                @break

                @case('REJECTED')
                <button
                    wire:loading.attr="disabled"
                    wire:loading.class="bg-gray-500 cursor-wait"
                    wire:loading.class.remove="bg-blue-600"
                    wire:target="activateApp"
                    wire:click="activateApp"
                    class="shadow rounded py-1 px-6 text-white bg-blue-600">
                    @lang('apps.app.show.infos-activate-btn')
                </button>
                @break

                @case('DELETED')
                <button
                    disabled
                    class="shadow rounded py-1 px-6 text-white bg-gray-600">
                    {{ __("apps.app.show.infos-app-is-deleted") }}
                </button>
                @break

            @endswitch
        </div>
    </div>

    <!-- start App's carrier-->
    <div x-show="activeTab == 'carriers'" class="flex flex-col items-start px-4">
        <div class="flex flex-wrap w-full my-4 border">
            @foreach($appCarriers as $key => $item)
                <div wire:key="{{$key}}" class="w-4/12 border-l">
                    <div class="flex bg-gray-100 items-center px-2 py-1">
                        <input @if(collect($pickedCarriers)->contains($key)) checked @endif type="checkbox" value="{{ $key }}">
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
    <!-- end App's carrier-->

    <!-- APP MEMBERS -->
    <div x-show="activeTab == 'members'" class="flex flex-col px-4">
        <table class="my-2 bg-gray-200 rounded border">
            <tr class="border-b text-black">
                <th class="text-sm py-3 px-2 font-light text-left w-3/12">{{trans('apps.apps-users.index.user-name')}}</th>
                <th class="text-sm py-3 px-2 font-light text-left w-1/12">{{trans('apps.apps-users.index.user-role')}}</th>
                <th class="text-sm py-3 px-2 font-light text-left w-2/12">{{trans('apps.apps-users.index.user-added')}}</th>
                <th class="text-sm py-3 px-2 font-light text-left w-2/12">{{trans('apps.apps-users.index.user-state')}}</th>
                <th class="text-sm py-3 px-2 font-light text-left w-2/12">{{trans('apps.apps-users.index.user-app-state')}}</th>
                <th class="text-sm py-3 px-2 font-light text-left w-2/12">{{trans('apps.apps-users.index.user-action')}}</th>
            </tr>

            @foreach($members as $key => $user)
                <tr class="border-b hover:bg-gray-100 cursor-default bg-white text-gray-600">
                    <td class="py-3 flex items-center px-2 text-sm">{{ $user->name }}</td>
                    <td class="py-3 px-2 text-sm font-medium">{{ $user->role_name }}</td>
                    <td class="py-3 px-2 text-sm">{{ $user->apps_users_created_at }}</td>
                    <td class="py-3 px-2 text-sm">
                        <span class="lowercase border rounded py-1 px-2 lowercase">{{ $user->state }}</span>
                    </td>
                    <td class="py-3 px-2 text-sm">
                        <span class="lowercase border rounded py-1 px-2 lowercase">{{ $user->apps_users_state }}</span>
                    </td>
                    <td class="py-3 px-2 text-sm">
                        <a href="{{ route('dashboard.apps.users.show', ['userId' => $user->app_users_id, 'appId' => $appId ]) }}">
                            <button class="w-full bg-gray-200 text-black px-2 py-1 rounded font-light">
                                {{trans('apps.apps-users.index.user-details')}}
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach()

        </table>
    </div>

    <!-- APP PAYMENTS -->
    <div x-show="activeTab == 'payments'" class="flex flex-col px-4">
        <span class="font-light text-green-600 underline">{{ __('apps.app.show.payments-credit-operation-title') }}</span>
        <table class="my-2 bg-gray-200 rounded border">
            <tr class="border-b text-black">
                <th class="text-sm py-3 px-2 font-light text-left w-3/12">{{ __('apps.app.show.payments-operation-amount') }}</th>
                <th class="text-sm py-3 px-2 font-light text-left w-3/12">{{ __('apps.app.show.payments-operation-created-at') }}</th>
                <th class="text-sm py-3 px-2 font-light text-left w-3/12">{{ __('apps.app.show.payments-operation-state') }}</th>
                <th class="text-sm py-3 px-2 font-light text-left w-3/12">{{ __('apps.app.show.payments-operation-details') }}</th>
            </tr>

            @foreach($creditOperations as $key => $operation)
                <tr class="border-b hover:bg-gray-100 cursor-default bg-white text-gray-600">
                    <td class="py-3 px-2 text-sm">{{ $operation->amount_requested }} {{ $operation->currency_requested }}</td>
                    <td class="py-3 px-2 text-sm">{{ $operation->created_at }}</td>
                    <td class="py-3 px-2 text-sm lowercase">
                        <span class="lowercase border rounded py-1 px-2 lowercase">{{ $operation->state }}</span>
                    </td>
                    <td class="py-3 px-2 text-sm">
                        <a
                            href="{{ route('dashboard.staff.apps.payments.show', ['appId' => $infos->id, 'paymentId' => $operation->id ]) }}"
                            class="w-full bg-gray-200 text-black px-2 py-1 rounded font-light">
                            {{ __('apps.app.show.payments-operation-details') }}
                        </a>
                    </td>
                </tr>
            @endforeach

        </table>

        <span class="font-light text-green-600 underline mt-6">{{ __('apps.app.show.payments-debit-operation-title') }}</span>
        <table class="my-2 bg-gray-200 rounded border">
            <tr class="border-b text-black">
                <th class="text-sm py-3 px-2 font-light text-left w-3/12">{{ __('apps.app.show.payments-operation-amount') }}</th>
                <th class="text-sm py-3 px-2 font-light text-left w-3/12">{{ __('apps.app.show.payments-operation-created-at') }}</th>
                <th class="text-sm py-3 px-2 font-light text-left w-3/12">{{ __('apps.app.show.payments-operation-state') }}</th>
                <th class="text-sm py-3 px-2 font-light text-left w-3/12">{{ __('apps.app.show.payments-operation-details') }}</th>
            </tr>

            @foreach($debitOperations as $key => $operation)
                <tr class="border-b hover:bg-gray-100 cursor-default bg-white text-gray-600">
                    <td class="py-3 px-2 text-sm">{{ $operation->amount_requested }} {{ $operation->currency_requested }}</td>
                    <td class="py-3 px-2 text-sm">{{ $operation->created_at }}</td>
                    <td class="py-3 px-2 text-sm lowercase">
                        <span class="lowercase border rounded py-1 px-2 lowercase">{{ $operation->state }}</span>
                    </td>
                    <td class="py-3 px-2 text-sm">
                        <a
                            href="{{ route('dashboard.staff.apps.payments.show', ['appId' => $infos->id, 'paymentId' => $operation->id ]) }}"
                            class="w-full bg-gray-200 text-black px-2 py-1 rounded font-light">
                            {{ __('apps.app.show.payments-operation-details') }}
                        </a>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>

</div>

<script>
    function LIVEWIRE_APP_SHOW() {
        return {
            activeTab: "infos",
            changeTab(tab) {
                this.activeTab = tab
            },
        }
    }
</script>
