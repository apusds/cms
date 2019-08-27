<?php

/** Landing */
Route::get('/', ['as' => 'home', 'uses' => 'RouteController@home']);

/** Temp */
//Route::get('/register/{username}', 'AuthController@registerTemp');

/** Login */
Route::get('/login', ['as' => 'login', 'uses' => 'RouteController@showLogin']);
Route::post('/login', ['as' => 'login.post', 'uses' => 'AuthController@login']);

/** Logout */
Route::get('/dashboard/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

/** Dashboard */
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'RouteController@showDashboard', 'middleware' => 'auth']);

/** Users */
Route::get('/dashboard/users', ['as' => 'dashboard.users', 'uses' => 'RouteController@showUsers', 'middleware' => 'auth']);
Route::get('/dashboard/users/create', ['as' => 'dashboard.users.create', 'uses' => 'RouteController@showUserCreate', 'middleware' => 'auth']);
Route::post('/dashboard/users/create', ['as' => 'dashboard.users.create', 'uses' => 'AuthController@register', 'middleware' => 'auth']);
Route::get('/dashboard/users/edit', ['as' => 'dashboard.users.edit', 'uses' => 'RouteController@showUserEdit', 'middleware' => 'auth']);

/** Events */
Route::get('/dashboard/events', ['as' => 'dashboard.events', 'uses' => 'RouteController@showEvents', 'middleware' => 'auth']);
