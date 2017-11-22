<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species', function (Blueprint $table) {
            $table->increments('id');
            $table->string('species_scientific_name', '100');
            $table->string('species_indonesia_name', '100');
            $table->string('species_general_name', '100');
            $table->boolean('is_appendix');
            $table->integer('appendix_source_id')->unsigned()->nullable();
            $table->foreign('appendix_source_id')
                ->references('id')->on('appendix_source')
                ->onDelete('cascade');
            $table->integer('species_sex_id')->unsigned()->nullable();
            $table->foreign('species_sex_id')
                ->references('id')->on('species_sex')
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
        Schema::dropIfExists('species');
    }
}
