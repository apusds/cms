<?php

namespace App\Http\Controllers\MeetupAttendee;

use App\{MeetupAttendee, Http\Controllers\Controller, ActiveMeetup};
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{DB, Validator};

class MeetupAttendeeController extends Controller
{
    public function checkin (Request $request) {
        $validate = Validator::make($request->all(), [
            'student_id' => 'required',
        ]);

        if (!$validate) return back()->with('error', 'Malformed Request!');

        $meetup_title = ActiveMeetup::first()->meetup->title;
        $student_id = trim($request->input('student_id'));

        if (!$meetup_title) return back()->with('error', 'No active meetups now');

        if(count(MeetupAttendee::where('student_id', '=', $student_id)->where('meetup_title', '=', $meetup_title)->get()) > 0) {

            return back()->with('message', 'You have already been checked-in for this event!');
        }

        try {
            $result = DB::table(env('DB_MEETUP_ATTENDEES'))
                ->insert([
                    'student_id' => strtoupper($student_id),
                    'meetup_title' => $meetup_title,
                    'joined_at' => new \DateTime()
                ]);
        } catch (\Exception $e) {
            return back()->with('error', 'TP Number not found. If you are not a member, why not join SDS today!');
        }

        return $result
            ? back()->with('message', 'Done! You have been checked-in! ')
            : back()->with('error', 'Unable to check in');
    }
}
