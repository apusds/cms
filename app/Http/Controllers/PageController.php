<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{

    public function create(Request $request) {
        $validate = Validator::make($request->all(), [
            'uri' => 'required',
            'title' => 'required',
            'template' => 'required',
            'content' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed request!');

        $result = DB::table(env('DB_PAGES'))
            ->insert([
                'uri' => trim($request->input('uri')),
                'created_by' => Auth::user()->id,
                'title' => trim($request->input('title')),
                'description' => trim($request->input('description')),
                'keyword' => trim($request->input('keyword')),
                'template_id' => $request->input('template'),
                'content' => $request->input('content'),
                'created_at' => new \DateTime()
            ]);

        return $result ? back()->with('message', 'Done! Page created.') : back()->with('error', 'Oops! Unable to create page.');
    }

}
