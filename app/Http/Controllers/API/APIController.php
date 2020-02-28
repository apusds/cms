<?php

namespace App\Http\Controllers\API;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class APIController extends Controller
{

    public function verify($email) {
        $member = Member::all()->where('email', $email)->first();
        if ($member == null)  {
            return response()->json([
                'status' => 'OK',
                'valid' => 'false',
                'message' => "{$email} is not a valid Member."
            ]);
        }

        return response()->json([
            'status' => 'OK',
            'valid' => 'true',
            'name' => $member->name
        ]);
    }

}
