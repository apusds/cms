<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Emailer extends Mailable
{
    use Queueable, SerializesModels;

    private $title, $body;

    public function __construct(String $title, $body)
    {
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("[APUSDS] {$this->title}")
            ->view('emails.emailer.index')
            ->with([
                'title' => $this->title,
                'body' => $this->body
            ]);
    }
}
