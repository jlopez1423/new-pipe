<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('template_action_id')->unsigned()->index();
            $table->foreign('template_action_id')->references('template_actions')->on('id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('display_name');
            $table->string('name');
            $table->string('type');
            $table->boolean('required')->default(0);
            $table->string('default_value')->default(NULL);
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
        Schema::dropIfExists('template_fields');
    }
}
