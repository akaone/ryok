<?php


use App\Http\Livewire\StaffOperationsIndex;

Route::prefix("staff/operations")->name('staff.operations.')->group(function () {
    Route::get("/", StaffOperationsIndex::class)->name('index');

});
