<?php

namespace App\Http\Controllers;

class RouteController extends Controller
{

    public function home() {
        return view('welcome');
    }

    public function showLogin() {
        return view('login.index');
    }

    public function showDashboard() {
        return view('admin.index');
    }

}
