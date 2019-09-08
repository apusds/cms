<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ Auth, DB, Validator };

class TemplateController extends Controller
{

    public function create(Request $request) {
       $validate = Validator::make($request->all(), [
          'title' => 'required',
          'template' => 'required'
       ]);

       if (!$validate) return back()->with('error', 'Malformed Request.');

       $result = DB::table(env('DB_TEMPLATES'))
           ->insert([
                'created_by' => Auth::user()->id,
                'title' => trim($request->input('title')),
                'template' => trim($request->input('template'))
           ]);

       return $result ? back()->with('message', 'Done! Template registered.') : back()->with('error', 'Oops! Unable to register the template rn!');
    }

    public function update(Request $request, $id) {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'template' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed Request.');

        $result = DB::table(env('DB_TEMPLATES'))
            ->where('id', $id)
            ->update([
                'title' => trim($request->input('title')),
                'template' => trim($request->input('template'))
            ]);

        return $result ? back()->with('message', 'Done! Template updated.') : back()->with('error', 'Oops! Unable to update the template rn!');
    }

    public function delete($id) {
        $result = DB::table(env('DB_TEMPLATES'))
            ->where('id', $id)
            ->delete();

        return $result ? back()->with('message', 'Done! Template deleted.') : back()->with('error', 'Oops! Unable to delete the template rn!');
    }

}
