<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradePermitDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_permit_document', function (Blueprint $table) {
            $table->string('document_name')->nullable();
            $table->integer('document_type_id')->unsigned()->nullable();
            $table->foreign('document_type_id')
                ->references('id')->on('document_type')
                ->onDelete('cascade');
            $table->integer('trade_permit_id')->unsigned()->nullable();
            $table->foreign('trade_permit_id')
                ->references('id')->on('trade_permit')
                ->onDelete('cascade');
            $table->string('file_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trade_permit_document');
    }
}
