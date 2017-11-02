<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_items', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('template_id')->unsigned()->index();
            $table->foreign('template_id')->references('id')->on('templates')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('template_action_id')->unsigned()->index();
            $table->foreign('template_action_id')->references('id')->on('template_actions')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });

        DB::table('template_items')->insert([
            [ 'template_id' => 1, 'template_action_id' => 1, 'created_at' => Carbon::now() ],
            [ 'template_id' => 1, 'template_action_id' => 1, 'created_at' => Carbon::now() ],
            [ 'template_id' => 1, 'template_action_id' => 2, 'created_at' => Carbon::now() ],
            [ 'template_id' => 1, 'template_action_id' => 3, 'created_at' => Carbon::now() ],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_items');
    }
}
