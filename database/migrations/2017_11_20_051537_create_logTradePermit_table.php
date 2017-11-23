<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTradePermitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_trade_permit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trade_permit_id')->unsigned()->nullable();
            $table->foreign('trade_permit_id')
                ->references('id')->on('trade_permit')
                ->onDelete('cascade');
            $table->text('log_description');
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
        Schema::dropIfExists('log_trade_permit');
    }
}
