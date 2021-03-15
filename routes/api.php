<?php

use App\Actions\Auth\ApiClientSignUp;
use App\Actions\Auth\ApiClientSignUpSms;
use App\Actions\Auth\ApiLoginClient;
use App\Actions\Operations\ListClientOperations;
use App\Http\Controllers\Api\QrCodeScanController;
use App\Http\Controllers\Server\CarriersSmsController;
use App\Http\Controllers\Server\PaymentRequestController;

# sign up client step 1
Route::post('client/signup', ApiClientSignUp::class)->name('api.client.auth.store');
# sign up client step 2
Route::post('client/pass', ApiClientSignUpSms::class)->name('api.client.auth.pass');
# user/login # connecter un client
Route::post('client/login', ApiLoginClient::class)->name('api.client.auth.login');

# user/password/change # demande de modification mot de passe while connected
# user/password/reset # demande de modification mot de passe not connected
# user/password/confirm # confirmation de mot de passe apres reset mw>?L%dFex

Route::prefix("client")->name('api.client.')->middleware(['client.api.auth'])->group(function() {

    # accounts stats for given month
    Route::get('account/stats', \App\Actions\Account\ApiAccountStats::class)->name('account.stats');

    # historiques de transactions (client)
    Route::get('operations', ListClientOperations::class)->name('operations.list');

    # scan qr code (client)
    Route::post("qr-code", [QrCodeScanController::class, 'index'])->name("qr-code.index");

    # envoie de la reponse ussd (client)
    Route::patch("qr-code", [QrCodeScanController::class, 'update'])->name("qr-code.update");

});


# creer une operation (marchand)
Route::post("payment-request", [PaymentRequestController::class, 'index'])->name('api.payment-request')->middleware('merchant.api.auth');

# etat d'une operation (marchand)

# envoi des sms de transaction au server (watcher app)
Route::post("carriers/sms", [CarriersSmsController::class, 'store'])->name('api.carriers-sms.store');
