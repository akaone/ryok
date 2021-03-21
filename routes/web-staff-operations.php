<?php

Route::prefix("staff/operations")->name('staff.operations.')->group(function () {
    Route::get("/", \App\Http\Livewire\StaffOperations\StaffOperationsIndex::class)->name('index');

});
