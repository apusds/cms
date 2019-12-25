<?php

namespace App\Http\Controllers;

use Illuminate\{
    Support\Facades\Auth,
    Http\Request
};

use App\{
    Committee,
    Event,
    Meetup,
    ActiveMeetup,
    Http\Controllers\Event\EventController,
    Http\Controllers\Member\MemberController,
    Member,
    Role,
    User,
    Website
};

class RouteController extends Controller
{

    public function home() {
        return view('layouts.website.index', [
            'activeEvents' => app(EventController::class)->getActiveEvents(),
            'expiredEvents' => app(EventController::class)->getExpiredEvents(),
            'dscEvents' => app(EventController::class)->getDSCEvents(),
            'data' => Website::all()->find(1)
        ]);
    }

    public function showRegister() {
        return view('layouts.website.register', ['data' => Website::all()->find(1)]);
    }

    public function showCheckin() {
        $result = (ActiveMeetup::first()) ? ActiveMeetup::first()->meetup : '';
        return view('layouts.website.checkin', ['data' => $result]);
    }

    public function showLogin() {
        return view('login.index');
    }

    public function showDashboard() {
        return "Logged in!: " . \auth()->guard('member');
    }

    public function showAdminLogin() {
        return view('login.index');
    }

    public function showAdminDashboard() {
        return view('admin.index', [
            'joinedToday' => app(MemberController::class)->joinedToday()
        ]);
    }

    public function showProfile() {
        return view('admin.profile.index');
    }

    // [Events]

    public function showEvents() {
        return view('admin.events.index');
    }

    public function showEventCreate() {
        return view('admin.events.create');
    }

    public function showEventEdit($id) {
        return view('admin.events.edit', ['data' => Event::all()->find($id)]);
    }

    // End [Events]

    // [Meetups]

    public function showMeetups() {
        return view('admin.meetups.index');
    }

    public function showMeetupCreate() {
        return view('admin.meetups.create');
    }

    public function showMeetupEdit($id) {
        return view('admin.meetups.edit', ['data' => Meetup::all()->find($id)]);
    }

    // End [Meetups]

    // [Meetup Attendees]
    public function showMeetupAttendees($id) {
        return view('admin.meetups.attendees', ['meetup' => Meetup::find($id)]);
    }

    // End [Meetups]

    // [Users]

    public function showUsers() {
        return view('admin.users.index');
    }

    public function showUserCreate() {
        return view('admin.users.create');
    }

    public function showUserEdit($id) {
        if ($id == Auth::user()->id) return back()->with('error', 'You cannot edit the details of yourself!');
        if (!(User::all()->find($id))) return back()->with('error', 'Invalid ID, User not found!'); // If the User does not exist, break the request and page render.

        return view('admin.users.edit', ['data' => User::all()->find($id)]);
    }

    // End [Users]

    // Serve [Event Page]

    public function showEvent($name) {
        $event = Event::all()->where('identifier', trim(strtolower($name)))->first();
        if (!$event) return view('errors.404');

        return view('errors.404');
        //        return view('layouts.website.event', ['data' => $event]);
    }

    // Serve [Event Page]

    // [Pages]
    public function showPages() {
        return view('admin.pages.index');
    }

    public function showPageCreate() {
        return view('admin.pages.create');
    }

    public function showPageEdit($id) {
        if (!(Page::all()->find($id))) return back()->with('error', 'This Page is not found!');

        return view('admin.pages.edit', ['page' => Page::all()->find($id)]);
    }

    // End [Pages]

    // [Templates]
    public function showTemplates() {
        return view('admin.templates.index');
    }

    public function showTemplateEdit($id) {
        if (!(Template::all()->find($id))) return back()->with('error', 'This Template is not found!');

        return view('admin.templates.edit', ['template' => Template::all()->find($id)]);
    }

    // End [Templates]

    // [Roles]
    public function showRoles() {
        return view('admin.roles.index');
    }

    public function showRoleEdit($id) {
        if ($id == 1) return back()->with('error', 'You cannot edit this role!');
        if (!(Role::all()->find($id))) return back()->with('error', 'Invalid Role, Role not found!');

        return view('admin.roles.edit', ['role' => Role::all()->find($id)]);
    }

    // End [Roles]

    // [Members]
    public function showMembers(Request $request) {
        $perPage = 20;
        $q = null;
        $page = 1;

        if ($request->filled('perPage')) $perPage = $request->query('perPage');
        if ($request->filled('q')) $q = $request->query('q');
        if ($request->filled('page')) $page = $request->query('page');

        $members = Member::search($q)->with('events')->paginate($perPage);

        if ($request->ajax()) {
            return view('admin.members.load', ['members'=>$members, 'perPage'=>$perPage, 'q'=>$q, 'page'=>$page])->render();
        }

        return view('admin.members.index', compact('members', 'perPage', 'q', 'page'));
    }

    public function showEditMember($id) {
        if (!(Member::all()->find($id))) return back()->with('error', 'Member not found!');
        return view('admin.members.edit', ['data' => Member::all()->find($id)]);
    }
    // End [Members]

    // [Emailer]
    public function showEmailer() {
        return view('admin.emailer.index');
    }
    // End [Emailer]

    // [Redirector]
    public function showRedirector() {
        return view('admin.redirector.index');
    }
    // End [Redirector]

    // [Global Settings]
    public function showWebsite() {
        return view('admin.website.index', [
            'data' => Website::all()->find(1)
        ]);
    }

    public function showTeams() {
        return view('admin.teams.index');
    }

    public function showTeamsCreate() {
        return view('admin.teams.create');
    }

    public function showTeamsEdit($id) {
        if (!(Committee::all()->find($id))) return back()->with('error', 'This Member is not found!');
        return view('admin.teams.edit', ['data' => Committee::all()->find($id)]);
    }

    public function showGallery() {
        return view('admin.gallery.index');
    }

    public function showGalleryCreate() {
        return view('admin.gallery.create', [
            'events' => Event::all()
        ]);
    }

    // End [Global Settings]

}
