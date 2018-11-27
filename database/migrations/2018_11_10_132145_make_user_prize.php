<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeUserPrize extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'user_prize', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'user_id' )->unsigned();
			$table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onDelete( 'cascade' );

			$table->integer( 'prize_id' )->unsigned();
			$table->foreign( 'prize_id' )->references( 'id' )->on( 'prizes' )->onDelete( 'cascade' );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'user_prize' );
	}
}
