<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller {

	public function sendGeneralMessage( Request $request ) {
		$user = Auth::user();

		if ( $request->method() === 'GET' ) {
			return view( 'send-general-message',
				compact( 'user' )
			);
		} else {
			$users = User::all();
			foreach ( $users as $v ) {
//				$user->
				Message::create( [
					'user_id'        => $v->id,
					'sender_user_id' => $user->id,//admin
					'subject'        => $request->subject,
					'content'        => $request->text,
				] );
			}
			Session::flash( 'message', 'با موفقیت ارسال شدند' );

			return back();
		}
	}
}
