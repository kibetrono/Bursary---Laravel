<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuccessfullBursaryApplication extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $currentYear;

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
        return $this->markdown('admin.customEmail.bursary-successful-application',['user' => $this->user,'year'=>$this->currentYear])->subject('Congratulations');

    }
}
