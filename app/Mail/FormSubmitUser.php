<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormSubmitUser extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->subject('New request for quote');
        $this->title = 'New request for quote';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.formSubmitUser');
    }
    
}
