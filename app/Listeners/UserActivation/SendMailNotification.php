<?php

namespace App\Listeners\UserActivation;

use App\Events\UserActivation;
use App\Mail\ActivationUserAccount;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendMailNotification implements ShouldQueue
{
	use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserActivation  $event
     * @return void
     */
    public function handle(UserActivation $event)
    {
//	    $this->user = $user;
	    //in the UserActivation event we set value $event->user so we can use it here
        /*
        Mail::to($event->user)->send(new ActivationUserAccount($event->user , $event->activationCode));
        */
    }
}
