<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcurementAllotmentClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_allotment_classes', function (Blueprint $table) {
            $table->id('procurement_allotment_classe_id');

            $table->unsignedBigInteger('procurement_id');
            $table->unsignedBigInteger('allotment_class_id');
            $table->unsignedBigInteger('allotment_class_account_id');
            $table->double('amount');

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
        Schema::dropIfExists('procurement_allotment_classes');
    }
}
