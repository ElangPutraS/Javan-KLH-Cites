<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name', 100);
            $table->text('company_address');
            $table->string('company_email', 30);
            $table->string('company_fax', 30);
            $table->string('company_latitude', 30);
            $table->string('company_longitude', 30);
            $table->integer('company_status')->default(0);
            $table->integer('user_profile_id')->unsigned()->nullable();
            $table->foreign('user_profile_id')
                ->references('id')->on('user_profile')
                ->onDelete('cascade');
            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')
                ->references('id')->on('city')
                ->onDelete('cascade');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('company');
    }
}
