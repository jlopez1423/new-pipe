<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateTemplateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('display_name');
            $table->timestamps();
        });

        DB::table('template_actions')->insert([
            [ 'name'=> 'create_project', 'display_name' => 'Create Project', 'created_at' => Carbon::now() ],
            [ 'name'=> 'create_task', 'display_name' => 'Create Task', 'created_at' => Carbon::now() ],
            [ 'name'=> 'email', 'display_name' => 'Send Email', 'created_at' => Carbon::now() ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_actions');
    }
}
