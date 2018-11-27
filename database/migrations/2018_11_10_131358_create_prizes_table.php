<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrizesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'prizes', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'point' );
			$table->string( 'name' );
			$table->string( 'pic',1024 );
			$table->timestamps();
		} );



	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'prizes' );
	}
}
