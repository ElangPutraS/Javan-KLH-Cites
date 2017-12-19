<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStampToTradePermit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trade_permit', function (Blueprint $table) {
            //
            $table->string('stamp', 64)->nullable()->after('country_exportation');
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
            $table->dropColumn('stamp');
        });
    }
}
