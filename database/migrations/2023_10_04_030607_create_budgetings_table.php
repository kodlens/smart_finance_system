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
            $table->date('particular_date')->nullable();

            $table->string('total_amount')->nullable();
            $table->string('supplier_payee')->nullable();

            $table->string('allotment_class')->nullable();
            $table->string('account')->nullable();
            $table->string('account_code')->nullable();

            $table->string('amount')->nullable();
            
            $table->string('priority_program')->nullable();
            $table->string('pp_account_code')->nullable();
            $table->string('suplemental_budget')->nullable();
            $table->string('capital_outlay')->nullable();
            $table->string('accounts_payable')->nullable();
            $table->string('tes_trust_fund')->nullable();
            $table->string('others')->nullable();

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
