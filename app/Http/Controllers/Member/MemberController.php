<?php

namespace App\Http\Controllers\Member;

use App\Member;
use App\PasswordSession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

//            SendEmail::dispatch($email, new NewSignup($name, $token));
            return back()->with('alert', 'Done! We have sent you a welcome email. (If you cannot find it, try checking your Spam or Junk folder.)');
        } catch (\Exception $exception) {
            return back()->with('alert', 'Unable to register you as a Member');
        }
    }

    public function memberVerifyAccount(Request $request, $id) {
        // TODO Send SDS Email
//        SendEmail::dispatch($email, new NewSignup($name, $token));
        dd($id);
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
