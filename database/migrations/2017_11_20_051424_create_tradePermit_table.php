<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradePermitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_permit', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trade_permit_code','10');
            $table->text('consignee');
            $table->string('appendix_type','10');
            $table->date('date_submission');
            $table->integer('period');
            $table->date('valid_start')->nullable();
            $table->date('valid_until')->nullable();
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
            $table->integer('updated_by')->unsigned()->nullable();
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
        Schema::dropIfExists('trade_permit');
    }
}
