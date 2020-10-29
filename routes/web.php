<?php



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localizationRedirect']
], function () {

    Route::group([], base_path("routes/web-login-signup.php"));

    Route::prefix("dashboard")->name('dashboard.')->middleware(['auth'])->group(function () {

        Route::get("/", "Web\StatsController@index")->name("stats.index");

        Route::group([], base_path("routes/web-staff-apps.php"));

        Route::group([], base_path("routes/web-member-apps.php"));


        # carriers (get) List of supported carriers on the platform
        # carriers/create (get) -> Form to add a new carrier 
        # carriers/store (post) -> Add the new carrier
        # carriers/{carrierId} (get) -> Show carrier details [+ussds]
        # carriers/{carrierId}/edit (put) -> edit a carrier
        # carriers/{carrierId}/state (put) -> give a state to a carrier
        # carriers/{carrierId}/ussd (get) -> list of carrier ussd
        # carriers/{carrierId}/ussd/update (put) -> Change the ussd schema of a carrier

        # operations

        # transactions

        # staff
    });

});