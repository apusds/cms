<?php

/** Landing */
Route::get('/', ['as' => 'home', 'uses' => 'RouteController@home']);

/** Temp */
// Route::get('/register/{username}', 'AuthController@register');

/** Login */
Route::get('/login', ['as' => 'login', 'uses' => 'RouteController@showLogin']);
Route::post('/login', ['as' => 'login.post', 'uses' => 'AuthController@login']);

/** Logout */
Route::get('/dashboard/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

/** Dashboard */
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'RouteController@showDashboard', 'middleware' => 'auth']);
