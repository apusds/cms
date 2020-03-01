<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function updateAdminProfile(Request $request) {
        $validate = Validator::make($request->all(), [
            'password' => 'required',
            'confirm' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed Request!');

        $password = trim(strtolower($request->input('password')));
        $confirm = trim(strtolower($request->input('confirm')));

        if ($password !== $confirm) return back()->with('error', 'Both your Password isn\' the same!');

        $user = User::all()->find(Auth::user()->id);
        $user->password = Hash::make(trim($request->input('password')));
        $user->save();

        if ($user) {
            auth('admin')->logout();
            return redirect(route('admin.login'))->with('message', 'Please login with your new Password!');
        } else {
            return back()->with('error', 'Unable to update your Password!');
        }
    }

    public function logoutAsMember() {
        \auth('member')->logout();
        return redirect(route('member.login'));
    }

}
