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
        return new Client(array(
            'curl'            => array( CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false),
            'allow_redirects' => false,
            'cookies'         => true,
            'verify'          => false
        ));
    }

   public function getStudentProfile(Request $request) {
        if (!$request->get('ticket')) return redirect($this->casUrl . "/cas/login?service=http://127.0.0.1:8000/api/cas/auth");
        $this->casST = $request->get('ticket');
        $response = $this->getHttp()->request("GET", "https://api.apiit.edu.my/student/profile?ticket={$this->casST}");
        dd($response);
        return redirect(route('member.dashboard'))->with('ticket', $this->casST);
   }
}
