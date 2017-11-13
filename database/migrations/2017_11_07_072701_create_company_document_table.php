<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_document', function (Blueprint $table) {
            $table->string('document_name')->nullable();
            $table->integer('document_type_id')->unsigned()->nullable();
            $table->foreign('document_type_id')
                ->references('id')->on('document_type')
                ->onDelete('cascade');
            $table->integer('company_id')->unsigned()->nullable();
            $table->foreign('company_id')
                ->references('id')->on('company')
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
        Schema::dropIfExists('company_document');
    }
}
