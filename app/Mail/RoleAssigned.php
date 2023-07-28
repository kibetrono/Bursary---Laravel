<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RoleAssigned extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $role;
    public $url;

    public function __construct($name,$role,$url)
    {
        $this->name = $name;
        $this->role = $role;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('admin.customEmail.role-assigned',['name' => $this->name,'role' => $this->role,'url' => $this->url])->subject('Congratulations');

    }
}
