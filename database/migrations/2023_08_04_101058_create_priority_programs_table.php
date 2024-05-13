<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriorityProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('priority_programs', function (Blueprint $table) {
            $table->id('priority_program_id');
            
            $table->unsignedBigInteger('financial_year_id');
            
            $table->string('priority_program')->nullable();
            $table->string('priority_program_code')->nullable();
            $table->double('priority_program_budget')->nullable()
                ->default(0);
            $table->double('priority_program_balance')->nullable()
                ->default(0);

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
        Schema::dropIfExists('priority_programs');
    }
}
