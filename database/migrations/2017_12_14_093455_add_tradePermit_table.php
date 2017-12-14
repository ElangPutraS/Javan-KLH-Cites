<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTradePermitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trade_permit', function (Blueprint $table) {
            $table->text('consignee_address');
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');
            $table->integer('source_id')->unsigned()->nullable();
            $table->foreign('source_id')
                ->references('id')->on('sources')
                ->onDelete('cascade');
            $table->integer('country_destination')->unsigned()->nullable();
            $table->foreign('country_destination')
                ->references('id')->on('countries')
                ->onDelete('cascade');
            $table->integer('country_exportation')->unsigned()->nullable();
            $table->foreign('country_exportation')
                ->references('id')->on('countries')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trade_permit', function (Blueprint $table) {
            //
        });
    }
}
