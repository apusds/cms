<?php

namespace App\Http\Controllers\Reporter;

use Carbon\Carbon;
use App\Http\Controllers\Controller;

class ErrorReporter extends Controller
{

    public function reportToDiscord(string $type, string $where, string $info) {
        /*
         *
         * [
         *  type => "",
         *  where => "",
         *  info => ""
         * ]
         *
         */

        if (env('DISCORD_WEBHOOK') !== "") {
            $object = json_encode([
                "username" => "CMS Reporter",
                "avatar_url" => "https://cdn.discordapp.com/avatars/627136671590121472/6ce0bc0789149c7f6c4307e9f03a7b13.png?size=128",
                "tts" => false,
                "embeds" => [
                    [
                        "color" => hexdec("FF0000"),
                        "title" => "Emit: " . strtoupper($type),
                        "type" => "rich",
                        "description" => str_replace("{timestamp}", Carbon::now()->toDateTimeString(), $info),
                        "footer" => [
                            "text" => $where
                        ]
                    ]
                ]
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, env('DISCORD_WEBHOOK'));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $object);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_exec($ch);
            curl_close($ch); // Release Memory (Prevent leakage)
        }
    }

}
