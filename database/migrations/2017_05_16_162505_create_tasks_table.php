<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'tasks', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'name' );
            $table->text( 'body' );

            $table->integer( 'user_id' )->references( 'users' )->on( 'id' );
            $table->integer( 'project_id' )->references( 'projects' )->on( 'id' );

            $table->decimal( 'task_time', 5, 2 );
            $table->date( 'start_date' );
            $table->date( 'end_date' );
            $table->enum('status', ['not started','pending','in progress','stalled','completed'])->default('not started');
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
        //
        Schema::dropIfExists( 'tasks' );
    }
}
