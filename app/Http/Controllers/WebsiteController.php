<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{

    public function update(Request $request) {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'philosophy' => 'required',
            'about-us' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed request');

        $result = DB::table(env('DB_WEBSITE'))
            ->where('id', '1')
            ->update([
                'title' => trim($request->input('title')),
                'philosophy' => trim($request->input('philosophy')),
                'keyword' => trim($request->input('keyword')) == "" ? null : trim($request->input('keyword')),
                'about_us' => trim($request->input('about-us')),
                'updated_at' => new \DateTime()
            ]);

        return $result
            ? back()->with('message', 'Website data has been updated')
            : back()->with('error', 'Unable to update Website Data!');
    }

}
