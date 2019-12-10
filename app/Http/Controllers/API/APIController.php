<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Reporter\ErrorReporter;
use App\Jobs\SendEmail;
use App\Mail\Emailer;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class APIController extends Controller
{

    public function getErrorReporter(): ErrorReporter {
        return new ErrorReporter();
    }

    public function checkURI(Request $request) {
        $result = DB::table(env('DB_PAGES'))
            ->select('id')
            ->where('uri', strtolower(trim($request->input('uri'))))
            ->first();

        return !$result ? response()->json(['status' => 'OK']) : response()->json(['status' => '-1']);
    }

    public function verify($email) {
        $member = Member::all()->where('email', $email)->first();
        if ($member == null)  {
            return response()->json([
                'status' => 'OK',
                'valid' => 'false',
                'message' => "{$email} is not a valid Member."
            ]);
        }

        return response()->json([
            'status' => 'OK',
            'valid' => 'true',
            'name' => $member->name
        ]);
    }

    public function massSendEmail(Request $request) {
        try {
            foreach (Member::all() as $member) {
                SendEmail::dispatch($member->email, new Emailer($request->input('title'), $request->input('body')));
            }

            return redirect(route('dashboard.emailer'))->with('message', 'Done!');
        } catch (\Exception $exception) {
            $this->getErrorReporter()->reportToDiscord('Email', \Illuminate\Support\Facades\Request::url(), "[{timestamp}] Stack: {$exception->getMessage()}");
            return back()->with('alert', 'Unable to send your Emails right now. Internal Error');
        }
    }

}
