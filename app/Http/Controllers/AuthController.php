<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) return back()->with('error', 'Trying to spoof the System? ;P');

        $data = [
            'username' => trim(strtolower($request->input('username'))),
            'password' => trim($request->input('password'))
        ];

        if (!Auth::attempt($data)) return back()->with('error', 'Invalid Credentials!');

        return redirect()->intended(route('dashboard'));
    }

    public function logout() {
        Auth::logout();
        return redirect()->intended(route('login'));
    }

    public function register($username) {
        $data = [
            'username' => trim(strtolower($username)),
            'email' => 'studentdevelopersociety@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ];

        $result = DB::table(env("DB_USERS"))
            ->insert($data);

        dd($result);
    }

    public function delete($username) {
        if (strtolower(Auth::user()) === strtolower($username)) return back()->with('error', 'You cannot Delete yourself!');

        bool: $delete = User::all()->find($username)->delete();

        if (!$delete) return back()->with('error', 'Unable to find this User!');

        return back()->with('message', "Done! User {$username} has been deleted!");
    }

}
