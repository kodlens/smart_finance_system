<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_lists', function (Blueprint $table) {

            $table->id('student_list_id');

            $table->unsignedBigInteger('academic_year_id');
            $table->foreign('academic_year_id')->references('academic_year_id')->on('academic_years')
                    ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('schedule_id');
            $table->foreign('schedule_id')->references('schedule_id')->on('schedules')
                    ->onDelete('cascade')->onUpdate('cascade');
        
            $table->unsignedBigInteger('faculty_id');
            $table->foreign('faculty_id')->references('user_id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('user_id')->on('users')
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
        Schema::dropIfExists('student_lists');
    }
}
