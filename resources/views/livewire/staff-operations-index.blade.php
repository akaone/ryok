<div class="flex flex-col px-4">

    @section('title', trans('staff.operations.index.title'))

    <div class="font-thin text-md text-blue-600 my-4">@lang('staff.operations.index.title')</div>

    <div ddwire:poll="operations">
        <table x-on:click.away="setMessageId(null)" class="my-2 bg-gray-200 rounded border w-full">
            <tr class="border-b text-black">
                <th class="text-sm py-3 px-2 font-light text-left w-3/12">Debitor</th>
                <th class="text-sm py-3 px-2 font-light text-left w-3/12">Creditor</th>
                <th class="text-sm py-3 px-2 font-light text-left w-2/12">Amount</th>
                <th class="text-sm py-3 px-2 font-light text-left w-2/12">State</th>
                <th class="text-sm py-3 px-2 font-light text-left w-1/12">Action</th>
            </tr>

            @foreach($operations as $key => $operation)
                <tr class="border-b hover:bg-gray-100 cursor-default bg-white text-gray-600">
                    <td class="py-3 px-2 text-sm font-medium underline">{{ $operation->from }}</td>
                    <td class="py-3 px-2 text-sm font-medium underline">{{ $operation->account_id }}</td>
                    <td class="py-3 px-2 text-sm">
                        {{ $operation->amount_requested }} {{ $operation->currency_requested }}
                    </td>
                    <td class="py-3 px-2 text-sm">
                        <span class="lowercase rounded border px-1">{{ $operation->state }}</span>
                    </td>
                    <td class="py-3 px-2 text-sm">----</td>
                </tr>
            @endforeach
        </table>

        {{ $operations->links() }}
    </div>

</div>
