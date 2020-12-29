<div x-cloak x-data="STAFF_MESSAGES_INDEX()" class="flex flex-col px-4">

    @section('title', trans('messages.staff-messages.index.title'))

    <div class="font-thin text-md text-blue-600 my-4">@lang('messages.staff-messages.index.title')</div>

    <div wire:poll.5s="messages">

        {{-- pending messages --}}
        <span class="font-light text-green-600 underline">@lang("messages.staff-messages.index.pending-messages-title")</span>
        <table x-on:click.away="setMessageId(null)" class="my-2 bg-gray-200 rounded border w-full">
            <tr class="border-b text-black">
                <th class="text-sm py-3 px-2 font-light text-left w-2/12">@lang("messages.staff-messages.index.pending-messages-sender")</th>
                <th class="text-sm py-3 px-2 font-light text-left w-8/12">@lang("messages.staff-messages.index.pending-messages-body")</th>
                <th class="text-sm py-3 px-2 font-light text-left w-2/12">@lang("messages.staff-messages.index.pending-messages-action")</th>
            </tr>

            @foreach($pendingMessages as $key => $message)
                <tr class="border-b hover:bg-gray-100 cursor-default bg-white text-gray-600">
                    <td class="py-3 px-2 text-sm">{{ $message->sender }}</td>
                    <td class="py-3 px-2 text-sm">{{ $message->body }}</td>
                    <td class="py-3 px-2 text-sm">
                        <button x-on:click="setMessageId('{{ $message->id }}')" class="bg-gray-200 rounded px-4" >
                            @lang("messages.staff-messages.index.pending-messages-treat")
                        </button>
                    </td>
                </tr>
                <template x-if="false">
                    <div  class="bg-blue-100">
                        <td class="py-2 pl-2">
                            <div class="flex flex-col items-start">
                                <button
                                    x-on:click="$wire.set('transactionAmount', document.getSelection().toString())"
                                    class="flex focus:outline-none text-sm font-light border rounded">
                                    @lang("messages.staff-messages.index.pending-messages-transaction-amount")
                                </button>
                                <input wire:model="transactionAmount" type="text" class="px-2 border h-8 rounded w-3/4">
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-col items-start">
                                <button
                                    x-on:click="$wire.set('transactionReference', document.getSelection().toString())"
                                    class="flex focus:outline-none text-sm font-light border rounded">
                                    @lang("messages.staff-messages.index.pending-messages-transaction-reference")
                                </button>
                                <div class="flex w-full space-x-2">
                                    <input wire:model="transactionReference" type="text" class="px-2 border h-8 rounded w-6/12">
                                    <button class="bg-blue-600 rounded h-8 w-2/12 text-white shadow">
                                        @lang("messages.staff-messages.index.pending-messages-save")
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td></td>
                    </div>
                </template>
            @endforeach

        </table>

        {{-- treated messages --}}
        <div class="mt-6"></div>
        <span class="font-light text-green-600 underline">@lang("messages.staff-messages.index.treated-messages-title")</span>
        <table class="my-2 bg-gray-200 rounded border w-full">
            <tr class="border-b text-black">
                <th class="text-sm py-3 px-2 font-light text-left w-2/12">@lang("messages.staff-messages.index.pending-messages-sender")</th>
                <th class="text-sm py-3 px-2 font-light text-left w-8/12">@lang("messages.staff-messages.index.pending-messages-body")</th>
                <th class="text-sm py-3 px-2 font-light text-left w-2/12">@lang("messages.staff-messages.index.pending-messages-action")</th>
            </tr>

            @foreach($treatedMessages as $key => $message)
                <tr class="border-b hover:bg-gray-100 cursor-default bg-white text-gray-600">
                    <td class="py-3 px-2 text-sm">{{ $message->sender }}</td>
                    <td class="py-3 px-2 text-sm">{{ $message->body }}</td>
                    <td class="py-3 px-2 text-sm">---</td>
                </tr>
            @endforeach
        </table>
    </div>


</div>


<script>
    function STAFF_MESSAGES_INDEX() {
        return {
            selectedMessageId: null,
            setMessageId(id) {
                if (this.selectedMessageId == id) {
                    this.selectedMessageId = null;
                } else {
                    this.selectedMessageId = id;
                }
            },
        }
    }
</script>
