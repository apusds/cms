<?php

namespace App\Http\Controllers\Team;

use App\Committee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{

    public function addToTeam(Request $request) {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'role' => 'required',
            'email' => 'required',
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
        $result = new Committee;
        $result->name = trim($request->input('name'));
        $result->role = trim($request->input('role'));
        $result->email = trim($request->input('email'));
        $result->file = $fileNameToStore;
        $result->facebook = trim($request->input('facebook')) == "" ? null : trim($request->input('facebook'));
        $result->instagram = trim($request->input('instagram')) == "" ? null : trim($request->input('instagram'));
        $result->linkedln = trim($request->input('linkedln')) == "" ? null : trim($request->input('linkedln'));
        $result->save();

        return $result
            ? back()->with('message', 'Done! Committee Member has been added')
            : back()->with('error', 'Unable to add Committee Member');
    }

    public function removeFromTeams($id) {
        $result = Committee::all()->find($id);
        if (!$result) return view('errors.500');

        $path = $result->file;
        File::delete(asset('storage' . '/committee/' . $path));

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
            'role' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed Request');

        $result = Committee::all()->find($id);
        $result->name = trim($request->input('name'));
        $result->email = trim($request->input('email'));
        $result->role = trim($request->input('role'));
        $result->isActive = trim($request->input('isActive'));
        $result->summary = trim($request->input('summary'));
        $result->facebook = trim($request->input('facebook')) == "" ? null : trim($request->input('facebook'));
        $result->instagram = trim($request->input('instagram')) == "" ? null : trim($request->input('instagram'));
        $result->linkedln = trim($request->input('linkedln')) == "" ? null : trim($request->input('linkedln'));
        $result->update();

        return $result
            ? back()->with('message', 'Done! Committee Member has been updated')
            : back()->with('error', 'Unable to update Committee Member\' details!');
    }

}
