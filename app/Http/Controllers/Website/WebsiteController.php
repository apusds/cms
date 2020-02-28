<?php

namespace App\Http\Controllers\Website;

use App\Mail\InquiryMail;
use App\Website;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{

    public function update(Request $request) {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'philosophy' => 'required',
            'about-us' => 'required',
            'dsc_apu' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed request');

        $result = Website::all()->find(1);
        $result->title = trim($request->input('title'));
        $result->philosophy = trim($request->input('philosophy'));
        $result->keyword = trim($request->input('keyword')) == "" ? null : trim($request->input('keyword'));
        $result->about_us = trim($request->input('about-us'));
        $result->dsc_apu = trim($request->input('dsc_apu'));
        $result->announcement = trim($request->input('announcement')) == "" ? null : trim($request->input('announcement'));
        $result->update();

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
            Mail::to("studentdevelopersociety@gmail.com")
                ->send(new InquiryMail($request->input()));
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return back()->with('alert', 'Unable to send your Inquiry right now. Internal Error');
        }

        return back()->with('alert', "Done! We will get back to you soon!");
    }

}
