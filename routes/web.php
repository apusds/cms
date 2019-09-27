<?php

/** [Landing] */
Route::get('/', ['as' => 'home', 'uses' => 'RouteController@home']);
/** End [Landing] */

/** [Event Page] */
Route::get('/e/{name}', ['as' => 'event', 'uses' => 'RouteController@showEvent']);
/** End [Event Page] */

/** Membership [Form] */
Route::post('/api/member/submit', ['as' => 'membership.post', 'uses' => 'Member\MemberController@register']);

/** Inquiry [Form] */
Route::post('/api/inquiry/submit', ['as' => 'inquiry.post', 'uses' => 'Website\WebsiteController@inquire']);

/** Member [Verification] */
Route::get('/api/member/email/{email}', ['as' => 'member.verification', 'uses' => 'API\APIController@verify']);

/** [Admin] */
Route::get('/admin', ['as' => 'admin', 'uses' => 'RouteController@showAdminLogin']);
Route::post('/admin', ['as' => 'admin.post', 'uses' => 'Auth\AuthController@login']);
/** End [Admin] */

Route::group(['middleware', ['member']], function() {});

Route::group(['middleware' => ['allowed', 'auth']], function() {

    /** [Dashboard] */
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'RouteController@showDashboard']);

    /** [Profile] */
    Route::get('/dashboard/profile', ['as' => 'dashboard.profile', 'uses' => 'RouteController@showProfile']);
    Route::post('/dashboard/profile', ['as' => 'dashboard.profile', 'uses' => 'Auth\AuthController@updatePassword']);

    /** [Logout] */
    Route::get('/dashboard/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

    /** [User] */
    Route::get('/dashboard/users', ['as' => 'dashboard.users', 'uses' => 'RouteController@showUsers']);





    // ***************************************************************
    /** [Event] */
    Route::get('/dashboard/events', ['as' => 'dashboard.events', 'uses' => 'RouteController@showEvents']);

    /** Create [Event] */
    Route::get('/dashboard/events/create', ['as' => 'dashboard.events.create', 'uses' => 'RouteController@showEventCreate']);
    Route::post('/dashboard/events/create', ['as' => 'dashboard.events.create', 'uses' => 'Event\EventController@register']);

    /** Edit [Event] */
    Route::get('/dashboard/events/{id}/edit', ['as' => 'dashboard.events.edit', 'uses' => 'RouteController@showEventEdit']);
    Route::post('/dashboard/events/{id}/edit', ['as' => 'dashboard.events.edit', 'uses' => 'Event\EventController@update']);

    /** Delete [Event] */
    Route::get('/dashboard/events/{id}/delete', ['as' => 'dashboard.events.delete', 'uses' => 'Event\EventController@delete']);

    /** Event [Feedback] */
    Route::post('/dashboard/events/{id}/feedback', ['as' => 'dashboard.feedback.submit', 'uses' => 'Feedback\FeedbackController@submit']);
    // ***************************************************************





    // ***************************************************************
    /** [Website] */
    Route::get('/dashboard/website', ['as' => 'dashboard.website', 'uses' => 'RouteController@showWebsite']);
    Route::post('/dashboard/website', ['as' => 'dashboard.website', 'uses' => 'Website\WebsiteController@update']);
    // ***************************************************************





    // ***************************************************************
    /** [Gallery] */
    Route::get('/dashboard/gallery', ['as' => 'dashboard.gallery', 'uses' => 'RouteController@showGallery']);

    /** Upload [Gallery] */
    Route::get('/dashboard/gallery/upload', ['as' => 'dashboard.gallery.upload', 'uses' => 'RouteController@showGalleryCreate']);
    Route::post('/dashboard/gallery/upload', ['as' => 'dashboard.gallery.upload', 'uses' => 'Event\EventController@addToGallery']);

    /** Delete [Gallery] */
    Route::get('/dashboard/gallery/{id}/delete', ['as' => 'dashboard.gallery.delete', 'uses' => 'Event\EventController@removeFromGallery']);
    // ***************************************************************





    // ***************************************************************
    /** [Members] */
    Route::get('/dashboard/members', ['as' => 'dashboard.members', 'uses' => 'RouteController@showMembers']);
});

// Special Perms for SuperAdmin Only
Route::group(['middleware' => ['superadmin', 'auth']], function () {

    // ***************************************************************
    /** Create [User] */
    Route::get('/dashboard/users/create', ['as' => 'dashboard.users.create', 'uses' => 'RouteController@showUserCreate']);
    Route::post('/dashboard/users/create', ['as' => 'dashboard.users.create', 'uses' => 'Auth\AuthController@register']);

    /** Edit [User] */
    Route::get('/dashboard/users/{id}/edit', ['as' => 'dashboard.users.edit', 'uses' => 'RouteController@showUserEdit']);
    Route::post('/dashboard/users/{id}/edit', ['as' => 'dashboard.users.edit', 'uses' => 'Auth\AuthController@update']);

    /** Delete [User] */
    Route::get('/dashboard/users/{id}/delete', ['as' => 'dashboard.users.delete', 'uses' => 'Auth\AuthController@delete']);
    // ***************************************************************





    // ***************************************************************
    /** [Role] */
    Route::get('/dashboard/roles', ['as' => 'dashboard.roles', 'uses' => 'RouteController@showRoles']);

    /** Create [Role] */
    Route::post('/dashboard/roles/create', ['as' => 'dashboard.roles.create', 'uses' => 'Role\RoleController@create']);

    /** Edit [Role] */
    Route::get('/dashboard/roles/{id}/edit', ['as' => 'dashboard.roles.edit', 'uses' => 'RouteController@showRoleEdit']);
    Route::post('/dashboard/roles/{id}/edit', ['as' => 'dashboard.roles.edit', 'uses' => 'Role\RoleController@update']);
    // ***************************************************************

    // ***************************************************************
    /** [Teams] */
    Route::get('/dashboard/teams', ['as' => 'dashboard.teams', 'uses' => 'RouteController@showTeams']);

    /** Create [Teams] */
    Route::get('/dashboard/teams/create', ['as' => 'dashboard.teams.create', 'uses' => 'RouteController@showTeamsCreate']);
    Route::post('/dashboard/teams/create', ['as' => 'dashboard.teams.create', 'uses' => 'Team\TeamController@addToTeam']);

    /** Delete [Teams] */
    Route::get('/dashboard/teams/{id}/delete', ['as' => 'dashboard.teams.delete', 'uses' => 'Team\TeamController@removeFromTeams']);

    /** Edit [Teams] */
    Route::get('/dashboard/teams/{id}/edit', ['as' => 'dashboard.teams.edit', 'uses' => 'RouteController@showTeamsEdit']);
    Route::post('/dashboard/teams/{id}/edit', ['as' => 'dashboard.teams.edit', 'uses' => 'Team\TeamController@update']);
    // ***************************************************************

});
