<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{ Auth, DB, Validator };

class EventController extends Controller
{

    public function register(Request $request) {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'expiry' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed Request, check your parameters.');

        $data = [
            'created_by' => Auth::user()->id,
            'title' => trim($request->input('title')),
            'image' => $request->input('image') === null ? null : $request->input('image'),
            'description' => trim($request->input('description')),
            'expiry' => Carbon::parse($request->input('expiry'))->format('Y-m-d H:i:s'),
            'created_at' => new \DateTime()
        ];

        $result = DB::table(env("DB_EVENTS"))
            ->insert($data);

        if (!$result) return back()->with('error', 'Unable to create new Event.');
        return redirect(route('dashboard.events'))->with('message', 'Successfully created the Event.');
    }

    public function update(Request $request, $id) {
        $validate = Validator::make($request->all(), [
            'title' => 'required|text',
            'description' => 'required',
            'expiry' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed POST, please check your Input.');

        $data = [
            'title' => trim($request->input('title')),
            'description' => trim($request->input('description')),
            'image' => $request->input('image') === null ? null : $request->input('image'),
            'expiry' => Carbon::parse($request->input('expiry'))->format('Y-m-d H:i:s'),
            'updated_at' => new \DateTime(),
        ];

        $result = DB::table(env("DB_EVENTS"))
            ->where('id', $id)
            ->update($data);

        if (!$result) return back()->with('error', 'Unable to update this Event.');
        return redirect(route('dashboard.events'))->with('message', 'Successfully updated the Event.');
    }

    public function delete($id) {
        $event = \App\Event::all()->find($id)->delete();
        if (!$event) return back()->with('error', 'Unable to Event!');
        return redirect(route('dashboard.events'))->with('message', 'Event deleted!');
    }

}
