<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->text('description');

            $table->integer('client_id')->references('clients')->on('id');

            $table->integer('category_id')->nullable();
            $table->float('work_hours');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['not started','pending','in progress','stalled','completed'])->default('not started');

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
        Schema::dropIfExists('projects');
    }
}
