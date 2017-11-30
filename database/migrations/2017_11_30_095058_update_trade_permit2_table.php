<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTradePermit2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trade_permit', function (Blueprint $table) {
            $table->integer('valid_renewal')->unsigned()->nullable();
            $table->integer('permit_type')->unsigned()->nullable()->default(1);
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
            $table->dropColumn('valid_renewal');
            $table->dropColumn('permit_type');
        });
    }
}
