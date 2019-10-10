<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Reporter\ErrorReporter;
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
            'tp' => 'required|regex:/[tpTP0-9]{6}/',
            'intake' => 'required|regex:/[ucUC]{2}/',
            'gender' => 'required',
            'skills' => 'required',
            'check' => 'required'
        ]);

        if ($validator->fails()) return back()->with('error', 'Malformed Request! Please try again!');

        if (count(Member::all()->where('email', strtolower($request->input('email')))) > 0) {
            return back()->with('alert', 'You are already an APU SDS Member! :D');
        }

        $email = trim(strtolower($request->input('email')));
        $name = trim(strtoupper($request->input('name')));

        $result = DB::table('members')
            ->insert([
                'email' => $email,
                'name' => $name,
                'mobile' => trim($request->input('mobile')),
                'student_id' => trim($request->input('tp')),
                'intake' => trim($request->input('intake')),
                'gender' => $request->input('gender'),
                'skills' => implode(", ", $request->input('skills')),
                'found_us' => $this->data[trim($request->input('check'))],
                'created_at' => new \DateTime()
            ]);

        try {
            Mail::to($email)
                ->send(new NewSignup($name));
        } catch (\Exception $exception) {
            $this->getErrorReporter()->reportToDiscord('Member Email', \Illuminate\Support\Facades\Request::url(), "[{timestamp}] Stack: {$exception->getMessage()}");
            return back()->with('alert', 'We were unable to send you a Welcome Email! We have traced back this Error.');
        }

        if ($result) return back()->with('alert', 'Done! We have sent you a welcome email. (If you cannot find it, try checking your Spam or Junk folder.)');

        // Else
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

        $result = DB::table(env('DB_MEMBER'))
            ->where('id', $id)
            ->update([
                'email' => $email,
                'name' => $name,
                'mobile' => trim($request->input('mobile')),
                'student_id' => trim($request->input('tp')),
                'intake' => trim($request->input('intake')),
                'gender' => $request->input('gender'),
                'skills' => implode(", ", $request->input('skills')),
                'found_us' => $this->data[trim($request->input('check'))],
                'created_at' => new \DateTime()
            ]);

        if ($result) return back()->with('message', 'Done! Member details has been updated.');

        // Report
        $this->getErrorReporter()->reportToDiscord('Member', \Illuminate\Support\Facades\Request::url(), "[{timestamp}] Stack: Member update failure @ {$request->input('email')}");
        return back()->with('error', 'Unable to update Member details!');
    }

    public function deleteMember($id) {
        try {
            DB::table(env('DB_MEMBER'))
                ->where('id', $id)
                ->delete();

            return redirect(route('dashboard.members'))->with('message', 'Done! Member has been deleted.');
        } catch (\Exception $exception) {
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
