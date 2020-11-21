<?php

use App\Http\Controllers\Api\ClientAuthController;
use App\Http\Controllers\Server\PaymentRequestController;
use Illuminate\Http\Request;

# sign up client step 1
Route::post('client/signup', [ClientAuthController::class, 'store'])->name('api.client.auth.store');
# sign up client step 2
Route::post('client/pass', [ClientAuthController::class, 'pass'])->name('api.client.auth.pass');

# user/password/change # demande de modification mot de passe while connected
# user/password/reset # demande de modification mot de passe not connected
# user/password/confirm # confirmation de mot de passe apres reset
# user/login # connecter un client

# historiques de transactions
# details d'une transactions

# liste des numeros utilises par ce compte


# creer une operation (marchand)
Route::post("payment-request", [PaymentRequestController::class, 'index'])->name('api.payment-request')->middleware('merchant.api.auth');

# etat d'une operation (marchand)
# scanner une operation (client)
# payer une operation (client)
