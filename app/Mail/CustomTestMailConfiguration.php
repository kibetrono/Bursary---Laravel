<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomTestMailConfiguration extends Mailable
{
    use Queueable, SerializesModels;

    public $the_host;
    public $the_port;
    public $the_username;
    public $the_password;
    public $the_encryption;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($the_host, $the_port, $the_username, $the_password, $the_encryption, $url)
    {
        $this->the_host = $the_host;
        $this->the_port = $the_port;
        $this->the_username = $the_username;
        $this->the_password = $the_password;
        $this->the_encryption = $the_encryption;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('admin.customEmail.test-configuration', ['host' => $this->the_host, 'port' => $this->the_port, 'username' => $this->the_username, 'pwd' => $this->the_password, 'encryption' => $this->the_encryption, 'url' => $this->url])->subject("SMTP Configuration Settings");
    }
}
