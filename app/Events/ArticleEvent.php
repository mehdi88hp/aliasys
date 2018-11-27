<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticleEvent implements ShouldBroadcast {
	use Dispatchable, InteractsWithSockets, SerializesModels;
	public $user;
	public $msg;

	/**
	 * Create a new event instance.
	 *
	 * @param User $user
	 */
	public function __construct( $msg ) {
//	public function __construct( $user ) {
		$this->msg = $msg;
	}

	/**
	 * Get the channels the event should broadcast on.
	 *
	 * @return \Illuminate\Broadcasting\Channel|array
	 */
	public function broadcastOn() {
		return new PrivateChannel( 'articles.admin' );
	}

//	public function broadcastWith(  ) {
//		return [
//			'message'=>'hiiiii',
//		];
//	}
}
