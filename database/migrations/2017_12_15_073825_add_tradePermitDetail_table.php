<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTradePermitDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trade_permit_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('log_trade_permit_id');
            $table->integer('valid_renewal')->default(0);
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trade_permit_detail', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->dropColumn('log_trade_permit_id');
            $table->dropColumn('valid_renewal');
            $table->dropColumn('description');
        });
    }
}
