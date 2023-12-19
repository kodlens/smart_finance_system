<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgetings', function (Blueprint $table) {
            $table->id('budgeting_id');


            $table->dateTime('date_time')->nullable();

            $table->unsignedBigInteger('financial_year_id')->default(0)
                ->nullable();

            $table->unsignedBigInteger('fund_source_id')->default(0)
                ->nullable();

            $table->string('transaction_no')->nullable();
            $table->string('training_control_no')->nullable();

            $table->unsignedBigInteger('transaction_type_id')->default(0);
            $table->string('transaction_type')->nullable();

            $table->unsignedBigInteger('payee_id')->default(0);
            $table->string('payee')->nullable();

            $table->string('particulars')->nullable();
            $table->string('total_amount')->nullable();

            $table->unsignedBigInteger('allotment_class_id')->default(0)
                ->nullable();
            $table->unsignedBigInteger('allotment_class_account_id')->default(0)
                ->nullable();
            $table->string('amount')->nullable();

            $table->unsignedBigInteger('priority_program_id')->default(0)
                ->nullable();

            $table->string('others')->nullable();

            $table->unsignedBigInteger('office_id')->default(0)
                ->nullable();

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
        Schema::dropIfExists('budgetings');
    }
}
