<?php

namespace App\Http\Controllers\Route;

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

}
