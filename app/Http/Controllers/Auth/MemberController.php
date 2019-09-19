<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{

    public function login(Request $request) {
        dd($request->input());
    }

    public function register(Request $request) {
        dd($request->input());
    }

}
