<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContactModel extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('contacts', function (Blueprint $table) {

			$table->increments('id');
			$table->bigInteger( 'client_id' );
			$table->boolean( 'primary_contact' );
			$table->string( 'first_name' );
			$table->string( 'last_name' );
			$table->enum( 'gender', [ 'male', 'female' ] )->nullable();
			$table->string( 'title' );
			$table->string( 'phone' )->nullable();
			$table->string( 'extension' )->nullable();
			$table->string( 'mobile' )->nullable();
			$table->string( 'fax' )->nullable();
			$table->string( 'email' );
			$table->string( 'address' )->nullable();
			$table->string( 'address_2' )->nullable();
			$table->string( 'city' )->nullable();
			$table->string( 'state' )->nullable();
			$table->string( 'zipcode' )->nullable();
			$table->string( 'country' )->nullable();
			$table->string( 'status' );
			$table->boolean( 'email_opt_out' )->nullable();
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
		Schema::dropIfExists('contacts');
	}
}
