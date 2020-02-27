<?php

namespace App\Http\Controllers\Route;

use App\Event;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{

    public function showAdminLogin() {
        return view('login.admin');
    }

    public function showMemberLogin() {
        return view('login.member');
    }

    public function showAdminDashboard() {
        return view('admin.index');
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
        return view('admin.events.index');
    }

    public function showEventEdit($id) {
        return view('admin.events.edit', ['data' => Event::all()->find($id)]);
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

}
