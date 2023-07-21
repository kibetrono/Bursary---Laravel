<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomTestMailConfiguration extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $body;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject,$body,$url)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->url = $url;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('admin.customEmail.test-configuration')->subject($this->subject);

    }
}
