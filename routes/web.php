<?php

/** [Landing] */
Route::get('/', ['as' => 'home', 'uses' => 'RouteController@home']);
/** End [Landing] */

/** [Register] */
Route::get('/register', ['as' => 'register', 'uses' => 'RouteController@showRegister']);
/** End [Register] */

/** [Checkin] */
Route::get('/checkin', ['as' => 'checkin', 'uses' => 'RouteController@showCheckin']);
/** End [Checkin] */

/** [Event Page] */
Route::get('/e/{name}', ['as' => 'event', 'uses' => 'RouteController@showEvent']);
/** End [Event Page] */

/** Membership [Form] */
Route::post('/api/member/submit', ['as' => 'membership.post', 'uses' => 'Member\MemberController@register']);

/** Inquiry [Form] */
Route::post('/api/inquiry/submit', ['as' => 'inquiry.post', 'uses' => 'Website\WebsiteController@inquire']);

/** Member [Verification] */
Route::group(['middleware', ['cors']], function() {
    Route::get('/api/member/email/{email}', ['as' => 'member.verification', 'uses' => 'API\APIController@verify']);
});

/** Member Checkin */
Route::post('/api/member/checkin', ['as' => 'member.checkin', 'uses' => 'MeetupAttendee\MeetupAttendeeController@checkin']);

/** [Admin] */
Route::get('/admin', ['as' => 'admin', 'uses' => 'RouteController@showAdminLogin']);
Route::post('/admin', ['as' => 'admin.post', 'uses' => 'Auth\AuthController@login']);
/** End [Admin] */

/** [CAS] Get TGT */
// Route::get('/api/cas/auth/{username}/{password}', ['uses' => 'API\CASController@getTGT']);

Route::group(['middleware', ['member']], function() {
    /** TODO [Member Area] */
});

Route::group(['middleware' => ['allowed', 'auth', 'optimizeImages']], function() {
    /** [Stats (Per Date)] */
    Route::get('/api/stats/members/sort', ['as' => 'api.stats.members', 'uses' => 'Member\MemberController@totalPerDate']);

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
    /** [Meetups] */
    Route::get('/dashboard/meetups', ['as' => 'dashboard.meetups', 'uses' => 'RouteController@showMeetups']);

    /** Create [Meetups] */
    Route::get('/dashboard/meetups/create', ['as' => 'dashboard.meetups.create', 'uses' => 'RouteController@showMeetupCreate']);
    Route::post('/dashboard/meetups/create', ['as' => 'dashboard.meetups.create', 'uses' => 'Meetup\MeetupController@register']);

    /** Edit [Meetups] */
    Route::get('/dashboard/meetups/{id}/edit', ['as' => 'dashboard.meetups.edit', 'uses' => 'RouteController@showMeetupEdit']);
    Route::post('/dashboard/meetups/{id}/edit', ['as' => 'dashboard.meetups.edit', 'uses' => 'Meetup\MeetupController@update']);

    /** Delete [Meetups] */
    Route::get('/dashboard/meetups/{id}/delete', ['as' => 'dashboard.meetups.delete', 'uses' => 'Meetup\MeetupController@delete']);

    /** Meetups [Feedback] */
    Route::get('/dashboard/meetups/deactivate', ['as' => 'dashboard.meetups.deactivate', 'uses' => 'Meetup\MeetupController@deactivate']);
    // ***************************************************************

    // ***************************************************************
    /** [Meetup Attendees] */
    Route::get('/dashboard/meetups/{id}/attendees', ['as' => 'dashboard.meetups.attendees', 'uses' => 'RouteController@showMeetupAttendees']);

    Route::get('/dashboard/attendees/{id}', ['as' => 'dashboard.attendees.delete', 'uses' => 'MeetupAttendee\MeetupAttendeeController@delete']);

    Route::get('/dashboard/meetups/{id}/attendees/export', function($id) {
        return app(\App\Http\Controllers\MeetupAttendee\MeetupAttendeeController::class)->export($id);
    })->name('dashboard.meetups.attendees.export');
    // ***************************************************************

    // ***************************************************************
    /** [Emailer] */
    Route::get('/dashboard/emailer', ['as' => 'dashboard.emailer', 'uses' => 'RouteController@showEmailer']);
    Route::post('/dashboard/emailer', ['as' => 'dashboard.emailer', 'uses' => 'API\APIController@massSendEmail']);
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
    Route::get('/dashboard/members/{id}/edit', ['as' => 'dashboard.members.edit', 'uses' => 'RouteController@showEditMember']);
    Route::get('/dashboard/members/{id}/delete', ['as' => 'dashboard.members.delete', 'uses' => 'Member\MemberController@deleteMember']);
    Route::post('/dashboard/members/{id}/edit', ['as' => 'dashboard.members.edit', 'uses' => 'Member\MemberController@updateMember']);
    Route::get('/dashboard/members/export', function() {
        return app(\App\Http\Controllers\Member\MemberController::class)->exportAsCSV();
    })->name('dashboard.members.export');
    // ***************************************************************

    // ***************************************************************
    /** [Redirector] */
    Route::get('/dashboard/redirector', ['as' => 'redirector', 'uses' => 'RouteController@showRedirector']);
    // ***************************************************************

    // ***************************************************************
    /** [TestBed] */
    Route::get('/dashboard/testbed/', function () {
        return view('admin.testbed.index');
    });
});

// Special Perms for SuperAdmin Only
Route::group(['middleware' => ['superadmin', 'auth', 'optimizeImages']], function () {

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
