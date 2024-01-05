<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccountingProcessorDocToAccountingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accountings', function (Blueprint $table) {
            //
            $table->dateTime('processor_datetime_received')->nullable();

            $table->dateTime('bids_award_datetime_forwarded')->nullable();
            $table->dateTime('bids_award_datetime_retrieved')->nullable();
            $table->string('bids_award_status', 30)->nullable();
            $table->string('bids_award_remarks', 255)->nullable();

            $table->dateTime('city_budget_datetime_forwarded')->nullable();
            $table->dateTime('city_budget_datetime_retrieved')->nullable();
            $table->string('city_budget_status', 30)->nullable();
            $table->string('city_budget_remarks', 255)->nullable();

            $table->dateTime('city_accounting_datetime_forwarded')->nullable();
            $table->dateTime('city_accounting_datetime_retrieved')->nullable();
            $table->string('city_accounting_status', 30)->nullable();
            $table->string('city_accounting_remarks', 255)->nullable();

            $table->dateTime('city_treasurer_datetime_forwarded')->nullable();
            $table->dateTime('city_treasurer_datetime_retrieved')->nullable();
            $table->string('city_treasurer_status', 30)->nullable();
            $table->string('city_treasurer_remarks', 255)->nullable();
       
            $table->dateTime('college_accounting_datetime_updated')->nullable();
            $table->string('final_status', 30)->nullable();
            $table->string('final_remarks', 255)->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accountings', function (Blueprint $table) {
            //
        });
    }
}
