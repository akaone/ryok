<?php

use App\Http\Controllers\Web\AppsSettingsController;
use App\Http\Controllers\Web\AppsStateController;
use App\Http\Controllers\Web\AppsUsersController;
use App\Http\Livewire\Apps\AppsCreate;
use App\Http\Livewire\Apps\AppsIndex;
use App\Http\Livewire\AppsApi\AppsApiIndex;
use App\Http\Livewire\AppsOperations\AppsOperationsIndex;

Route::prefix("apps")->name('apps.')->group(function () {

    # apps/create (get) -> create a new app form
    Route::get("/create", AppsCreate::class)->name("create");

    # apps -> list a specific app
    Route::get("/{appId}", AppsIndex::class)->name("index");

    # apps/{appId}/operations -> operations of sells & withdrawal
    Route::get('/{appId}/operations', AppsOperationsIndex::class)->name('operations.index');
    # apps/{appId}/operations/payouts -> payouts & settings

    # apps/{appId}/api -> api key and documentation
    Route::get("/{appId}/api", AppsApiIndex::class)->name("api.index");

    # apps/{appId}/users -> list of app users
    Route::get("/{appId}/users", [AppsUsersController::class, "index"])->name("users.index");

    # apps/{appId}/users/create (get) -> add a user to an app form
    Route::get("/{appId}/users/create", [AppsUsersController::class, "create"])->name("users.create");

    # apps/{appId}/users/{userId}/show -> show a app_users
    Route::get("/{appId}/users/{userId}/show", [AppsUsersController::class, "show"])->name("users.show");

    # apps/{appId}/users/{userId}/edit
    # apps/{appId}/users/{userId}/state


    # apps/{appId}/state -> give a state to an app ['ACTIVATED', 'DEACTIVATED', 'REJECTED']
    Route::patch("/{appId}/state", [AppsStateController::class, "update"])->name("state.update");

    # apps/{appId}/settings
    Route::get("/{appId}/settings", [AppsSettingsController::class, 'index'])->name('settings.index');
    # apps/{appId}/carriers - add allowed caariers
    # apps/{appId}/keys/edit -> edit bundle id | site url | webhook
    # apps/{appId}/countries -> manage enabled countries
    # apps/{appId}/countries/edit -> edit enabled countries
    # apps/{appId}/keys/reset -> reset api key

});
