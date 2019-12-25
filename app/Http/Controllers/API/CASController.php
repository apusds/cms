<?php

namespace App\Http\Controllers\API;

use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CASController extends Controller
{

    private $casUrl = 'https://cas.apiit.edu.my';
    private $casST = '';

    private function getHttp(): Client {
        return new Client();
    }

//    private function writeToDatabase() {
//        $exist = count(UserStorage::all()->where('email', '=', auth()->guard('member')->user()->email)) > 0;
//
//        if (!$exist) {
//            $storage = new UserStorage();
//            $user = Member::all()->where('email', auth()->guard('member')->user()->email)->first();
//            $storage->email = $user->email;
//            $storage->casST = $this->casST;
//            $storage->save();
//        } else {
//            $storage = UserStorage::all()->where('email', '=', auth()->guard('member')->user()->email)->first();
//            $user = Member::all()->where('email', auth()->guard('member')->user()->email)->first();
//            $storage->email = $user->email;
//            $storage->casST = $this->casST;
//            $storage->update();
//        }
//    }

   public function getStudentProfile(Request $request) {
        if (!$request->get('ticket')) return redirect($this->casUrl . '/cas/login?service=http://127.0.0.1:8000/api/cas/auth');
        $this->casST = $request->get('ticket');
        return redirect(route('member.dashboard'))->with('ticket', $this->casST);
   }
}
