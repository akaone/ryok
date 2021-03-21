<?php

Route::prefix("staff/merchants")->name('staff.merchants.')->group(function () {
    Route::get("/",\App\Http\Livewire\StaffMerchants\StaffMerchantsIndex::class)->name('index');

});
