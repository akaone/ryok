<?php


use App\Http\Livewire\StaffUsers\StaffUsersIndex;

Route::prefix("staff/users")->name('staff.users.')->group(function () {
    Route::get("/", StaffUsersIndex::class)->name('index');

});
