<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Trying to spoof the System? ;P');
        }

        $data = [
            'username' => trim(strtolower($request->input('username'))),
            'password' => trim($request->input('password'))
        ];

        if (!Auth::attempt($data)) return back()->with('error', 'Invalid Credentials!');

        return "Logged in!";
    }

}
