<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Reporter\ErrorReporter;
use App\Jobs\SendEmail;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\NewSignup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{

    private $data = [
        '0' => 'Facebook',
        '1' => 'Heard from Friend',
        '2' => 'Attended our Event/Workshop',
    ];

    public function getErrorReporter(): ErrorReporter {
        return new ErrorReporter();
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
            'mobile' => 'required',
            'tp' => 'required|regex:/[TP0-9]{6}/',
            'intake' => ['required', 'regex:/(^UC)|(^APU)|(^APT)|(^AFC)/'],
            'gender' => 'required',
            'skills' => 'required',
            'check' => 'required'
        ]);

        if ($validator->fails()) return back()->with('error', 'Malformed Request! Please try again!');

        if (
            count(Member::all()->where('email', strtolower($request->input('email')))) > 0
            || count(Member::all()->where('student_id', strtoupper($request->input('tp')))) > 0
        ) {
            return back()->with('alert', 'You are already an APU SDS Member! :D');
        }

        $email = trim(strtolower($request->input('email')));
        $name = trim(strtoupper($request->input('name')));
        $tp = trim(strtoupper($request->input('tp')));

        $result = new Member;
        $result->email = $email;
        $result->name = $name;
        $result->mobile = trim($request->input('mobile'));
        $result->student_id = $tp;
        $result->intake = trim($request->input('intake'));
        $result->gender = trim($request->input('gender'));
        $result->skills = implode(", ", $request->input('skills'));
        $result->found_us = $this->data[trim($request->input('check'))];
        $result->save();

        SendEmail::dispatch($email, new NewSignup($name));

        if ($result) return back()->with('alert', 'Done! We have sent you a welcome email. (If you cannot find it, try checking your Spam or Junk folder.)');

        // Report and redirect
        $this->getErrorReporter()->reportToDiscord('Member', \Illuminate\Support\Facades\Request::url(), "[{timestamp}] Stack: Sign-up failure @ {$request->input('email')}");
        return back()->with('alert', 'Unable to submit your Form');
    }

    public function updateMember(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
            'mobile' => 'required',
            'tp' => 'required|regex:/[tpTP0-9]{6}/',
            'intake' => 'required|regex:/[ucUC]{2}/',
            'gender' => 'required',
            'skills' => 'required',
            'check' => 'required'
        ]);

        if ($validator->fails()) return back()->with('error', 'Required tags MUST be filled!');

        $email = trim(strtolower($request->input('email')));
        $name = trim(strtoupper($request->input('name')));

        $result = Member::all()->find($id);
        $result->email = $email;
        $result->name = $name;
        $result->password = Hash::make(trim($request->input('password')));
        $result->mobile = trim($request->input('mobile'));
        $result->student_id = trim($request->input('tp'));
        $result->intake = trim($request->input('intake'));
        $result->gender = trim($request->input('gender'));
        $result->skills = implode(", ", $request->input('skills'));
        $result->found_us = $this->data[trim($request->input('check'))];
        $result->update();

        if ($result) return back()->with('message', 'Done! Member details has been updated.');

        // Report and redirect
        $this->getErrorReporter()->reportToDiscord('Member', \Illuminate\Support\Facades\Request::url(), "[{timestamp}] Stack: Member update failure @ {$request->input('email')}");
        return back()->with('error', 'Unable to update Member details!');
    }

    public function deleteMember($id) {
        try {
            if (!(Member::all()->find($id))) return redirect(route('dashboard.members'))->with('error', 'Oops! Member does not exist!');
            Member::all()->find($id)->delete();

            return redirect(route('dashboard.members'))->with('message', 'Done! Member has been deleted.');
        } catch (\Exception $exception) {
            // Report and redirect
            $this->getErrorReporter()->reportToDiscord('Member', \Illuminate\Support\Facades\Request::url(), "[{timestamp}] Stack: Member deletion failed");
            return back()->with('error', 'An unknown error has occurred. This has been reported to the Admins.');
        }
    }

    public function joinedToday() {
        $result = DB::table(env('DB_MEMBER'))
            ->where(DB::raw('DATE(created_at)'), '=', date('y-m-d'))
            ->get();

        return $result;
    }

    public function totalPerDate() {
        $result = DB::table(env('DB_MEMBER'))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as joined'))
            ->groupBy('date')
            ->get();

        return $result;
    }

    public function exportAsCSV() {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; filename=members.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];

        $list = Member::all()->toArray();

        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));

        $callback = function() use ($list)
        {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return Response::stream($callback, 200, $headers);
    }
}
