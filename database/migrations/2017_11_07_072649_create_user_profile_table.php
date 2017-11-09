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
            $table->integer('created_by')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')
                ->references('id')->on('cities')
                ->onDelete('cascade');
            $table->integer('update_by')->nullable();
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
