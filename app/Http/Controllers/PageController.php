<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    public function create(Request $request) {
        dd($request->input());
    }

}
