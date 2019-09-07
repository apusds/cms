<?php

/** [Landing] */
Route::get('/', ['as' => 'home', 'uses' => 'RouteController@home']);

Route::group(['middleware' => ['guest']], function() {
    /** [Login] */
    Route::get('/login', ['as' => 'login', 'uses' => 'RouteController@showLogin']);
    Route::post('/login', ['as' => 'login.post', 'uses' => 'AuthController@login']);
});

Route::group(['middleware', ['member']], function() {});

Route::group(['middleware' => ['allowed', 'auth']], function() {
    // [URI Checker]
    Route::post('/api/uri/validate', ['as' => 'api.uri.check', 'uses' => 'APIController@checkURI']);
    // End [URI Checker]

    /** [Dashboard] */
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'RouteController@showDashboard']);

    /** [Logout] */
    Route::get('/dashboard/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

    /** [User] */
    Route::get('/dashboard/users', ['as' => 'dashboard.users', 'uses' => 'RouteController@showUsers']);

    /** [Event] */
    Route::get('/dashboard/events', ['as' => 'dashboard.events', 'uses' => 'RouteController@showEvents']);

    /** Create [Event] */
    Route::get('/dashboard/events/create', ['as' => 'dashboard.events.create', 'uses' => 'RouteController@showEventCreate']);
    Route::post('/dashboard/events/create', ['as' => 'dashboard.events.create', 'uses' => 'EventController@register']);

    /** Edit [Event] */
    Route::get('/dashboard/events/{id}/edit', ['as' => 'dashboard.events.edit', 'uses' => 'RouteController@showEventEdit']);
    Route::post('/dashboard/events/{id}/edit', ['as' => 'dashboard.events.edit', 'uses' => 'EventController@update']);

    /** Delete [Event] */
    Route::get('/dashboard/events/{id}/delete', ['as' => 'dashboard.events.delete', 'uses' => 'EventController@delete']);

    /** [Page] */
    Route::get('/dashboard/pages', ['as' => 'dashboard.pages', 'uses' => 'RouteController@showPages']);

    /** Create [Page] */
    Route::get('/dashboard/pages/create', ['as' => 'dashboard.pages.create', 'uses' => 'RouteController@showPageCreate']);
    Route::post('/dashboard/pages/create', ['as' => 'dashboard.pages.create', 'uses' => 'PageController@create']);

    /** Edit [Page] */
    Route::get('/dashboard/pages/{id}/edit', ['as' => 'dashboard.pages.edit', 'uses' => 'RouteController@showPageEdit']);

    /** Delete [Page] */
    /** TODO */

    /** [Template] */
    Route::get('/dashboard/templates', ['as' => 'dashboard.templates', 'uses' => 'RouteController@showTemplates']);

    /** Create [Template] */
    Route::get('/dashboard/templates/create', ['as' => 'dashboard.templates.create', 'uses' => 'RouteController@showTemplateCreate']);
});

// Special Perms for SuperAdmin Only
Route::group(['middleware' => ['superadmin', 'auth']], function () {
    /** Create [User] */
    Route::get('/dashboard/users/create', ['as' => 'dashboard.users.create', 'uses' => 'RouteController@showUserCreate']);
    Route::post('/dashboard/users/create', ['as' => 'dashboard.users.create', 'uses' => 'AuthController@register']);

    /** Edit [User] */
    Route::get('/dashboard/users/{id}/edit', ['as' => 'dashboard.users.edit', 'uses' => 'RouteController@showUserEdit']);
    Route::post('/dashboard/users/{id}/edit', ['as' => 'dashboard.users.edit', 'uses' => 'AuthController@update']);

    /** Delete [User] */
    Route::get('/dashboard/users/{id}/delete', ['as' => 'dashboard.users.delete', 'uses' => 'AuthController@delete']);

    /** [Role] */
    Route::get('/dashboard/roles', ['as' => 'dashboard.roles', 'uses' => 'RouteController@showRoles']);

    /** Create [Role] */
    Route::post('/dashboard/roles/create', ['as' => 'dashboard.roles.create', 'uses' => 'RoleController@create']);

    /** Edit [Role] */
    Route::get('/dashboard/roles/{id}/edit', ['as' => 'dashboard.roles.edit', 'uses' => 'RouteController@showRoleEdit']);
    Route::post('/dashboard/roles/{id}/edit', ['as' => 'dashboard.roles.edit', 'uses' => 'RoleController@update']);
});

