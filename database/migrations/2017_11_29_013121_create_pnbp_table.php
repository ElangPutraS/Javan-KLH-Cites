<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePnbpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnbp', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pnbp_code', 20);
            $table->bigInteger('pnbp_amount');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('payment_status')->default(0);
            $table->integer('trade_permit_id')->unsigned()->nullable();
            $table->foreign('trade_permit_id')
                ->references('id')->on('trade_permit')
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
        Schema::dropIfExists('pnbp');
    }
}
