<?php

namespace App\Http\Controllers\Route;

use App\Attendees;
use App\Committee;
use App\Event;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\Member\MemberController;
use App\Member;
use App\PasswordSession;
use App\Role;
use App\Website;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{

    public function showHome() {
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

    public function showAdminLogin() {
        return view('login.admin');
    }

    public function showMemberLogin() {
        return view('login.member');
    }

    public function showAdminDashboard() {
        return view('admin.index', [
            'joinedToday' => app(MemberController::class)->joinedToday()
        ]);
    }

    public function showMemberDashboard() {
        return view('member.index');
    }

    public function showAdminProfile() {
        return view('admin.profile.index');
    }

    public function showEvents() {
        return view('admin.events.index');
    }

    public function showEventCreate() {
        return view('admin.events.create');
    }

    public function showEventEdit($id) {
        return view('admin.events.edit', ['data' => Event::all()->find($id)]);
    }

    public function showEventAttendees($id) {
        $result = Event::all()->find($id);
        if (!$result) return view('errors.500');

        $data = Attendees::all()->where('event_title', $result->title);
        return view('admin.events.attendees', ['data' => $data]);
    }

    public function showRoles() {
        return view('admin.roles.index');
    }

    public function showWebsite() {
        return view('admin.website.index', [
            'data' => Website::all()->find(1)
        ]);
    }

    public function showMemberVerifyAccount($token) {
        $data = PasswordSession::all()->where('token', '=', $token);
        if (count(($data)) < 1)return view('errors.502');
        return view('member.verify.index', ['token' => $token, 'email' => $data->first()->email]);
    }

    public function showAllMembers(Request $request) {
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

    public function showRoleEdit($id) {
        if ($id == 1) return back()->with('error', 'You cannot edit this role!');
        if (!(Role::all()->find($id))) return back()->with('error', 'Invalid Role, Role not found!');

        return view('admin.roles.edit', ['role' => Role::all()->find($id)]);
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

}
