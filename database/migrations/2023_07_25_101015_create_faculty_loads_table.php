<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultyLoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_loads', function (Blueprint $table) {
            $table->id('faculty_load_id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('academic_year_id');
            $table->foreign('academic_year_id')->references('academic_year_id')->on('academic_years')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('schedule_id');
            $table->foreign('schedule_id')->references('schedule_id')->on('schedules')
                    ->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('faculty_loads');
    }
}
