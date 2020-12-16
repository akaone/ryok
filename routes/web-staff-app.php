<?php


use App\Http\Controllers\Web\AppsController;
use App\Http\Controllers\Web\StaffAppsPaymentController;

Route::prefix("app")->name('staff.apps.')->group(function () {

    # staff - list all apps
    Route::get("/list", [AppsController::class, "list"])->name("list");

    # staff - show app details
    Route::get("/{appId}", [AppsController::class, "show"])->name("show");

    # staff app transaction details
    Route::get("/{appId}/payments/{paymentId}", [StaffAppsPaymentController::class, 'show'])->name("payments.show");

});
