<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function updateAdminProfile(Request $request) {
        dd($request->input());
    }

}
