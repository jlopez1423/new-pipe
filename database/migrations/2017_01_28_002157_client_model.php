<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClientModel extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('clients', function (Blueprint $table) {

			$table->increments('id');
			$table->string( 'name' );
			$table->string( 'tax_number' )->nullable();
			$table->string( 'website' )->nullable();
			$table->text( 'logo' )->nullable();
			$table->string( 'status' )->nullable();
			$table->text( 'note' )->nullable();

			$table->softDeletes();
			$table->timestamps();

		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('clients');
	}
}
