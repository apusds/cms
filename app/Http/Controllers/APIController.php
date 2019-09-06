<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{

    public function checkURI(Request $request) {
        $result = DB::table(env('DB_PAGES'))
            ->select('*')
            ->where('uri', strtolower(trim($request->input('uri'))))
            ->first();

        return !$result ? response()->json(['status' => 'OK']) : response()->json(['status' => '-1']);
    }

}
