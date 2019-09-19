<?php

namespace App\Http\Controllers\Member;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{

    public function register(Request $request) {
        $data = [
          '0' => 'Facebook',
          '1' => 'Heard from Friend',
          '2' => 'Attended our Event/Workshop',
        ];

        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
            'mobile' => 'required',
            'tp' => 'required|regex:/[tpTP0-9]{6}/g',
            'intake' => 'required|regex:/[ucUC]{2}/g',
            'skills' => 'required',
            'check' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed Request!');

        if (Member::all()->where('email', trim(strtolower($request->input('email'))))) {
            return back()->with('alert', 'You already sent an Application. Please wait patiently :O');
        }

        $result = DB::table(env('DB_MEMBER'))
            ->insert([
                'email' => trim(strtolower($request->input('email'))),
                'name' => trim(strtoupper($request->input('name'))),
                'mobile' => trim($request->input('mobile')),
                'student_id' => trim($request->input('mobile')),
                'intake' => trim($request->input('intake')),
                'skills' => implode(", ", $request->input('skills')),
                'found-us' => $data[trim($request->input('check'))],
                'created_at' => new \DateTime()
            ]);

        return $result
            ? back()->with('alert', 'Done! You will hear from us very soon :)')
            : back()->with('alert', 'Unable to submit your Form');
    }

}
