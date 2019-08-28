<?php

namespace App\Http\Controllers;

use App\User;

class RouteController extends Controller
{

    public function home() {
        return redirect(route('login'));
    }

    public function showLogin() {
        return view('login.index');
    }

    public function showDashboard() {
        return view('admin.index');
    }

    public function showEvents() {
        return view('admin.events.index');
    }

    public function showUsers() {
        return view('admin.users.index');
    }

    public function showUserCreate() {
        return view('admin.users.create');
    }

    public function showUserEdit($id) {
        return view('admin.users.edit', ['data' => User::all()->find($id)]);
    }

}
