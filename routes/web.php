<?php

Route::get('/', ['as' => 'home', 'uses' => 'Route\RouteController@showHome']);
Route::post('/', ['as' => 'member.register', 'uses' => 'Member\MemberController@register']);

/** [Register] */
Route::get('/register', ['as' => 'register', 'uses' => 'Route\RouteController@showRegister']);

/** Membership [Form] */
Route::post('/api/member/submit', ['as' => 'membership.post', 'uses' => 'Member\MemberController@register']);

/** Inquiry [Form] */
Route::post('/api/inquiry/submit', ['as' => 'inquiry.post', 'uses' => 'Website\WebsiteController@inquire']);

/** [Admin] Login */
Route::get('/admin', ['as' => 'admin.login', 'uses' => 'Route\RouteController@showAdminLogin']);
Route::post('/admin', ['as' => 'admin.login.post', 'uses' => 'Auth\AuthController@loginAsAdmin']);
/** End [Admin] Login */

/** [Member] Verification & Password Set */
Route::get('/verify/member/{token}', ['as' => 'member.verify', 'uses' => 'Route\RouteController@showMemberVerifyAccount']);
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
    Route::post('/admin/dashboard/events/create', ['as' => 'admin.dashboard.events.create', 'uses' => 'Event\EventController@register']);
    Route::get('/admin/dashboard/events/{id}/edit', ['as' => 'admin.dashboard.events.edit', 'uses' => 'Route\RouteController@showEventEdit']);
    Route::post('/admin/dashboard/events/{id}/edit', ['as' => 'admin.dashboard.events.edit', 'uses' => 'Event\EventController@update']);
    Route::get('/admin/dashboard/events/{id}/delete', ['as' => 'admin.dashboard.events.delete', 'uses' => 'Event\EventController@delete']);
    /** End [Event] */

    /** [Role] */
    Route::get('/admin/dashboard/roles', ['as' => 'admin.dashboard.roles', 'uses' => 'Route\RouteController@showRoles']);
    /** Create [Role] */
    Route::post('/admin/dashboard/roles/create', ['as' => 'admin.dashboard.roles.create', 'uses' => 'Role\RoleController@create']);
    /** Edit [Role] */
    Route::get('/admin/dashboard/roles/{id}/edit', ['as' => 'admin.dashboard.roles.edit', 'uses' => 'Route\RouteController@showRoleEdit']);
    Route::post('/admin/dashboard/roles/{id}/edit', ['as' => 'admin.dashboard.roles.edit', 'uses' => 'Role\RoleController@update']);

    /** [Website] */
    Route::get('/admin/dashboard/website', ['as' => 'admin.dashboard.website', 'uses' => 'Route\RouteController@showWebsite']);
    Route::post('/admin/dashboard/website', ['as' => 'admin.dashboard.website', 'uses' => 'Website\WebsiteController@update']);

    /** [Teams] */
    Route::get('/admin/dashboard/teams', ['as' => 'admin.dashboard.teams', 'uses' => 'Route\RouteController@showTeams']);
    /** Create [Teams] */
    Route::get('/admin/dashboard/teams/create', ['as' => 'admin.dashboard.teams.create', 'uses' => 'Route\RouteController@showTeamsCreate']);
    Route::post('/admin/dashboard/teams/create', ['as' => 'admin.dashboard.teams.create', 'uses' => 'Team\TeamController@addToTeam']);
    /** Delete [Teams] */
    Route::get('/admin/dashboard/teams/{id}/delete', ['as' => 'admin.dashboard.teams.delete', 'uses' => 'Team\TeamController@removeFromTeams']);
    /** Edit [Teams] */
    Route::get('/admin/dashboard/teams/{id}/edit', ['as' => 'admin.dashboard.teams.edit', 'uses' => 'Route\RouteController@showTeamsEdit']);
    Route::post('/admin/dashboard/teams/{id}/edit', ['as' => 'admin.dashboard.teams.edit', 'uses' => 'Team\TeamController@update']);
});

Route::group(['middleware' => 'auth:member'], function () {
    /** [Member] Dashboard */
    Route::get('/member/dashboard', ['as' => 'member.dashboard', 'uses' => 'Route\RouteController@showMemberDashboard']);
    /** End [Member] Dashboard */
});
