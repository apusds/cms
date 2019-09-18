<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

}
