<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateUserPoints extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $point;

	/**
	 * Create a new message instance.
	 *
	 * @param User $user
	 * @param $point
	 */
    public function __construct(User $user,$point)
    {
        $this->user = $user;
        $this->point = $point;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//dd($this->point,$this->user);
        return $this->subject('ALIASYS'.' افزایش امتیاز در باشگاه مشتریان ')
            ->markdown('emails.updateUserScore',['point'=>intval($this->point)]);
    }
}
