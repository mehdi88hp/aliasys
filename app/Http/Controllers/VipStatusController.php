<?php

namespace App\Http\Controllers;

use App\VipStatus;
use Illuminate\Http\Request;

class VipStatusController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\VipStatus $vipStatus
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( VipStatus $vipStatus ) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\VipStatus $vipStatus
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( VipStatus $vipStatus ) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\VipStatus $vipStatus
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, VipStatus $vipStatus ) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\VipStatus $vipStatus
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( VipStatus $vipStatus ) {
		//
	}

	public function addVipStatus() {
		if ( request()->method() == 'GET' ) {
			$prizes = VipStatus::all();

			//		dd( $prizes[2]->user()->get() );

			return view( 'add-vip-status' )->with( compact( 'prizes' ) );
		} else {
//dd(\request()->all());
			$posts = request()->all();
			//dd($posts);
			$prizes = [];

			/*مرتب کردن آرایه ورودی*/
			foreach ( $posts as $k1 => $post ) {
				if ( $k1 == 'prize_name' ) {
					foreach ( $post as $k2 => $name ) {
						if ( is_array( $name ) ) {
							$prizes[ $k2 ]['name'] = array_values( $name )[0];
						} else {
							$prizes[ $k2 ]['name'] = $name;
						}
					}
				}
				if ( $k1 == 'prize_point' ) {
					foreach ( $post as $k2 => $point ) {
						if ( is_array( $point ) ) {
							$prizes[ $k2 ]['point'] = array_values( $point )[0];
						} else {
							$prizes[ $k2 ]['point'] = $point;
						}
					}
				}
				if ( $k1 == 'prize_discount' ) {
					foreach ( $post as $k2 => $point ) {
						if ( is_array( $point ) ) {
							$prizes[ $k2 ]['discount'] = array_values( $point )[0];
						} else {
							$prizes[ $k2 ]['discount'] = $point;
						}
					}
				}
				if ( $k1 == 'prize_color' ) {
					foreach ( $post as $k2 => $point ) {
						if ( is_array( $point ) ) {
							$prizes[ $k2 ]['color'] = array_values( $point )[0];
						} else {
							$prizes[ $k2 ]['color'] = $point;
						}
					}
				}
			}
			//		dd( $prizes );
			foreach ( $prizes as $prize ) {
				VipStatus::create( [
					'point'    => $prize['point'],
					'name'     => $prize['name'],
					'discount' => $prize['discount'],
					'color'    => $prize['color']
				] );
			}
		}

		return back();
	}

	public function vipStatusEdit() {
		$vip        = VipStatus::find( request()->id );
		$vip->name  = request()->name;
		$vip->point = request()->point;
		$vip->color = request()->color;
		$vip->discount = request()->discount;
		$vip->save();

		return 10;
	}

	public function vipStatusDelete() {
		VipStatus::destroy( request()->id );

		return 'deleted';
	}

	public function vipGuide() {
		return view( 'vip-guide' );
	}
}
