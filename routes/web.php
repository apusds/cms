<?php

/** Landing */
Route::get('/', ['as' => 'home', 'uses' => 'RouteController@home']);

/** Temp */
//Route::get('/register/{username}', 'AuthController@registerTemp');

Route::group(['middleware' => ['guest']], function() {
    /** Login */
    Route::get('/login', ['as' => 'login', 'uses' => 'RouteController@showLogin']);
    Route::post('/login', ['as' => 'login.post', 'uses' => 'AuthController@login']);
});

Route::group(['middleware' => ['allowed']], function() {
    /** Dashboard */
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'RouteController@showDashboard', 'middleware' => 'auth']);

    /** Logout */
    Route::get('/dashboard/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

    /** [User]s */
    Route::get('/dashboard/users', ['as' => 'dashboard.users', 'uses' => 'RouteController@showUsers', 'middleware' => 'auth']);

    /** Create [User] */
    Route::get('/dashboard/users/create', ['as' => 'dashboard.users.create', 'uses' => 'RouteController@showUserCreate', 'middleware' => 'auth']);
    Route::post('/dashboard/users/create', ['as' => 'dashboard.users.create', 'uses' => 'AuthController@register', 'middleware' => 'auth']);

    /** Edit [User] */
    Route::get('/dashboard/users/{id}/edit', ['as' => 'dashboard.users.edit', 'uses' => 'RouteController@showUserEdit', 'middleware' => 'auth']);
    Route::post('/dashboard/users/{id}/edit', ['as' => 'dashboard.users.edit', 'uses' => 'AuthController@update', 'middleware' => 'auth']);

    /** Delete [User] */
    Route::get('/dashboard/users/{id}/delete', ['as' => 'dashboard.users.delete', 'uses' => 'AuthController@delete', 'middleware' => 'auth']);

    /** Events */
    Route::get('/dashboard/events', ['as' => 'dashboard.events', 'uses' => 'RouteController@showEvents', 'middleware' => 'auth']);
});

// Special Perms for SuperAdmin Only
Route::group(['middleware' => ['superadmin']], function () { });

