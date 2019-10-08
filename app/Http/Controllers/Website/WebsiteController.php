<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Reporter\ErrorReporter;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\{DB, Mail, Validator};

class WebsiteController extends Controller
{

    public function getErrorReporter(): ErrorReporter {
        return new ErrorReporter();
    }

    public function update(Request $request) {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'philosophy' => 'required',
            'about-us' => 'required',
            'dsc_apu' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed request');

        $result = DB::table(env('DB_WEBSITE'))
            ->where('id', '1')
            ->update([
                'title' => trim($request->input('title')),
                'philosophy' => trim($request->input('philosophy')),
                'keyword' => trim($request->input('keyword')) == "" ? null : trim($request->input('keyword')),
                'about_us' => trim($request->input('about-us')),
                'dsc_apu' => trim($request->input('dsc_apu')),
                'announcement' => trim($request->input('announcement')) == "" ? null : trim($request->input('announcement')),
                'updated_at' => new \DateTime()
            ]);

        return $result
            ? back()->with('message', 'Website data has been updated')
            : back()->with('error', 'Unable to update Website Data!');
    }

    public function inquire(Request $request) {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if (!$validate) return back()->with('alert', 'Oops! Please check your Contact Form fields');

        try {
            Mail::send('layouts.email.index', ['data' => $request->input()], function (Message $message) {
                $message->to('studentdevelopersociety@gmail.com')->cc('igadget28@gmail.com');
                $message->from('system@rtgnetworks.com', 'CMS');
                $message->subject('[Contact Form @ CMS]');
            });
        } catch (\Exception $exception) {
            $this->getErrorReporter()->reportToDiscord('Email', \Illuminate\Support\Facades\Request::url(), "[{timestamp}] Stack: {$exception->getMessage()}");
            return back()->with('alert', 'Unable to send your Inquiry right now. Internal Error');
        }

        return back()->with('alert', "Done! We will get back to you soon!");
    }

}
