<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypeIdentifyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_type_identify', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_profile_id')->unsigned()->nullable();

            $table->foreign('user_profile_id')
                ->references('id')->on('user_profiles')
                ->onDelete('cascade');

            $table->integer('type_identify_id')->unsigned()->nullable();

            $table->foreign('type_identify_id')
                ->references('id')->on('type_identify')
                ->onDelete('cascade');

            $table->string('user_type_identify_number',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_type_identify');
    }
}
