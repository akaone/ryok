<?php


use App\Http\Livewire\StaffMerchantsIndex;

Route::prefix("staff/merchants")->name('staff.merchants.')->group(function () {
    Route::get("/", StaffMerchantsIndex::class)->name('index');

});
