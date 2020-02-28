<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function loginAsAdmin(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) return back()->with('error', 'Trying to spoof the System? ;P');

        $data = [
            'username' => trim(strtolower($request->input('username'))),
            'password' => trim($request->input('password'))
        ];

        if (!Auth::guard('admin')->attempt($data)) return back()->with('error', 'Invalid Credentials!');
        return redirect()->intended(route('admin.dashboard'));
    }

    public function loginAsMember(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) return back()->with('error', 'Trying to spoof the System? ;P');

        $data = [
            'email' => trim(strtolower($request->input('email'))),
            'password' => trim($request->input('password'))
        ];

        if (!Auth::guard('member')->attempt($data)) return back()->with('error', 'Invalid Credentials!');
        return redirect()->intended(route('member.dashboard'));
    }

    public function logoutAsMember() {
        \auth('member')->logout();
        return redirect(route('member.login'));
    }

}
