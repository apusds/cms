<?php

/** [Landing] */
Route::get('/', ['as' => 'home', 'uses' => 'RouteController@home']);
//Route::get('/pages/{name}', ['as' => 'pages', 'uses' => 'PageController@serve']);

Route::group(['middleware' => ['guest']], function() {
    /** [Admin] */
    Route::get('/admin', ['as' => 'login', 'uses' => 'RouteController@showAdminLogin']);
    Route::post('/admin', ['as' => 'login.post', 'uses' => 'Auth\AuthController@loginAdmin']);
});

Route::group(['middleware', ['member']], function() {});

Route::group(['middleware' => ['allowed', 'auth']], function() {
//    // [URI Checker]
//    Route::post('/api/uri/validate', ['as' => 'api.uri.check', 'uses' => 'APIController@checkURI']);
//    // End [URI Checker]

    /** [Dashboard] */
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'RouteController@showDashboard']);

    /** [Profile] */
    Route::get('/dashboard/profile', ['as' => 'dashboard.profile', 'uses' => 'RouteController@showProfile']);
    Route::post('/dashboard/profile', ['as' => 'dashboard.profile', 'uses' => 'Auth\AuthController@updatePassword']);

    /** [Logout] */
    Route::get('/dashboard/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

    /** [User] */
    Route::get('/dashboard/users', ['as' => 'dashboard.users', 'uses' => 'RouteController@showUsers']);

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

    /** [Website] */
    Route::get('/dashboard/website', ['as' => 'dashboard.website', 'uses' => 'RouteController@showWebsite']);
    Route::post('/dashboard/website', ['as' => 'dashboard.website', 'uses' => 'Website\WebsiteController@update']);

    /** [Gallery] */
    Route::get('/dashboard/gallery', ['as' => 'dashboard.gallery', 'uses' => 'RouteController@showGallery']);

    /** Upload [Gallery] */
    Route::get('/dashboard/gallery/upload', ['as' => 'dashboard.gallery.upload', 'uses' => 'RouteController@showGalleryCreate']);
    Route::post('/dashboard/gallery/upload', ['as' => 'dashboard.gallery.upload', 'uses' => 'Event\EventController@addToGallery']);

    /** Delete [Gallery] */
    Route::get('/dashboard/gallery/{id}/delete', ['as' => 'dashboard.gallery.delete', 'uses' => 'Event\EventController@removeFromGallery']);
});

// Special Perms for SuperAdmin Only
Route::group(['middleware' => ['superadmin', 'auth']], function () {
    /** Create [User] */
    Route::get('/dashboard/users/create', ['as' => 'dashboard.users.create', 'uses' => 'RouteController@showUserCreate']);
    Route::post('/dashboard/users/create', ['as' => 'dashboard.users.create', 'uses' => 'Auth\AuthController@register']);

    /** Edit [User] */
    Route::get('/dashboard/users/{id}/edit', ['as' => 'dashboard.users.edit', 'uses' => 'RouteController@showUserEdit']);
    Route::post('/dashboard/users/{id}/edit', ['as' => 'dashboard.users.edit', 'uses' => 'Auth\AuthController@update']);

    /** Delete [User] */
    Route::get('/dashboard/users/{id}/delete', ['as' => 'dashboard.users.delete', 'uses' => 'Auth\AuthController@delete']);

    /** [Role] */
    Route::get('/dashboard/roles', ['as' => 'dashboard.roles', 'uses' => 'RouteController@showRoles']);

    /** Create [Role] */
    Route::post('/dashboard/roles/create', ['as' => 'dashboard.roles.create', 'uses' => 'Role\RoleController@create']);

    /** Edit [Role] */
    Route::get('/dashboard/roles/{id}/edit', ['as' => 'dashboard.roles.edit', 'uses' => 'RouteController@showRoleEdit']);
    Route::post('/dashboard/roles/{id}/edit', ['as' => 'dashboard.roles.edit', 'uses' => 'Role\RoleController@update']);

    /** [Teams] */
    Route::get('/dashboard/teams', ['as' => 'dashboard.teams', 'uses' => 'RouteController@showTeams']);

    /** Create [Teams] */
    Route::get('/dashboard/teams/create', ['as' => 'dashboard.teams.create', 'uses' => 'RouteController@showTeamsCreate']);
    Route::post('/dashboard/teams/create', ['as' => 'dashboard.teams.create', 'uses' => 'Team\TeamController@addToTeam']);

    /** Delete [Teams] */
    Route::get('/dashboard/teams/{id}/delete', ['as' => 'dashboard.teams.delete', 'uses' => 'Team\TeamController@removeFromTeams']);

//    /** Delete [Template] */
//    Route::get('/dashboard/templates/{id}/delete', ['as' => 'dashboard.templates.delete', 'uses' => 'TemplateController@delete']);
});

// RESERVED
//    /** [Page] */
//    Route::get('/dashboard/pages', ['as' => 'dashboard.pages', 'uses' => 'RouteController@showPages']);
//
//    /** Create [Page] */
//    Route::get('/dashboard/pages/create', ['as' => 'dashboard.pages.create', 'uses' => 'RouteController@showPageCreate']);
//    Route::post('/dashboard/pages/create', ['as' => 'dashboard.pages.create', 'uses' => 'PageController@create']);
//
//    /** Edit [Page] */
//    Route::get('/dashboard/pages/{id}/edit', ['as' => 'dashboard.pages.edit', 'uses' => 'RouteController@showPageEdit']);
//    Route::post('/dashboard/pages/{id}/edit', ['as' => 'dashboard.pages.edit', 'uses' => 'PageController@update']);
//
//    /** Delete [Page] */
//    Route::get('/dashboard/pages/{id}/delete', ['as' => 'dashboard.pages.delete', 'uses' => 'PageController@delete']);
//
//    /** [Template] */
//    Route::get('/dashboard/templates', ['as' => 'dashboard.templates', 'uses' => 'RouteController@showTemplates']);
//
//    /** Create [Template] */
//    Route::post('/dashboard/templates/create', ['as' => 'dashboard.templates.create', 'uses' => 'TemplateController@create']);
//
//    /** Edit [Template] */
//    Route::get('/dashboard/templates/{id}/edit', ['as' => 'dashboard.templates.edit', 'uses' => 'RouteController@showTemplateEdit']);
//    Route::post('/dashboard/templates/{id}/edit', ['as' => 'dashboard.templates.edit', 'uses' => 'TemplateController@update']);
