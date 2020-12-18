<?php


use App\Http\Livewire\StaffUsersIndex;

Route::prefix("staff/users")->name('staff.users.')->group(function () {
    Route::get("/", StaffUsersIndex::class)->name('index');

});
