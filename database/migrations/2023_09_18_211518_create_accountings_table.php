<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountings', function (Blueprint $table) {
            $table->id('accounting_id');

            $table->dateTime('date_time')->nullable();

            $table->unsignedBigInteger('financial_year_id')->default(0);

            $table->string('transaction_no')->nullable();
            $table->string('training_control_no')->nullable();

            $table->unsignedBigInteger('transaction_type_id')->default(0);
            $table->string('transaction_type')->nullable();

            $table->unsignedBigInteger('payee_id')->default(0);
            $table->string('payee')->nullable();

            $table->string('particulars')->nullable();
            $table->string('total_amount')->nullable();

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
        Schema::dropIfExists('accountings');
    }
}
