<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewSignup extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $token;

    public function __construct(String $name, String $token)
    {
        $this->name = $name;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to APUSDS')
            ->view('emails.members.signup')
            ->with([
                'name' => $this->name,
                'token' => $this->token
            ]);
    }
}
