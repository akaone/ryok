<div x-cloak x-data="LIVEWIRE_APP_SHOW()" class="flex flex-col px-4 pb-16">

    <div class="font-thin text-md text-blue-600 my-4">@lang('apps.app.show.section')</div>

    <div class="flex w-full px-4 pt-2 mb-4 font-light text-gray-600 border-b sticky top-0 bg-white">
        <div
            x-on:click="changeTab('infos')"
            x-bind:class="{'border-t-8 border-green-600': activeTab == 'infos' }"
            class="cursor-pointer bg-white py-2 border-l border-t-2 border-r flex justify-center w-24 border-t-8 border-green-600">
            @lang('apps.app.show.tab-infos')
        </div>
        <div
            x-on:click="changeTab('members')"
            x-bind:class="{'border-t-8 border-green-600': activeTab == 'members' }"
            class="cursor-pointer bg-white py-2 border-l border-t-2 border-r flex justify-center w-24 border-t-8 border-green-600">
            @lang('apps.app.show.tab-members')
        </div>
        <div
            x-on:click="changeTab('payments')"
            x-bind:class="{'border-t-8 border-green-600': activeTab == 'payments' }"
            class="cursor-pointer bg-white py-2 border-l border-t-2 border-r flex justify-center w-24 border-t-8 border-green-600">
            @lang('apps.app.show.tab-payments')
        </div>
    </div>

    <div x-show="activeTab == 'infos'" class="flex flex-col px-4">
        <table class="my-2 rounded border">
            <tr class="border-b  bg-gray-200 text-black">
                <th class="text-sm py-3 px-2 font-light text-left w-3/12">@lang('apps.app.show.infos-field')</th>
                <th class="text-sm py-3 px-2 font-light text-left w-9/12">@lang('apps.app.show.infos-details')</th>
            </tr>
            <tr class="border-t">
                <td class="py-2 px-2">@lang('apps.app.show.infos-app-name')</td>
                <td class="py-2 px-2">{{ $infos['name'] }}</td>
            </tr>
            <tr class="border-t">
                <td class="py-2 px-2">@lang('apps.app.show.infos-app-icon')</td>
                <td class="py-2 px-2"><img class="border rounded w-24 h-24" src="{{ asset($infos['icon']) }}" alt="app icon"></td>
            </tr>
            <tr class="border-t">
                <td class="py-2 px-2">@lang('apps.app.show.infos-website')</td>
                <td class="py-2 px-2">{{ $infos['website_url'] }}</td>
            </tr>
            <tr class="border-t">
                <td class="py-2 px-2">@lang('apps.app.show.infos-webhook')</td>
                <td class="py-2 px-2">{{ $infos['webhook_url'] }}</td>
            </tr>
            <tr class="border-t">
                <td class="py-2 px-2">@lang('apps.app.show.infos-organization')</td>
                <td class="py-2 px-2">{{ $infos['organization'] }}</td>
            </tr>
            <tr class="border-t">
                <td class="py-2 px-2">@lang('apps.app.show.infos-nif')</td>
                <td class="py-2 px-2">{{ $infos['nif'] }}</td>
            </tr>
            <tr class="border-t">
                <td class="py-2 px-2">@lang('apps.app.show.infos-cfe')</td>
                <td class="py-2 px-2">
                    <div class="space-y-4">
                        <img class="border rounded" src="{{ asset($infos['cfe_recto']) }}" alt="cfe recto">
                        <img class="border rounded" src="{{ asset($infos['cfe_verso']) }}" alt="cfe verso">
                    </div>
                </td>
            </tr>
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