<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAddcolamountFinancialYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('financial_years', function (Blueprint $table) {
            //
            $table->double('financial_budget')->nullable()
                ->default(0)
                ->after('financial_year_desc');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('financial_years', function (Blueprint $table) {
            //
        });
    }
}
