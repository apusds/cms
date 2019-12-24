<?php

namespace App\Http\Controllers\API;

use App\Member;
use App\UserStorage;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;

class CASController extends Controller
{

    private $casUrl = 'https://cas.apiit.edu.my';
    private $casTGT = '';

    private function getHttp(): Client {
        return new Client();
    }

    private function writeToDatabase(array $data) {
        $exist = count(UserStorage::all()->where('email', '=', 'studentdevelopersociety@gmail.com')) > 0;

        if (!$exist) {
            $storage = new UserStorage();
            $user = Member::all()->where('email', 'studentdevelopersociety@gmail.com')->first();
            $storage->email = $user->email;
            $storage->student_id = $user->student_id;
            $storage->password = $data['password'];
            $storage->cas_tgt = $this->casTGT;
            $storage->save();
        } else {
            $storage = UserStorage::all()->where('email', '=', 'studentdevelopersociety@gmail.com')->first();
            $user = Member::all()->where('email', 'studentdevelopersociety@gmail.com')->first();
            $storage->email = $user->email;
            $storage->student_id = $user->student_id;
            $storage->password = $data['password'];
            $storage->cas_tgt = $this->casTGT;
            $storage->update();
        }
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

        $this->writeToDatabase([
            'password' => $password
        ]);

        return response()->json([
            'TGT' => $this->casTGT
        ]);
    }

}
