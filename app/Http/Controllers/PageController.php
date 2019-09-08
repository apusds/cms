<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ Auth, DB, Validator };

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

    public function update(Request $request, $id) {
        $validate = Validator::make($request->all(), [
            'uri' => 'required',
            'title' => 'required',
            'template' => 'required',
            'content' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed request!');

        $result = DB::table(env('DB_PAGES'))
            ->where('id', $id)
            ->update([
                'uri' => trim($request->input('uri')),
                'title' => trim($request->input('title')),
                'description' => trim($request->input('description')),
                'keyword' => trim($request->input('keyword')),
                'template_id' => $request->input('template'),
                'content' => $request->input('content'),
                'updated_at' => new \DateTime()
            ]);

        return $result ? back()->with('message', 'Done! Page updated.') : back()->with('error', 'Oops! Unable to update page.');
    }

    public function delete($id) {
        $result = DB::table(env('DB_PAGES'))
            ->where('id', $id)
            ->delete();

        return $result ? back()->with('message', 'Done! Page deleted.') : back()->with('error', 'Oops! Unable to delete page.');
    }

    public function serve($name) {
        if (count(Page::all()->where('uri', strtolower($name))) < 1) return view('errors.404');
        $page = DB::table(env('DB_PAGES'))
            ->where('uri', strtolower($name))
            ->first();

        // return with the data of $page
        dd($page);
    }

}
