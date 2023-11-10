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
            $table->string('training_control_no')->nullable();
            $table->string('particulars')->nullable();
            $table->date('activity_date')->nullable();

            $table->string('total_amount')->nullable();

            $table->unsignedBigInteger('payee_id')->default(0);
            $table->string('supplier_payee')->nullable();

            $table->unsignedBigInteger('allotment_class_id')->default(0);
            $table->unsignedBigInteger('allotment_class_account_id')->default(0);
            $table->string('allotment_class_account')->nullable();
            $table->string('allotment_class_account_code')->nullable();

            $table->string('amount')->nullable();
            
            $table->unsignedBigInteger('priority_program_id')->default(0);
            $table->string('priority_program')->nullable();
            $table->string('priority_program_code')->nullable();

            $table->string('supplemental_budget')->nullable();
            $table->string('capital_outlay')->nullable();
            $table->string('account_payable')->nullable();
            $table->string('tes_trust_fund')->nullable();
            $table->string('others')->nullable();

            $table->unsignedBigInteger('office_id')->default(0);

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
