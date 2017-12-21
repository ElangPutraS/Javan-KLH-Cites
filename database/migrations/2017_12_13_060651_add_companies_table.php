<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('owner_name', 100);
            $table->text('captivity_address');
            $table->integer('labor_total');
            $table->bigInteger('investation_total');
            $table->string('npwp_number', '30');
            $table->date('date_distribution');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('owner_name');
            $table->dropColumn('captivity_address');
            $table->dropColumn('labor_total');
            $table->dropColumn('investation_total');
            $table->dropColumn('npwp_number');
            $table->dropColumn('date_distribution');
        });
    }
}
