<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class checkAminAuthenticated {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {
//		if ( Auth::check() ) {
//		return $next( $request );
		if ( Auth::check() ) {
			//or use auth()->check() helper function
			if ( Auth::user()->isAdmin() ) {
				return $next( $request );
			}
		}
//		dd(404);
//		return view('home-spa');
		return redirect( '/' );
	}
}
