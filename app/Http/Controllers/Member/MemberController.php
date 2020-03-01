<?php

namespace App\Http\Controllers\Member;

use App\Jobs\SendEmail;
use App\Mail\NewSignup;
use App\Mail\PasswordReminder;
use App\Member;
use App\PasswordSession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class MemberController extends Controller
{

    private $data = [
        '0' => 'Facebook',
        '1' => 'Heard from Friend',
        '2' => 'Attended our Event/Workshop',
    ];

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

        // Temp unique password set token (!)
        $token = substr(uniqid('', true), -5);

        try {
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

            $session = new PasswordSession;
            $session->email = $email;
            $session->token = $token;
            $session->save();

            SendEmail::dispatch($email, new NewSignup($name, $token));
            return back()->with('alert', 'Done! We have sent you a welcome email. (If you cannot find it, try checking your Spam or Junk folder.)');
        } catch (\Exception $exception) {
            return back()->with('alert', 'Unable to register you as a Member');
        }
    }

    public function memberVerifyAccount(Request $request, $token, $email) {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'confirm_password' => 'required'
        ]);

        if ($validator->fails()) return back()->with('error', 'Incorrect Password. Please try again!');
        if (strtolower($request->input('password')) !== strtolower($request->input('confirm_password'))) return back()->with('error', 'Incorrect Password. Please try again!');

        try {
            $result = Member::all()->where('email', $email)->first();
            $result->password = Hash::make(trim($request->input('password')));
            $result->update();

            $session = PasswordSession::all()->where('token', $token)->first();
            $session->delete();

            return redirect(route('member.login'))->with('message', 'Your password has been updated!');
        } catch (\Exception $exception) {
            return back()->with('error', 'Unable to update Member details!');
        }
    }

    public function sendEmailToInactiveAccounts() {
        $members = Member::all()->where('password', '=', null);

        if (count($members) < 1) return redirect(route('admin.dashboard.members'))->with('error', 'No one to send to!');

        try {
            foreach ($members as $member) {
                $token = substr(uniqid('', true), -5);

                $session = new PasswordSession;
                $session->email = $member->email;
                $session->token = $token;
                $session->save();

                SendEmail::dispatch($member->email, new PasswordReminder(strtoupper($member->name), $token));
            }

            return redirect(route('admin.dashboard.members'))->with('message', 'Done!');
        } catch (Exception $exception) {
            return back()->with('error', 'Unable to Mass send emails!');
        }
    }

    public function adminUpdateMember(Request $request, $id) {
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

        try {
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

            return back()->with('message', 'Done! Member details has been updated.');
        } catch (\Exception $exception) {
            return back()->with('error', 'Unable to update Member details!');
        }
    }

    public function adminDeleteMember($id) {
        try {
            if (!(Member::all()->find($id))) return redirect(route('dashboard.members'))->with('error', 'Oops! Member does not exist!');
            Member::all()->find($id)->delete();

            return redirect(route('admin.dashboard.members'))->with('message', 'Done! Member has been deleted.');
        } catch (\Exception $exception) {
            return back()->with('error', 'An unknown error has occurred. This has been reported to the Admins.');
        }
    }

    public function joinedToday() {
        $result = DB::table('members')
            ->where(DB::raw('DATE(created_at)'), '=', date('y-m-d'))
            ->get();

        return $result;
    }

    public function totalPerDate() {
        $result = DB::table('members')
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
