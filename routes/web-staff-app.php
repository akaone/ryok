<?php

use App\Http\Controllers\Web\StaffAppsPaymentController;

Route::prefix("app")->name('staff.apps.')->group(function () {

    # staff - list all apps
    Route::get("/list", \App\Http\Livewire\Apps\AppsList::class)->name("list");

    # staff - show app details
    Route::get("/{appId}", \App\Http\Livewire\Apps\AppShow::class)->name("show");

    # staff app transaction details
    Route::get("/{appId}/payments/{paymentId}", \App\Http\Livewire\Apps\StaffAppsPaymentsShow::class)->name("payments.show");

});
