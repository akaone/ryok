<?php

Route::get("/login", "Web\LoginController@index")->name("login");
Route::post("/login", "Web\LoginController@store")->name("login.store");

Route::prefix("dashboard")->name('dashboard.')->middleware(['auth'])->group(function () {

    # apps -> list of all apps
    # apps/create (get) -> create a new app form
    # apps/store (post) -> create a new app
    
    # {app_id} -> stats of sells & withdwal
    # {app_id}/payouts -> payouts & settings
    
    # {app_id}/keys -> api settings key 
    # {app_id}/keys/edit -> edit api key & bundle id
    # {app_id}/countries -> manage enabled countries
    # {app_id}/countries/edit -> edit enabled countries
    
    # {app_id}/users -> list of app users
    # {app_id}/users/create (get) -> add a user to an app form
    # {app_id}/users/store (post) -> add a user to an app
    # {app_id}/users/{user_id}/edit
    # {app_id}/users/{user_id}/update

    # carriers - add allowed caariers
});
