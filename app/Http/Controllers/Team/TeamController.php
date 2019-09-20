<?php

namespace App\Http\Controllers\Team;

use App\Committee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, File, Validator};

class TeamController extends Controller
{

    public function addToTeam(Request $request) {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'role' => 'required',
            'file' => 'image|required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed Request');

        if (!$request->hasFile('file')) return back()->with('error', 'Malformed Request!');

        $fileNameWithExt = $request->file('file')->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $ext = $request->file('file')->getClientOriginalExtension();
        $fileNameToStore = $fileName . '_' . time() . '.' . $ext;

        // Finally store them
        $request->file('file')->storeAs('public/committee', $fileNameToStore);

        // Now to the DB
        $result = DB::table(env('DB_TEAM'))
            ->insert([
                'name' => trim($request->input('name')),
                'role' => trim($request->input('role')),
                'file' => $fileNameToStore,
                'facebook' => trim($request->input('facebook')) == "" ? null : trim($request->input('facebook')),
                'twitter' => trim($request->input('twitter')) == "" ? null : trim($request->input('twitter')),
                'linkedln' => trim($request->input('linkedln')) == "" ? null : trim($request->input('linkedln'))
            ]);

        return $result
            ? back()->with('message', 'Done! Committee Member has been added')
            : back()->with('error', 'Unable to add Committee Member');
    }

    public function removeFromTeams($id) {
        $result = Committee::all()->find($id);
        if (!$result) return view('errors.500');

        $path = $result->file;
        File::delete(env('PUBLIC_PATH') . '/committee/' . $path);

        try {
            $result->delete();
            return back()->with('message', 'Done! Image deleted from Teams');
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to delete Image from Gallery');
        }
    }

    public function update(Request $request, $id) {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'role' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'linkedln' => 'required',
        ]);

        if (!$validate) return back()->with('error', 'Malformed Request');

        $result = DB::table(env('DB_TEAM'))
            ->where('id', $id)
            ->update([
                'name' => trim($request->input('name')),
                'role' => trim($request->input('role')),
                'facebook' => trim($request->input('facebook')) == "" ? null : trim($request->input('facebook')),
                'twitter' => trim($request->input('twitter')) == "" ? null : trim($request->input('twitter')),
                'linkedln' => trim($request->input('linkedln')) == "" ? null : trim($request->input('linkedln'))
            ]);

        return $result
            ? back()->with('message', 'Done! Committee Member has been updated')
            : back()->with('error', 'Unable to update Committee Member\' details!');
    }

}
