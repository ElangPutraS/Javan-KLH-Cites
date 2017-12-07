<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLogTradePermitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_trade_permit', function (Blueprint $table) {
            $table->text('consignee');
            $table->integer('period');
            $table->date('date_submission');
            $table->date('valid_start')->nullable();
            $table->date('valid_until')->nullable();
            $table->integer('valid_renewal')->unsigned()->nullable();
            $table->integer('permit_type')->default(1);
            $table->integer('company_id')->unsigned()->nullable();
            $table->foreign('company_id')
                ->references('id')->on('companies')
                ->onDelete('cascade');
            $table->integer('port_exportation')->unsigned()->nullable();
            $table->foreign('port_exportation')
                ->references('id')->on('ports')
                ->onDelete('cascade');
            $table->integer('port_destination')->unsigned()->nullable();
            $table->foreign('port_destination')
                ->references('id')->on('ports')
                ->onDelete('cascade');
            $table->integer('trading_type_id')->unsigned()->nullable();
            $table->foreign('trading_type_id')
                ->references('id')->on('trading_type')
                ->onDelete('cascade');
            $table->integer('purpose_type_id')->unsigned()->nullable();
            $table->foreign('purpose_type_id')
                ->references('id')->on('purpose_type')
                ->onDelete('cascade');
            $table->integer('trade_permit_status_id')->unsigned()->nullable();
            $table->foreign('trade_permit_status_id')
                ->references('id')->on('trade_permit_status')
                ->onDelete('cascade');
            $table->integer('created_by')->unsigned()->nullable();
            $table->foreign('created_by')
                ->references('id')->on('users')
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
            $table->dropColumn('consignee');
            $table->dropColumn('period');
            $table->dropColumn('date_submission');
            $table->dropColumn('valid_start');
            $table->dropColumn('valid_until');
            $table->dropColumn('valid_renewal');
            $table->dropColumn('permit_type');
            $table->dropForeign(['company_id']);
            $table->dropForeign(['port_exportation']);
            $table->dropForeign(['port_destination']);
            $table->dropForeign(['trading_type_id']);
            $table->dropForeign(['purpose_type_id']);
            $table->dropForeign(['trade_permit_status_id']);
            $table->dropForeign(['created_by']);
            $table->dropColumn(['company_id', 'port_exportation', 'port_destination', 'trading_type_id', 'purpose_type_id', 'trade_permit_status_id', 'created_by']);
        });
    }
}
