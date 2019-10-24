<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ Auth, DB, Hash, Validator };

class AuthController extends Controller
{
    // Admin Area Starts!

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

    public function register(Request $request) {
        $validate = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed Request.');

        $user = new User;
        $user->username = strtolower($request->input('username'));
        $user->email = strtolower($request->input('email'));
        $user->password = Hash::make($request->input('password'));
        $user->role_id = strtolower($request->input('role_id'));
        $user->save();

        if (!$user) return back()->with('error', 'Unable to register new User');
        return back()->with('message', 'Done!');
    }

    public function update(Request $request, $id) {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if (!$validate) return back()->with('error', 'Malformed Request. Please check your params.');

        $user = User::all()->find($id);
        $user->username = strtolower($request->input('username'));
        $user->password = $request->input('password') !== "" ? Hash::make($request->input('password')) : $user->password;
        $user->email = strtolower($request->input('email'));
        $user->role_id = strtolower($request->input('role_id'));
        $user->update();

        if (!$user) return back()->with('error', 'Unable to update User details or no changes!');
        return back()->with('message', 'Done!');
    }

    public function updatePassword(Request $request) {
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
            auth()->logout();
            return redirect(route('admin'))->with('message', 'Please login with your new Password!');
        } else {
            return back()->with('error', 'Unable to update your Password rn!');
        }
    }

    public function delete($id) {
        try {
            User::all()->find($id)->delete();
            return redirect(route('dashboard.users'))->with('message', 'User deleted!');
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to delete User!');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->intended(route('admin'));
    }


}
