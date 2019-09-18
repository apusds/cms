<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ Auth, DB, Hash, Validator };

class AuthController extends Controller
{

    public function login(Request $request) {}

    public function loginAdmin(Request $request) {
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

    public function updatePassword(Request $request) {
        $validate = Validator::make($request->all(), [
            'password' => 'required',
            'confirm' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed Request!');

        $password = trim(strtolower($request->input('password')));
        $confirm = trim(strtolower($request->input('confirm')));

        if ($password !== $confirm) return back()->with('error', 'Both your Password isn\' the same!');

        $result = DB::table(env('DB_USERS'))
            ->where('id', Auth::user()->id)
            ->update([
                'password' => Hash::make(trim($request->input('password')))
            ]);

        if ($result) {
            auth()->logout();
            return redirect(route('login'))->with('message', 'Please login with your new Password!');
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

}
