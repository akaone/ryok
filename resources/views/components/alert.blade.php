@if (session()->has('success'))
    <div class="bg-yellow-400 text-yellow-800 p-4 rounded shadow mt-4 font-light">
        {{ session('success') }}
    </div>
@elseif (session()->has('error'))
    <div class="bg-red-400 text-white p-4 rounded shadow mt-4 font-light">
        {{ session('error') }}
    </div>
@endif