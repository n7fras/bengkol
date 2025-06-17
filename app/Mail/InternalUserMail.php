<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InternalUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($user,$password)
    {
        $this->user = $user;
        $this->password['password'] = $password;

    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Berikut informasi akun anda')
                    ->view('backend.V_Userinternal.email')
                    ->with(['user'=>$this->user,
                            'password'=>$this->password
                ]);
    }
}
