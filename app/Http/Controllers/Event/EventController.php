<?php

namespace App\Http\Controllers\Event;

use App\Attendees;
use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class EventController extends Controller
{

    public function getActiveEvents() {
        $events = DB::table('events')
            ->select('id', 'title', 'organisation', 'identifier')
            ->where('organisation', 'sds')
            ->where('expiry', '>', Carbon::now()->toDateString())
            ->get();

        return $events;
    }

    public function getExpiredEvents() {
        $events = DB::table('events')
            ->select('id', 'title', 'organisation', 'identifier')
            ->where('expiry', '<=', Carbon::now()->toDateString())
            ->get();

        return $events;
    }

    public function getDSCEvents() {
        $events = DB::table('events')
            ->select('id', 'title', 'identifier')
            ->where('organisation', 'dsc')
            ->where('expiry', '>', Carbon::now()->toDateString())
            ->get();

        return $events;
    }

    public function register(Request $request) {
        $validate = Validator::make($request->all(), [
            'organisation' => 'required',
            'title' => 'required',
            'file' => 'required',
            'description' => 'required',
            'expiry' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed Request!');
        if (!$request->hasFile('file')) return back()->with('error', 'Malformed Request!');

        $fileNameWithExt = $request->file('file')->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $ext = $request->file('file')->getClientOriginalExtension();
        $fileNameToStore = $fileName . '_' . time() . '.' . $ext;

        // Finally store them
        $request->file('file')->storeAs('public/posters', $fileNameToStore);

        $result = new Event;
        $result->created_by = Auth::user()->id;
        $result->organisation = trim($request->input('organisation'));
        $result->title = trim($request->input('title'));
        $result->identifier = str_replace(' ', '-', trim(strtolower($request->input('title'))));
        $result->file = $fileNameToStore;
        $result->description = trim($request->input('description'));
        $result->attendance = trim($request->input('attendance')) == "" ? '0' : trim($request->input('attendance'));
        $result->expiry = Carbon::make($request->input('expiry'))->format('Y-m-d H:i:s');
        $result->save();

        return $result
            ? back()->with('message', 'Done! Event created')
            : back()->with('error', 'Unable to create Event');
    }

    public function update(Request $request, $id) {
        $validate = Validator::make($request->all(), [
            'organisation' => 'required',
            'title' => 'required|text',
            'description' => 'required',
            'expiry' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed POST, please check your Input.');

        $result = Event::all()->find($id);
        $result->organisation = trim($request->input('organisation'));
        $result->title = trim($request->input('title'));
        $result->identifier = str_replace(' ', '-', trim(strtolower($request->input('title'))));
        $result->description = trim($request->input('description'));
        $result->attendance = trim($request->input('attendance')) == "" ? '0' : trim($request->input('attendance'));
        $result->expiry = Carbon::make($request->input('expiry'))->format('Y-m-d H:i:s');
        $result->update();

        return $result
            ? back()->with('message', 'Done! Event updated')
            : back()->with('error', 'Unable to update Event');
    }

    public function delete($id) {
        $result = Event::all()->find($id);
        if (!$result) return view('errors.500');

        $path = $result->file;
        File::delete(env('PUBLIC_PATH') . '/posters/' . $path);

        try {
            $result->delete();
            return redirect(route('admin.dashboard.events'))->with('message', 'Done! Event deleted!');
        } catch (\Exception $e) {
            return redirect(route('admin.dashboard.events'))->with('error', 'Unable to delete Event!');
        }
    }

    public function signAttendance($id) {
        $result = Event::all()->find($id);
        if (!$result) return view('errors.500');

        try {
            $attendance = new Attendees;
            $attendance->student_id = Auth::user()->student_id;
            $attendance->event_title = $result->title;
            $attendance->save();

            return redirect(route('member.dashboard'))->with('message', 'Done! Attendance has been recorded.');
        } catch (Exception $exception) {
            return redirect(route('member.dashboard'))->with('error', "Couldn't sign you the attendance!");
        }
    }

}
