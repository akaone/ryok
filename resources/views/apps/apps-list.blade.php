<div class="flex flex-col px-4">
    @section('title', trans('apps.app.list.title'))

    <div class="font-thin text-md text-blue-600 my-4">@lang('apps.app.list.section')</div>

    <table class="my-2 bg-gray-200 rounded border">
        <tr class="border-b text-black">
            <th class="text-sm py-3 px-2 font-light text-left w-4/12">@lang('apps.app.list.table-app-name')</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">@lang('apps.app.list.table-members')</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">@lang('apps.app.list.table-date')</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">@lang('apps.app.list.table-state')</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">@lang('apps.app.list.table-action')</th>
        </tr>

        @foreach($appsList as $key => $app)
            <tr class="border-b hover:bg-gray-100 cursor-default bg-white text-gray-600">
                <td class="py-3 flex items-center px-2 text-sm">
                    <img class="rounded border w-8 h-8 mr-2 bg-gray-200" src="{{ asset($app->icon) }}" alt="app-icon">
                    {{ $app->name }} ({{ $app->organization }})
                </td>
                <td class="py-3 px-2 text-sm">----------</td>
                <td class="py-3 px-2 text-sm"> {{ $app->created_at }} </td>
                <td class="py-3 px-2 text-sm">
                    <span class="lowercase border rounded py-1 px-2">{{ $app->state }}</span>
                </td>
                <td class="py-3 px-2 text-sm">
                    <a class="block flex justify-center bg-gray-200 text-black px-2 py-1 rounded font-light" href="{{ route('dashboard.staff.apps.show', ['appId' => $app->id ]) }}">
                        @lang('apps.app.list.table-details')
                    </a>
                </td>
            </tr>
        @endforeach
    </table>

</div>
