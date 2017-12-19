<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLogTradePermit2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_trade_permit', function (Blueprint $table) {
            $table->string('trade_permit_code','30');
            $table->text('consignee_address');
            $table->integer('is_blanko')->default(0);
            $table->integer('is_renewal')->default(0);
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
        Schema::table('log_trade_permit', function (Blueprint $table) {
            $table->dropColumn('trade_permit_code');
            $table->dropColumn('consignee_address');
            $table->dropColumn('is_blanko');
            $table->dropColumn('is_renewal');
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->dropForeign(['source_id']);
            $table->dropColumn('source_id');
            $table->dropForeign(['country_destination']);
            $table->dropColumn('country_destination');
            $table->dropForeign(['country_exportation']);
            $table->dropColumn('country_exportation');
        });
    }
}
