<?php

Route::get("/", "Web\HomeController@index")->name("home.index");

Route::get("/login", "Web\LoginController@index")->name("login");
# Route::post("/logout", "Web\LoginController@destroy")->name("login.destroy");
# forgot password
# change password

# /login/password (get) -> set user password form
# Route::get("/login/password", "Web\LoginPasswordController@edit")->name("login.password.edit");
# /login/password/store (post) -> set user password
# Route::post("/login/password/store", "Web\LoginPasswordController@update")->name("login.password.update");

Route::prefix("sign-up")->name('sign-up.')->group(function () {

    # sign-up/create (get) -> new sign up form
    Route::get("", "Web\SignUpController@create")->name("create");
    # sign-up/store (post) -> create a new app
    Route::post("/store", "Web\SignUpController@store")->name("store");
    Route::get("/done/{userId}", "Web\SignUpController@done")->name('done');
    # sign-up/verify (get) -> verify the email of a signup user
    Route::get("/verify/{emailLink}", "Web\SignUpController@update")->name('verify');

});


Route::prefix("dashboard")->name('dashboard.')->middleware(['auth'])->group(function () {

    Route::prefix("apps")->name('apps.')->group(function () {

        # apps -> list of all apps
        Route::get("/", "Web\AppsController@index")->name("index");

        # apps/{appId} (get) -> Show app details
        Route::get("/{appId}", "Web\AppsController@show")->name("show");
        # apps/create (get) -> create a new app form
        Route::get("/create", "Web\AppsController@create")->name("create");
        # apps/store (post) -> create a new app
        Route::post("/store", "Web\AppsController@store")->name("store");
        
        # apps/{appId}/operations -> operations of sells & withdwal
        # apps/{appId}/operations/payouts -> payouts & settings
        
        # apps/{appId}/keys -> api key settings
        # apps/{appId}/keys/edit -> edit bundle id | site url | webhook
        # apps/{appId}/keys/reset -> reset api key
        # apps/{appId}/countries -> manage enabled countries
        # apps/{appId}/countries/edit -> edit enabled countries
        
        # apps/{appId}/users -> list of app users
        Route::get("/{appId}/users", "Web\AppsUsersController@index")->name("users.index");
        # apps/{appId}/users/create (get) -> add a user to an app form
        Route::get("/{appId}/users/create", "Web\AppsUsersController@create")->name("users.create");
        # apps/{appId}/users/store (post) -> add a user to an app
        Route::get("/{appId}/users/store", "Web\AppsUsersController@store")->name("users.store");
        # apps/{appId}/users/{userId}/show
        # apps/{appId}/users/{userId}/edit
        # apps/{appId}/users/{userId}/state
    
    
        # apps/{appId}/state -> give a state to an app ['ACTIVATED', 'DEACTIVATED', 'REJECTED']
        Route::patch("/{appId}/state", "Web\AppsStateController@update")->name("state.update");
    
        # apps/{appId}/carriers - add allowed caariers

    });

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
