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

    public function __construct(String $name)
    {
        $this->name = $name;
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
                'name' =>$this->name
            ]);
    }
}
