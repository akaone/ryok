<?php



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localizationRedirect']
], function () {

    Route::get('operation-qr-code/{id}', "Server\MerchantQrCodeController@show")->name("operation-qr-code");

    Route::group([], base_path("routes/web-login-signup.php"));

    Route::prefix("dashboard")->name('dashboard.')->middleware(['auth'])->group(function () {

        Route::get("/", "Web\StatsController@index")->name("stats.index");

        Route::group([], base_path("routes/web-staff-app.php"));

        Route::group([], base_path("routes/web-staff-carriers.php"));

        Route::group([], base_path("routes/web-member-apps.php"));

        # operations

        # transactions

        # staff
    });

});
