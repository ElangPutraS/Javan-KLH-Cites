<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeciesQuotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species_quota', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quota_amount');
            $table->string('year', '4');
            $table->integer('species_id')->unsigned()->nullable();
            $table->foreign('species_id')
                ->references('id')->on('species')
                ->onDelete('cascade');
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
        Schema::dropIfExists('species_quota');
    }
}
