<?php

namespace App\Events;

use App\ActivationCode;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserActivation {
	use Dispatchable, InteractsWithSockets, SerializesModels;


	public $user;
	public $activationCode;

	/**
	 * Create a new event instance.
	 *
	 * @param User $user
	 */
	public function __construct( User $user ) {
		$this->user = $user;

		//activationCode is the model we built and we want to process the operation in it
		$this->activationCode = ActivationCode::createCode( $user )->code;

		/* $this->activationCode = $user->activationCode()->create();
		 * the above one is the alternative way which activationCode() is the relationship(hasMany)
		 * */
	}

	/**
	 * Get the channels the event should broadcast on.
	 *
	 * @return Channel|array
	 */
	public function broadcastOn() {
		return new PrivateChannel( 'channel-name' );
	}
}
