<?php

namespace App\Http\Controllers\API;

use GuzzleHttp\Client;
use App\Http\Controllers\Controller;

class CASController extends Controller
{

    private $casUrl = 'https://cas.apiit.edu.my';
    private $casTGT = '';

    private function getHttp(): Client {
        return new Client();
    }

    public function getTGT(string $username, string $password) {
        if (!$username || !$password) return response()->json([
           'message' => 'Invalid Username or Password. Try again.'
        ]);

        try {
            $response = $this->getHttp()->request('POST', $this->casUrl . '/cas/v1/tickets', [
                'headers' => [
                    'Content-type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => [
                    'username' => strtoupper($username),
                    'password' => $password
                ]
            ]);
        } catch (\Exception $exception) {
            return response()->json([
               'message' => 'CAS Handshake failed'
            ]);
        }

        $this->casTGT = str_replace('https://cas.apiit.edu.my/cas/v1/tickets/', '', $response->getHeader('Location')[0]);
        return $this->casTGT;
    }



}
