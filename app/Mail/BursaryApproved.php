<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BursaryApproved extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $currentYear;
    public $institution;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$currentYear,$institution)
    {
        $this->user = $user;
        $this->currentYear = $currentYear;
        $this->institution = $institution;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->markdown('admin.customEmail.bursary-approved',['user' => $this->user,'year'=>$this->currentYear,'institution'=>$this->institution])->subject('Bursary Status');

    }
}
