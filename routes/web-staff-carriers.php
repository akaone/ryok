<?php


use App\Http\Controllers\Web\StaffCarriersController;

Route::prefix("carriers")->name('carriers.')->group(function () {

    # carriers -> List of supported carriers on the platform
    Route::get("/", [StaffCarriersController::class, "index"])->name("index");

    # carriers/create -> Form to add a new carrier
    Route::get("/create", [StaffCarriersController::class, "create"])->name("create");


    # carriers/store (post) -> Add the new carrier
    # carriers/{carrierId} (get) -> Show carrier details [+ussds]
    # carriers/{carrierId}/edit (put) -> edit a carrier
    # carriers/{carrierId}/state (put) -> give a state to a carrier
    # carriers/{carrierId}/ussd (get) -> list of carrier ussd
    # carriers/{carrierId}/ussd/update (put) -> Change the ussd schema of a carrier

});
