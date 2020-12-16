<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\SignUpController;

Route::get("/", [HomeController::class, "index"])->name("home.index");

Route::get("/login", [LoginController::class, "index"])->name("login");

Route::get("/logout", [LoginController::class, "destroy"])->name("login.destroy");

# forgot password
# change password

# /login/password (get) -> set user password form
# Route::get("/login/password", "Web\LoginPasswordController@edit")->name("login.password.edit");
# /login/password/store (post) -> set user password
# Route::post("/login/password/store", "Web\LoginPasswordController@update")->name("login.password.update");

Route::prefix("sign-up")->name('sign-up.')->group(function () {

    # sign-up/create -> new sign up form
    Route::get("", [SignUpController::class, "index"])->name("index");

    # when sign-up is done
    Route::get("/done/{userId}", [SignUpController::class, "done"])->name('done');

    # sign-up/verify -> verify the email of a signup user
    Route::get("/verify/{emailLink}", [SignUpController::class, "update"])->name('verify');

});
