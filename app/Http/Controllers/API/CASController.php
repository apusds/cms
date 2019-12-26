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

   public function getStudentProfile(Request $request) {
        $baseUrl = \Illuminate\Support\Facades\Request::root();
        if (!$request->get('ticket')) return redirect($this->casUrl . "/cas/login?service=$baseUrl/api/cas/auth");
        $this->casST = $request->get('ticket');
        $response = $this->getHttp()->request('GET', $this->casUrl . "/cas/p3/serviceValidate?service=$baseUrl/api/cas/auth&ticket={$this->casST}");
        dd($response->getBody()->getContents());
        return redirect(route('member.dashboard'))->with('ticket', $this->casST);
   }
}
