<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->string('place_of_birth', 100);
            $table->date('date_of_birth');
            $table->text('address');
            $table->string('mobile',20);
            $table->string('person_identify',100);
            $table->integer('created_by');
            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')
                ->references('id')->on('city')
                ->onDelete('cascade');
            $table->integer('user_type_identify_id')->unsigned();
            $table->foreign('user_type_identify_id')
                ->references('id')->on('user_type_identify')
                ->onDelete('cascade');
            $table->integer('update_by');
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
        Schema::dropIfExists('user_profile');
    }
}
