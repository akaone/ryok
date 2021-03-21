<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LoginController;

use App\Http\Livewire\Login\LoginIndex;
use App\Http\Livewire\Signup\SignupDone;
use App\Http\Livewire\Signup\SignupIndex;
use App\Http\Livewire\Signup\SignupUpdate;

Route::get("/", [HomeController::class, "index"])->name("home.index");

Route::get("/login", LoginIndex::class)->name("login");

Route::get("/logout", [LoginController::class, "destroy"])->name("login.destroy");

# forgot password
# change password

# /login/password (get) -> set user password form
# Route::get("/login/password", "Web\LoginPasswordController@edit")->name("login.password.edit");
# /login/password/store (post) -> set user password
# Route::post("/login/password/store", "Web\LoginPasswordController@update")->name("login.password.update");

Route::prefix("sign-up")->name('sign-up.')->group(function () {

    # sign-up/create -> new sign up form
    Route::get("", SignupIndex::class)->name("index");

    # when sign-up is done
    Route::get("/done/{userId}", SignupDone::class)->name('done');

    # sign-up/verify -> verify the email of a signup user
    Route::get("/verify/{emailLink}", SignupUpdate::class)->name('verify');

});
