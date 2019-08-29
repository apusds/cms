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

    public function registerTemp($username) {
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

    public function register(Request $request) {
        $validate = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed Request.');

        $data = [
            'username' => strtolower($request->input('username')),
            'email' => strtolower($request->input('email')),
            'password' => Hash::make($request->input('password')),
            'role_id' => strtolower($request->input('role_id')),
            'created_at' => new \DateTime()
        ];

        $result = DB::table(env("DB_USERS"))
            ->insert($data);

        if (!$result) return back()->with('error', 'Unable to register new User');
        return back()->with('message', 'Done!');
    }

    public function update(Request $request, $id) {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if (!$validate) return back()->with('error', 'Malformed Request. Please check your params.');

        $user = User::all()->find($id);
        $data = [
            'username' => strtolower($request->input('username')),
            'password' => $request->input('password') === "" ? bcrypt($request->input('password')) : $user->password,
            'email' => strtolower($request->input('email')),
            'role_id' => $request->input('role_id'),
            'updated_at' => new \DateTime()
        ];

        $result = DB::table(env("DB_USERS"))
            ->where('id', $id)
            ->update($data);

        if (!$result) return back()->with('error', 'Unable to update User details or no changes!');
        return back()->with('message', 'Done!');
    }

    public function delete($id) {
        $user = User::all()->find($id)->delete();
        if (!$user) return back()->with('error', 'Unable to delete User!');
        return redirect(route('dashboard.users'))->with('message', 'User deleted!');
    }

}
