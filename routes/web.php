<?php

Route::post('/', ['as' => 'member.register', 'uses' => 'Member\MemberController@register']);

/** [Admin] Login */
Route::get('/admin', ['as' => 'admin.login', 'uses' => 'Route\RouteController@showAdminLogin']);
Route::post('/admin', ['as' => 'admin.login.post', 'uses' => 'Auth\AuthController@loginAsAdmin']);
/** End [Admin] Login */

/** [Member] Verification & Password Set */
Route::get('/verify/member', ['as' => 'member.verify', 'uses' => 'Member\MemberController@memberVerifyAccount']);
/** End [Member] Verification & Password Set */

/** [Member] Login */
Route::get('/member', ['as' => 'member.login', 'uses' => 'Route\RouteController@showMemberLogin']);
Route::post('/member', ['as' => 'member.login.post', 'uses' => 'Auth\AuthController@loginAsMember']);
/** End [Member] Login */

Route::group(['middleware' => 'auth:admin'], function () {
    /** [Admin] Dashboard */
    Route::get('/admin/dashboard', ['as' => 'admin.dashboard', 'uses' => 'Route\RouteController@showAdminDashboard']);
    /** End [Admin] Dashboard */

    /** [Profile] */
    Route::get('/admin/dashboard/profile', ['as' => 'admin.dashboard.profile', 'uses' => 'Route\RouteController@showAdminProfile']);
    Route::post('/admin/dashboard/profile', ['as' => 'admin.dashboard.profile', 'uses' => 'Auth\AuthController@updateAdminProfile']);
    /** End [Admin] Profile */

    /** [Members] */
    Route::get('/admin/dashboard/members', ['as' => 'admin.dashboard.members', 'uses' => 'Route\RouteController@showAllMembers']);
    Route::get('/admin/dashboard/members/{id}/edit', ['as' => 'admin.dashboard.members.edit', 'uses' => 'Route\RouteController@showEditMember']);
    Route::get('/admin/dashboard/members/{id}/delete', ['as' => 'admin.dashboard.members.delete', 'uses' => 'Member\MemberController@adminDeleteMember']);
    Route::post('/admin/dashboard/members/{id}/edit', ['as' => 'admin.dashboard.members.edit', 'uses' => 'Member\MemberController@adminUpdateMember']);
    Route::get('/admin/dashboard/members/export', function() { return app(\App\Http\Controllers\Member\MemberController::class)->exportAsCSV(); })->name('admin.dashboard.members.export');
    /** End [Members] */

    /** [Event] */
    Route::get('/admin/dashboard/events', ['as' => 'admin.dashboard.events', 'uses' => 'Route\RouteController@showEvents']);
    Route::get('/admin/dashboard/events/create', ['as' => 'admin.dashboard.events.create', 'uses' => 'Route\RouteController@showEventCreate']);
//    Route::post('/admin/dashboard/events/create', ['as' => 'admin.dashboard.events.create', 'uses' => 'Event\EventController@register']);
    Route::get('/admin/dashboard/events/{id}/edit', ['as' => 'admin.dashboard.events.edit', 'uses' => 'Route\RouteController@showEventEdit']);
//    Route::post('/admin/dashboard/events/{id}/edit', ['as' => 'admin.dashboard.events.edit', 'uses' => 'Event\EventController@update']);
    Route::get('/admin/dashboard/events/{id}/delete', ['as' => 'admin.dashboard.events.delete', 'uses' => 'Event\EventController@delete']);
    /** End [Event] */
});

Route::group(['middleware' => 'auth:member'], function () {
    /** [Member] Dashboard */
    Route::get('/member/dashboard', ['as' => 'member.dashboard', 'uses' => 'Route\RouteController@showMemberDashboard']);
    /** End [Member] Dashboard */
});
