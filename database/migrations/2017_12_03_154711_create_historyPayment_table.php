<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pnbp_code', 30);
            $table->string('notes');
            $table->bigInteger('total_payment');
            $table->string('payment_method');
            $table->string('transaction_number')->nullable();
            $table->integer('log_trade_permit_id')->unsigned()->nullable();
            $table->foreign('log_trade_permit_id')
                ->references('id')->on('log_trade_permit')
                ->onDelete('cascade');
            $table->integer('pnbp_id')->unsigned()->nullable();
            $table->foreign('pnbp_id')
                ->references('id')->on('pnbp')
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
        Schema::dropIfExists('history_payment');
    }
}
