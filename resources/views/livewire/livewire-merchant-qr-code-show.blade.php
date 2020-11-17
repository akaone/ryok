<div class="min-h-screen bg-gray-ef flex items-center justify-center">

    <div
        id="container"
        class="flex flex-col bg-white rounded-lg px-6 py-6 items-center"
        style="width: 360px;">


        <div class="h-20 w-20 rounded-full border bg-white">
            <img class="h-20 w-20 rounded-full" src="{{ $operation->icon ? asset($operation->icon) : $appImage }}" alt="app image">
        </div>
        <div class="flex flex-col items-center my-2">
            <span class="text-xl font-light">{{ $operation->name }}</span>
            <span class="text-3xl font-light -mt-2">
                {{ $operation->amount_requested }}
                <span class="lowercase">{{ $operation->curerncy_requested }}</span>
            </span>
        </div>

        <div class="flex items-center justify-center bg-bacl border-black border-4 mb-2 rounded " style="height: 200px; width: 200px;">
            {!! QrCode::size(198)->generate($operation->deep_link_url); !!}
        </div>
        <span class="text-center text-sm " style="width: 200px;">
            Veuillez scanner le Qr code et proceder au paiement.
        </span>

        <span class="text-sm text-gray-600 font-thin underline">Powered by Ryok.</span>

    </div>

</div>
