<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllotmentClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allotment_classes', function (Blueprint $table) {

            $table->id('allotment_class_id');

            $table->unsignedBigInteger('financial_year_id')->nullable()
                ->default(0);
                
            $table->string('allotment_class');
            $table->double('allotment_class_budget')->nullable();
            $table->double('allotment_class_balance')->nullable();
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
        Schema::dropIfExists('allotment_classes');
    }
}
