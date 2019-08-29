<?php

/** Landing */
Route::get('/', ['as' => 'home', 'uses' => 'RouteController@home']);

/** Temp */
// Route::get('/register/{username}', 'AuthController@registerTemp');

Route::group(['middleware' => ['guest']], function() {
    /** Login */
    Route::get('/login', ['as' => 'login', 'uses' => 'RouteController@showLogin']);
    Route::post('/login', ['as' => 'login.post', 'uses' => 'AuthController@login']);
});

Route::group(['middleware', ['member']], function() {});

Route::group(['middleware' => ['allowed', 'auth']], function() {
    /** Dashboard */
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'RouteController@showDashboard']);

    /** Logout */
    Route::get('/dashboard/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

    /** [Users] */
    Route::get('/dashboard/users', ['as' => 'dashboard.users', 'uses' => 'RouteController@showUsers']);

    /** [Events] */
    Route::get('/dashboard/events', ['as' => 'dashboard.events', 'uses' => 'RouteController@showEvents']);

    /** Create [Events] */
    Route::get('/dashboard/events/create', ['as' => 'dashboard.events.create', 'uses' => 'RouteController@showEventCreate']);
    Route::post('/dashboard/events/create', ['as' => 'dashboard.events.create', 'uses' => 'EventController@register']);

    /** Edit [Events] */
    Route::get('/dashboard/events/{id}/edit', ['as' => 'dashboard.events.edit', 'uses' => 'RouteController@showEventEdit']);
    Route::post('/dashboard/events/{id}/edit', ['as' => 'dashboard.events.edit', 'uses' => 'EventController@update']);

    /** Delete [Events] */
    Route::get('/dashboard/events/{id}/delete', ['as' => 'dashboard.events.delete', 'uses' => 'EventController@delete']);
});

// Special Perms for SuperAdmin Only
Route::group(['middleware' => ['superadmin', 'auth']], function () {
    /** Create [User] */
    Route::get('/dashboard/users/create', ['as' => 'dashboard.users.create', 'uses' => 'RouteController@showUserCreate']);
    Route::post('/dashboard/users/create', ['as' => 'dashboard.users.create', 'uses' => 'AuthController@register']);

    /** Edit [User] */
    Route::get('/dashboard/users/{id}/edit', ['as' => 'dashboard.users.edit', 'uses' => 'RouteController@showUserEdit']);
    Route::post('/dashboard/users/{id}/edit', ['as' => 'dashboard.users.edit', 'uses' => 'AuthController@update']);

    /** Delete [User] */
    Route::get('/dashboard/users/{id}/delete', ['as' => 'dashboard.users.delete', 'uses' => 'AuthController@delete']);
});

