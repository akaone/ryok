<?php /** @noinspection LaravelFunctionsInspection */

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class SignupConfirm extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /** @var User */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->from(env("MAIL_NO_REPLY"))
            ->subject(__('emails.sign-up.subject'))
            ->markdown('emails.signup-confirm');
    }
}
