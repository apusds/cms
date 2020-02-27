<?php

Route::post('/member/new/register', ['as' => 'member.register', 'uses' => 'Member\MemberController@register']);

/** [Admin] Login */
Route::get('/admin', ['as' => 'admin.login', 'uses' => 'Route\RouteController@showAdminLogin']);
Route::post('/admin', ['as' => 'admin.login.post', 'uses' => 'Auth\AuthController@loginAsAdmin']);
/** End [Admin] Login */

/** [Member] Login */
Route::get('/member', ['as' => 'member.login', 'uses' => 'Route\RouteController@showMemberLogin']);
Route::post('/member', ['as' => 'member.login.post', 'uses' => 'Auth\AuthController@loginAsMember']);
/** End [Member] Login */

/** [Admin] Dashboard */
Route::get('/admin/dashboard', ['as' => 'admin.dashboard', 'uses' => 'Route\RouteController@showAdminDashboard']);
/** End [Admin] Dashboard */

/** [Member] Dashboard */
Route::get('/member/dashboard', ['as' => 'member.dashboard', 'uses' => 'Route\RouteController@showMemberDashboard']);
/** End [Member] Dashboard */
