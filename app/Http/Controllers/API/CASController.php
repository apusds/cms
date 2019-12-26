<?php

namespace App\Http\Controllers\API;

use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CASController extends Controller
{

    private $casUrl = 'https://cas.apiit.edu.my';
    private $casST = '';
    private $casData;

    private function getHttp(): Client {
        return new Client();
    }

   public function getStudentProfile(Request $request) {
        try {
            $baseUrl = \Illuminate\Support\Facades\Request::root();
            if (!$request->get('ticket')) return redirect($this->casUrl . "/cas/login?service=$baseUrl/api/cas/auth");
            $this->casST = $request->get('ticket');

            $response = $this->getHttp()->request('GET', $this->casUrl . "/cas/p3/serviceValidate?service=$baseUrl/api/cas/auth&ticket={$this->casST}&format=json", [
                'headers' => [
                    'Content-type' => 'application/x-www-form-urlencoded'
                ]
            ]);

            $this->casData = json_decode($response->getBody()->getContents());

            return redirect(route('member.dashboard'))->with([
                'ticket', $this->casST,
                'data' => $this->casData->serviceResponse->authenticationSuccess
            ]);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'CAS Authentication Failed']);
        }
   }
}
