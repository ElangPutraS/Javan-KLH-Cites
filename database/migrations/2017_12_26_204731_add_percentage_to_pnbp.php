<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPercentageToPnbp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pnbp', function (Blueprint $table) {
            //
            $table->tinyInteger('percentage_value')->default(0)->after('trade_permit_id');
            $table->bigInteger('pnbp_percentage_amount')->default(0)->after('pnbp_amount');
            $table->bigInteger('pnbp_sub_amount')->default(0)->after('pnbp_percentage_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pnbp', function (Blueprint $table) {
            //
            $table->dropColumn('percentage_value');
            $table->dropColumn('pnbp_percentage_amount');
            $table->dropColumn('pnbp_sub_amount');
        });
    }
}
