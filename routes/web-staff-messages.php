<?php


use App\Http\Livewire\StaffMessages\StaffMessagesIndex;

Route::prefix("staff/messages")->name('staff.messages.')->group(function () {
    Route::get("/", StaffMessagesIndex::class)->name('index');

});
