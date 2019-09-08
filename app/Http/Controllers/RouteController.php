<?php

namespace App\Http\Controllers;

use App\{Event, Page, Role, Template, User};
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{

    public function home() {
        return view('website.index');
    }

    public function showLogin() {
        return view('login.index');
    }

    public function showDashboard() {
        return view('admin.index');
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

}
