<?php


use App\Http\Livewire\StaffClientsIndex;

Route::prefix("staff/clients")->name('staff.clients.')->group(function () {
    Route::get("/", StaffClientsIndex::class)->name('index');

});
