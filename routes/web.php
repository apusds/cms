<?php

Route::get('/', ['as' => 'home', 'uses' => 'RouteController@home']);

Route::get('/login', ['as' => 'login', 'uses' => 'RouteController@login']);
Route::post('/login', ['as' => 'login.post', 'uses' => 'AuthController@login']);
