<?php



Route::prefix("staff/clients")->name('staff.clients.')->group(function () {
    Route::get("/", \App\Http\Livewire\StaffClients\StaffClientsIndex::class)->name('index');

});
