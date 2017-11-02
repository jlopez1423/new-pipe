<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'departments', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'name' );
            $table->timestamps();
        } );

        DB::table('departments')->insert([
            [ 'name' => 'Management',       'created_at' => Carbon::now() ],
            [ 'name' => 'Account Managers', 'created_at' => Carbon::now() ],
            [ 'name' => 'Designers',        'created_at' => Carbon::now() ],
            [ 'name' => 'Developers',       'created_at' => Carbon::now() ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'departments' );
    }
}
