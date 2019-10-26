<?php

namespace App\Http\Controllers\Meetup;

use App\{Meetup, Http\Controllers\Controller, ActiveMeetup};
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{DB, Validator};

class MeetupController extends Controller
{
    public function register(Request $request) {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'event_start' => 'required',
            'event_end' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed Request!');

        $result = new Meetup;
        $result->title = trim($request->input('title'));
        $result->description = trim($request->input('description'));
        $result->event_start = Carbon::make($request->input('event_start'))->format('Y-m-d H:i:s');
        $result->event_end = Carbon::make($request->input('event_end'))->format('Y-m-d H:i:s');
        $result->location = trim($request->input('location'));
        $result->save();

        if ($request->input('isActive')) {

            if (ActiveMeetup::first()) {
                ActiveMeetup::first()->update(['event_id' => $result->id]);

            }else{
                $new_active = new ActiveMeetup;
                $new_active->event_id = $result->id;
                $new_active->save();
            }

        }


        return $result
            ? redirect(route('dashboard.meetups'))->with('message', 'Done! Meetup created! ')
            : back()->with('error', 'Unable to create Meetup');
    }

    public function update(Request $request, $id) {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'event_start' => 'required',
            'event_end' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed POST, please check your Input.');

        $result = Meetup::find($id);
        $result->title = trim($request->input('title'));
        $result->description = trim($request->input('description'));
        $result->event_start = Carbon::make($request->input('event_start'))->format('Y-m-d H:i:s');
        $result->event_end = Carbon::make($request->input('event_end'))->format('Y-m-d H:i:s');
        $result->location = trim($request->input('location'));
        $result->save();

        if ($request->input('isActive')) {
            if (ActiveMeetup::first()) {
                ActiveMeetup::first()->update(['event_id' => $id]);

            }else{
                $new_active = new ActiveMeetup;
                $new_active->event_id = $id;
                $new_active->save();
            }
        }

        return $result
            ? back()->with('message', 'Done! Meetup updated')
            : back()->with('error', 'Unable to update Meetup');
    }

    public function delete($id) {
        $result = Meetup::find($id);
        if (!$result) return view('errors.500');

        try {
            $result->delete();
            return redirect(route('dashboard.meetups'))->with('message', 'Done! Meetup deleted!');
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to delete Meetup!');
        }
    }

    public function deactivate() {
        $result = ActiveMeetup::first();
        if (!$result) return view('errors.404');

        try {
            $result->delete();
            return redirect(route('dashboard.meetups'))->with('message', 'Done! Meetup no longer active!');
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to deactivate Meetup!');
        }

    }
}
