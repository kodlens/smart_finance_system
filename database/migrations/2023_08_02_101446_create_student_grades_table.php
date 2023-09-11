<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_grades', function (Blueprint $table) {
            $table->id('student_grade_id');

            $table->unsignedBigInteger('student_list_id');
            $table->foreign('student_list_id')->references('student_list_id')->on('student_lists')
                    ->onDelete('cascade')->onUpdate('cascade');


            $table->unsignedBigInteger('academic_year_id');
            $table->foreign('academic_year_id')->references('academic_year_id')->on('academic_years')
                    ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('faculty_id');
            $table->foreign('faculty_id')->references('user_id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('user_id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('schedule_id');
            $table->foreign('schedule_id')->references('schedule_id')->on('schedules')
                    ->onDelete('cascade')->onUpdate('cascade');

            $table->integer('grade')->default(0);

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
        Schema::dropIfExists('student_grades');
    }
}
