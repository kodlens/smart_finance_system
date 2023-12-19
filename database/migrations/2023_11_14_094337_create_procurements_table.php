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

            $table->unsignedBigInteger('financial_year_id')->default(0)
                ->nullable();
        
            $table->unsignedBigInteger('fund_source_id')->default(0)
                ->nullable();

            $table->dateTime('date_time')->nullable();
            $table->string('training_control_no')->nullable();
            $table->string('pr_no')->nullable();
            $table->string('particulars')->nullable();
            $table->double('pr_amount')->default(0);
            $table->unsignedBigInteger('payee_id')->default(0)
                ->nullable();

            $table->unsignedBigInteger('priority_program_id')->default(0)
                ->nullable();

            $table->string('pr_status')->nullable();
            $table->string('others')->nullable();
            $table->unsignedBigInteger('office_id')->default(0);

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
