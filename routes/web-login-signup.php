<?php

Route::get("/", "Web\HomeController@index")->name("home.index");

Route::get("/login", "Web\LoginController@index")->name("login");

Route::get("/logout", "Web\LoginController@destroy")->name("login.destroy");

# forgot password
# change password

# /login/password (get) -> set user password form
# Route::get("/login/password", "Web\LoginPasswordController@edit")->name("login.password.edit");
# /login/password/store (post) -> set user password
# Route::post("/login/password/store", "Web\LoginPasswordController@update")->name("login.password.update");

Route::prefix("sign-up")->name('sign-up.')->group(function () {

    # sign-up/create -> new sign up form
    Route::get("", "Web\SignUpController@index")->name("index");

    # when sign-up is done
    Route::get("/done/{userId}", "Web\SignUpController@done")->name('done');

    # sign-up/verify -> verify the email of a signup user
    Route::get("/verify/{emailLink}", "Web\SignUpController@update")->name('verify');

});