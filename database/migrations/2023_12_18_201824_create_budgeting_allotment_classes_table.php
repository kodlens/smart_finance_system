<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetingAllotmentClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgeting_allotment_classes', function (Blueprint $table) {
            $table->id('budgeting_allotment_class_id');

            $table->unsignedBigInteger('budgeting_id');
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
        Schema::dropIfExists('budgeting_allotment_classes');
    }
}
