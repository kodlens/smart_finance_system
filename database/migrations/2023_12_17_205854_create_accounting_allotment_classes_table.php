<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingAllotmentClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_allotment_classes', function (Blueprint $table) {
            $table->id('accounting_allotment_class_id');

            $table->unsignedBigInteger('accounting_id');
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
        Schema::dropIfExists('accounting_allotment_classes');
    }
}
