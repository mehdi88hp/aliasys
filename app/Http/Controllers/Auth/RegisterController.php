<?php

namespace App\Http\Controllers\Auth;

//use App\Events\UserActivation;
use App\Events\UserActivation;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware( 'guest' );
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array $data
	 *
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator( array $data ) {
		return Validator::make( $data, [
			'name'                 => 'required|string|max:255',
			'email'                => 'required|string|email|max:255|unique:users',
			'password'             => 'required|string|min:6|confirmed',
//			'g-recaptcha-response' => 'recaptcha'
		] );
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array $data
	 *
	 * @return User
	 */
	protected function create( array $data ) {
		return User::create( [
			'name'     => $data['name'],
			'email'    => $data['email'],
			'password' => bcrypt( $data['password'] ),
			'api_token'=> Str::random(60),
            'active'=>1,
		] );
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function register( Request $request ) {
//    	return $request->all();
		$this->validator( $request->all() )->validate();

		event( new Registered( $user = $this->create( $request->all() ) ) ); //it's default

		event( new UserActivation( $user ) );
//        Session::flash( 'message', 'ایمیل تایید برای شما فرستاده شد بعد از تایید می توانید وارد حساب کاربری خود شوید.' );
        Session::flash( 'message', ' می توانید وارد حساب کاربری خود شوید.' );

		return $this->registered( $request, $user )
			?: redirect( $this->redirectPath() );
	}
	public function showRegistrationForm(  ) {
		return view('register');
	}
}
