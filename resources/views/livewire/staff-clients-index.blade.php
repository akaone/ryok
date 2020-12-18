<div class="flex flex-col px-4">

    @section('title', trans('clients.staff-clients.index.title'))

    <div class="font-thin text-md text-blue-600 my-4">{{ __('clients.staff-clients.index.title') }}</div>

    <table class="my-2 bg-gray-200 rounded border w-full">
        <tr class="border-b text-black">
            <th class="text-sm py-3 px-2 font-light text-left w-3/12">Phone number</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">Created at</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">State</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">Details</th>
        </tr>

        @foreach($clients as $key => $client)
            <tr class="border-b hover:bg-gray-100 cursor-default bg-white text-gray-600">
                <td class="py-3 px-2 text-sm">{{ $client->country_code }} {{ $client->phone_number }}</td>
                <td class="py-3 px-2 text-sm">{{ $client->created_at }}</td>
                <td class="py-3 px-2 text-sm">
                    <span class="lowercase rounded border px-1">{{ $client->state }}</span>
                </td>
                <td class="py-3 px-2 text-sm">
                    <a class="block flex justify-center bg-gray-200 text-black px-2 py-1 rounded font-light" href="#">
                        Details
                    </a>
                </td>
            </tr>
        @endforeach

    </table>

    {{ $clients->links() }}


</div>
