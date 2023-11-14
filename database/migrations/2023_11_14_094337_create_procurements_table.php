<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurements', function (Blueprint $table) {
            $table->id('procurement_id');
            $table->dateTime('date_time')->nullable();
            $table->string('training_control_no')->nullable();
            $table->string('pr_number')->nullable();
            $table->string('particulars')->nullable();
            $table->double('pr_amount')->default(0);
            $table->unsignedBigInteger('payee_id');
            $table->string('payee')->nullable();
            $table->string('pr_status')->nullable();
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('allotment_class_id');
            $table->unsignedBigInteger('allotment_class_account_id');
            $table->string('supplemental_budget')->nullable();
            $table->string('capital_outlay')->nullable();
            $table->string('account_payable')->nullable();
            $table->string('tes_trust_fund')->nullable();
            $table->string('others')->nullable();
            $table->unsignedBigInteger('office_id');
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
        Schema::dropIfExists('procurements');
    }
}
