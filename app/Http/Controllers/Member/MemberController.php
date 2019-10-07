<?php

namespace App\Http\Controllers\Member;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\NewSignup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

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
            'gender' => 'required',
            'skills' => 'required',
            'check' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed Request!');

        if (count(Member::all()->where('email', strtolower($request->input('email')))) > 0) {
            return back()->with('alert', 'You are already an APU SDS Member! :D');
        }

        $result = DB::table('members')
            ->insert([
                'email' => trim(strtolower($request->input('email'))),
                'name' => trim(strtoupper($request->input('name'))),
                'mobile' => trim($request->input('mobile')),
                'student_id' => trim($request->input('tp')),
                'intake' => trim($request->input('intake')),
                'gender' => $request->input('gender'),
                'skills' => implode(", ", $request->input('skills')),
                'found_us' => $data[trim($request->input('check'))],
                'created_at' => new \DateTime()
            ]);

        Mail::to(trim(strtolower($request->input('email'))))
            ->send(new NewSignup(trim(strtoupper($request->input('name')))));

        return $result
            ? back()->with('alert', 'Done! You will hear from us very soon :)')
            : back()->with('alert', 'Unable to submit your Form');
    }

    public function joinedToday() {
        $result = DB::table(env('DB_MEMBER'))
            ->where(DB::raw('DATE(created_at)'), '=', date('y-m-d'))
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
