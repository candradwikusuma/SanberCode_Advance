<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class CodeOtpMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user, $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,$message)
    {
        $this->user=$user;
        $this->message=$message;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.otp')->with([
            'user'=>$this->user,
            'message'=>$this->message
        ]);
    }
}
