<?php


use App\Http\Controllers\Server\MerchantQrCodeController;
use App\Http\Controllers\Web\StatsController;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localizationRedirect']
], function () {

    Route::get('/mailable', function () {
        $user = App\Models\User::where('email', '=', 'desouzakevinm@gmail.com')->first();
        \Illuminate\Support\Facades\Mail::to($user->email)
        ->send(new App\Mail\SignupConfirm($user));

        return new App\Mail\SignupConfirm($user);
    });

    Route::get('links/operation-qr-code/{id}', [MerchantQrCodeController::class, "show"])->name("operation-qr-code");

    Route::group([], base_path("routes/web-login-signup.php"));

    Route::prefix("dashboard")->name('dashboard.')->middleware(['auth'])->group(function () {

        Route::get("/", [StatsController::class, "index"])->name("stats.index");

        Route::group([], base_path("routes/web-staff-app.php"));

        Route::group([], base_path("routes/web-staff-carriers.php"));

        Route::group([], base_path("routes/web-member-apps.php"));

        Route::group([], base_path("routes/web-staff-operations.php"));

        Route::group([], base_path("routes/web-staff-messages.php"));

        Route::group([], base_path("routes/web-staff-clients.php"));

        Route::group([], base_path("routes/web-staff-users.php"));

        Route::group([], base_path("routes/web-staff-merchants.php"));

    });

});
