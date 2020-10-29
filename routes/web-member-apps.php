<?php

Route::prefix("apps")->name('apps.')->group(function () {

    # apps/create (get) -> create a new app form
    Route::get("/create", "Web\AppsController@create")->name("create");
    
    # apps -> list a specific app
    Route::get("/{appId}", "Web\AppsController@index")->name("index");
    
    # apps/{appId}/operations -> operations of sells & withdwal
    # apps/{appId}/operations/payouts -> payouts & settings
    
    # apps/{appId}/api -> api key and documentation
    Route::get("/{appId}/api", "Web\AppsApiController@index")->name("api.index");

    # apps/{appId}/keys -> api key settings
    # apps/{appId}/keys/edit -> edit bundle id | site url | webhook
    # apps/{appId}/keys/reset -> reset api key
    # apps/{appId}/countries -> manage enabled countries
    # apps/{appId}/countries/edit -> edit enabled countries
    
    # apps/{appId}/users -> list of app users
    Route::get("/{appId}/users", "Web\AppsUsersController@index")->name("users.index");
    
    # apps/{appId}/users/create (get) -> add a user to an app form
    Route::get("/{appId}/users/create", "Web\AppsUsersController@create")->name("users.create");
    
    # apps/{appId}/users/{userId}/show -> show a app_users
    Route::get("/{appId}/users/{userId}/show", "Web\AppsUsersController@show")->name("users.show");
    
    # apps/{appId}/users/{userId}/edit
    # apps/{appId}/users/{userId}/state


    # apps/{appId}/state -> give a state to an app ['ACTIVATED', 'DEACTIVATED', 'REJECTED']
    Route::patch("/{appId}/state", "Web\AppsStateController@update")->name("state.update");

    # apps/{appId}/carriers - add allowed caariers

});