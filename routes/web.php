<?php

/** Landing */
Route::get('/', ['as' => 'home', 'uses' => 'RouteController@home']);

/** Login */
Route::get('/login', ['as' => 'login', 'uses' => 'RouteController@showLogin']);
Route::post('/login', ['as' => 'login.post', 'uses' => 'AuthController@login']);

/** Dashboard */
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'RouteController@showDashboard', 'middleware' => 'auth']);
