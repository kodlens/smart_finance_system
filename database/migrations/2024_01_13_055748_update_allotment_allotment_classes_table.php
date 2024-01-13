<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAllotmentAllotmentClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('allotment_classes', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('financial_year_id')->nullable()
                ->default(0)
                ->after('allotment_class_id');

            $table->double('allotment_class_amount')->nullable()
                ->after('allotment_class');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('allotment_classes', function (Blueprint $table) {
            //
        });
    }
}
