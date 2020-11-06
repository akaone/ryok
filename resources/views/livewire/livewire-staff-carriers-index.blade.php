<div class="flex flex-col px-4">

    <div class="font-thin text-md text-blue-600 my-4">@lang('carriers.staff-carriers-index.title')</div>

    @component('components.alert')@endcomponent

    <div class="mb-1 flex justify-between">
        @can('carriers-create')
            <a href="{{ route('dashboard.carriers.create') }}">
                <div class="flex items-center justify-center px-4 h-8 shadow bg-blue-500 rounded text-white font-light">
                    <span>@lang('carriers.staff-carriers-index.add-new-carrier')</span>
                </div>
            </a>
        @endcan
    </div>

    <table class="my-2 bg-gray-200 rounded border">
        <tr class="border-b text-black">
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">@lang('carriers.staff-carriers-index.table-country')</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">@lang('carriers.staff-carriers-index.table-name')</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">@lang('carriers.staff-carriers-index.table-ibm')</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">@lang('carriers.staff-carriers-index.table-added_at')</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">@lang('carriers.staff-carriers-index.table-state')</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">@lang('carriers.staff-carriers-index.table-action')</th>
        </tr>

        @foreach($carriers as $key => $carrier)
            <tr class="border-b hover:bg-gray-100 cursor-default bg-white text-gray-600">
                <td class="py-3 px-2 text-sm">{{ $carrier->country }}</td>
                <td class="py-3 px-2 text-sm">{{ $carrier->name }}</td>
                <td class="py-3 px-2 text-sm">{{ $carrier->ibm }}</td>
                <td class="py-3 px-2 text-sm">{{ $carrier->created_at }}</td>
                <td class="py-3 px-2 text-sm lowercase">{{ $carrier->state }}</td>
                <td class="py-3 px-2 text-sm">
                    <a href="#">
                        <button class="w-full bg-gray-200 text-black px-2 py-1 rounded font-light">
                        @lang('carriers.staff-carriers-index.table-details')
                        </button>
                    </a>
                </td>
            </tr>
        @endforeach
    
    </table>


</div>
