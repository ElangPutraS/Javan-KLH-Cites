<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradePermitDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_permit_detail', function (Blueprint $table) {
            $table->integer('total_exported');
            $table->integer('trade_permit_id')->unsigned()->nullable();
            $table->foreign('trade_permit_id')
                ->references('id')->on('trade_permit')
                ->onDelete('cascade');
            $table->integer('species_id')->unsigned()->nullable();
            $table->foreign('species_id')
                ->references('id')->on('species')
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
        Schema::dropIfExists('trade_permit_detail');
    }
}
