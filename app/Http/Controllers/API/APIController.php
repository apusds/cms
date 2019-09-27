<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{

    public function checkURI(Request $request) {
        $result = DB::table(env('DB_PAGES'))
            ->select('id')
            ->where('uri', strtolower(trim($request->input('uri'))))
            ->first();

        return !$result ? response()->json(['status' => 'OK']) : response()->json(['status' => '-1']);
    }

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
