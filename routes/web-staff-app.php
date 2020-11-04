<?php


Route::prefix("app")->name('app.')->group(function () {

    # staff - list all apps
    Route::get("/list", "Web\AppsController@list")->name("list");

    # staff - show app details
    Route::get("/{appId}", "Web\AppsController@show")->name("show");

});