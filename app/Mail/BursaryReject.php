<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BursaryReject extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $currentYear;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$currentYear)
    {
        $this->user = $user;
        $this->currentYear = $currentYear;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('admin.customEmail.bursary-reject',['user' => $this->user,'year'=>$this->currentYear])->subject('Bursary Status');

    }
}
