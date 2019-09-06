<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    public function create(Request $request) {
        $validate = Validator::make($request->all(), [
           'name' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed submission, please try again!');

        $result = DB::table(env('DB_ROLES'))
            ->insert([
               'name' => trim($request->input('name')),
               'created_at' => new \DateTime()
            ]);

        return $result ? back()->with('message', 'Success! Role created.') : back()->with('error', 'Unable to create Role.');
    }

}
