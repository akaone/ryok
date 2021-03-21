<div class="flex flex-col px-4">

    @section('title', __('merchants.staff-merchants.index.title'))

    <div class="font-thin text-md text-blue-600 my-4">{{ __('merchants.staff-merchants.index.title') }}</div>

    <table class="my-2 bg-gray-200 rounded border w-full">
        <tr class="border-b text-black">
            <th class="text-sm py-3 px-2 font-light text-left w-3/12">Name</th>
            <th class="text-sm py-3 px-2 font-light text-left w-3/12">Email</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">Created at</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">State</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">Details</th>
        </tr>

        @foreach($merchants as $key => $merchant)
            <tr class="border-b hover:bg-gray-100 cursor-default bg-white text-gray-600">
                <td class="py-3 px-2 text-sm">{{ $merchant->name }}</td>
                <td class="py-3 px-2 text-sm">{{ $merchant->email }}</td>
                <td class="py-3 px-2 text-sm">{{ $merchant->created_at }}</td>
                <td class="py-3 px-2 text-sm">
                    <span class="lowercase rounded border px-1">{{ $merchant->state }}</span>
                </td>
                <td class="py-3 px-2 text-sm">
                    <a class="block flex justify-center bg-gray-200 text-black px-2 py-1 rounded font-light" href="#">
                        Details
                    </a>
                </td>
            </tr>
        @endforeach
    </table>

    {{ $merchants->links() }}

</div>
