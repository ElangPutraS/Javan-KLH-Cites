<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCityProvinceTables extends Migration
{
    public function __construct()
    {
        $this->tablename_city = config('laraciproid.city');
        $this->tablename_province = config('laraciproid.province');
    }

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create($this->tablename_city, function (Blueprint $table) {
            $table->integer('id', 1, 1);
            $table->integer('province_id')->unsigned()->index();
            $table->string('city_name', 50)->index();
            $table->string('city_name_full', 100)->index();
            $table->enum('city_type', ['kabupaten', 'kota'])->nullable();
            $table->decimal('city_lat', 10, 6)->nullable()->index();
            $table->decimal('city_lon', 11, 6)->nullable()->index();

            $table->timestamps();
        });
        Schema::create($this->tablename_province, function (Blueprint $table) {
            $table->integer('id', 1, 1);
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('province_code', 4);
            $table->string('province_name', 50);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop($this->tablename_city);
        Schema::drop($this->tablename_province);
    }
}
