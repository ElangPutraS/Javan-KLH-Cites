<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryQuotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_quota', function (Blueprint $table) {
            $table->increments('id');
            $table->text('notes');
            $table->integer('total_quota');
            $table->integer('created_by')->unsigned()->nullable();
            $table->foreign('created_by')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->integer('species_quota_id')->unsigned()->nullable();
            $table->foreign('species_quota_id')
                ->references('id')->on('species_quota')
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
        Schema::dropIfExists('history_quota');
    }
}
