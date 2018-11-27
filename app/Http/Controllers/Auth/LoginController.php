<?php namespace App\Http\Controllers\Auth;

use App\Events\UserActivation;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

//use App\Umeta;
//use Socialite;

class LoginController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
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
		$this->middleware( 'guest' )->except( 'logout' );
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function login( Request $request ) {
//		return 1212;
		$this->validateLogin( $request );
//dd(123);
		// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.
		if ( $this->hasTooManyLoginAttempts( $request ) ) {
			$this->fireLockoutEvent( $request );

			return $this->sendLockoutResponse( $request );
		}


		if ( auth()->validate( $request->only( 'email', 'password' ) ) ) {
//			if(is_numeric(intval($request->input( 'email' )))){
//				$user = User::whereCode( intval($request->input( 'email' )) )->first();
//			}else{
				$user = User::whereEmail( $request->input( 'email' ) )->first();
//			}
//			dd($user);
			if ( $user->active == 0 ) {
				$checkActiveCode = $user->activationCode()->where( 'expire', '>=', Carbon::now() )->latest()->first();

				if ( count( $checkActiveCode ) == 1 ) {
					if ( $checkActiveCode->expire > Carbon::now() ) {
						$this->incrementLoginAttempts( $request );

						return back()->withErrors( [
							'code' =>
								'ایمیل فعال سازی قبلا به ایمیل شما ارسال شد بعد از 15 دقیقه دوباره برای ارسال ایمیل لاگین کنید'
						] );
					}
				} else {
					event( new UserActivation( $user ) );
				}
			}
		}


		if ( $this->attemptLogin( $request ) ) {
			return $this->sendLoginResponse( $request );
		}

		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of courses, when this
		// user surpasses their maximum number of attempts they will get locked out.
		$this->incrementLoginAttempts( $request );

//return 1234;
		return $this->sendFailedLoginResponse( $request );
	}

	/**
	 * Attempt to log the user into the application.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return bool
	 */
	protected function attemptLogin( Request $request ) {
		return $this->guard()->attempt(
			$this->credentials( $request ), $request->filled( 'remember' )
		);
	}

	public function redirectToProvider() {
//		Opt::upd( 'kkk', Url::previous() );
		session()->put( 'googlePrevUrl', Url::previous() );

//		return Socialite::driver( 'google' )->redirect();
	}

	public function handleProviderCallback() {
		$social_user = Socialite::driver( 'google' )->user();
//		dd( $social_user );
		$user = User::whereEmail( $social_user->getEmail() )->first(); //check if a user with this email exist before


		if ( ! $user ) {
			$user = User::create( [
				'name'     => $social_user->getName(),
				'email'    => $social_user->getEmail(),
				'password' => bcrypt( $social_user->getId() )
			] );
//			Umeta::create( [
//				'user_id' => $user->id,
//			] );
		}

		if ( $user->active == 0 ) {
			$user->update( [
				'active' => 1
			] );
		}

		auth()->loginUsingId( $user->id );

//		return back();
		return redirect( session( 'googlePrevUrl' ) );
	}

	/**
	 * Validate the user login request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return void
	 * @throws \Illuminate\Validation\ValidationException
	 */
	protected function validateLogin( Request $request ) {
		$this->validate( $request, [
			$this->username()      => 'required|string',
			'password'             => 'required|string',
//			'g-recaptcha-response' => 'recaptcha'
		] );
	}

	/**
	 * The user has been authenticated.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  mixed $user
	 *
	 * @return mixed
	 */
	protected function authenticated( Request $request, $user ) {
		Session::flash( 'message', 'با موفقیت لاگین شدید' );

		return redirect( route( 'dashboard' ) );

	}

	/**
	 * Send the response after the user was authenticated.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	protected function sendLoginResponse( Request $request ) {
		$request->session()->regenerate();

		$this->clearLoginAttempts( $request );

//die(7874);
		return $this->authenticated( $request, $this->guard()->user() )
			?: 123;
	}

	/**
	 * Get the guard to be used during authentication.
	 *
	 * @return \Illuminate\Contracts\Auth\StatefulGuard
	 */
	protected function guard() {
		return Auth::guard();
	}

	/**
	 * Get the needed authorization credentials from the request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return array
	 */
	protected function credentials( Request $request ) {
		return $request->only( $this->username(), 'password' );
	}

	public function showLoginForm() {
		return view( 'login' );
	}

}
