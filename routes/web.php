<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
//Auth::routes();
Route::get( 'user/active/email/{token}', 'UserController@activation' )->name( 'activation.account' );

Route::group( [ 'namespace' => 'Auth' ], function () {
	// Authentication Routes...
//	Route::get( '/get-user', 'GetCurrentUser@index' );


	$this->get( 'login', 'LoginController@showLoginForm' )->name( 'login' );
	$this->post( 'login', 'LoginController@login' );
	$this->get( 'logout', 'LoginController@logout' )->name( 'logout' );

	// Registration Routes...
	$this->get( 'register', 'RegisterController@showRegistrationForm' )->name( 'register' );
	$this->post( 'register', 'RegisterController@register' );

	// Password Reset Routes...
	$this->get( 'password/reset', 'ForgotPasswordController@showLinkRequestForm' )->name( 'password.request' );
	$this->post( 'password/email', 'ForgotPasswordController@sendResetLinkEmail' )->name( 'password.email' );
	$this->get( 'password/reset/{token}', 'ResetPasswordController@showResetForm' )->name( 'password.reset' );
	$this->post( 'password/reset', 'ResetPasswordController@reset' );

	//for google authenticating
	//Route::get('login/google', 'Auth\LoginController@redirectToProvider'); if not in Auth route group
//	$this->get( 'login/google', 'LoginController@redirectToProvider' );
//	$this->get( 'login/google/callback', 'LoginController@handleProviderCallback' );
} );
Route::group( [
	'middleware' => [ 'auth:web', 'checkAdmin' ]
],
	function () {
		$this->get( '/send-general-message', 'MessageController@sendGeneralMessage' );
		$this->post( '/send-general-message', 'MessageController@sendGeneralMessage' );
		$this->get( '/add-vip-status', 'VipStatusController@addVipStatus' );
		$this->post( '/add-vip-status', 'VipStatusController@addVipStatus' );
		$this->post( '/vip-status-edit', 'VipStatusController@vipStatusEdit' );
		$this->post( '/prize-status-edit', 'PrizeController@prizeEdit' );
		$this->post( '/vip-status-delete', 'VipStatusController@vipStatusDelete' );
		$this->post( '/prize-status-delete', 'PrizeController@prizeDelete' );
		$this->get( 'add-prize', 'PrizeController@create' );
		$this->post( 'add-prize', 'PrizeController@store' )->name( 'add.prize' );
		Route::get( '/add-user-excel', 'UserController@showExcelView' )->name( 'showExcelView' );
		Route::post( '/add-user-excel', 'UserController@addFromExcel' );
		$this->get('all-users','UserController@index');
		$this->get('prize-user-detail/{prize}','PrizeController@prizeUserDetail');
		$this->get('login-a-user/{user}','UserController@loginAUser');
	} );
Route::post( '/profile-complete', 'UserController@profileComplete' )->name( 'profileComplete' );
//Route::get( '/get-prize', 'PrizeController@getPrizeView' )->name( 'getPrizeView' );
Route::get( '/prize-gotten', 'PrizeController@prizeGotten' )->name( 'getPrizeView' );
Route::get( '/all-user-prizes', 'PrizeController@allUserPrizesView' );
Route::post( '/set-user-prize', 'PrizeController@setUserPrize' );
Route::get( '/', 'HomeController@dashboard' )->name( 'dashboard' );
Route::post( '/dashboard-img-edit', 'HomeController@dashboardImgEdit' );
Route::post( '/prize-img-edit', 'HomeController@prizeImgEdit' );
Route::get( '/profile', 'HomeController@index' )->name( 'profile' );
Route::get( '/presents-explanation', 'PrizeController@presentsExplanation' );
Route::get( '/vip-guide', 'VipStatusController@vipGuide' );
Route::post( '/reset-user-notification', 'UserController@resetUserNotification' );
Route::post( '/search-all-user', 'UserController@searchAllUser' );
