<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id('schedule_id');

            $table->unsignedBigInteger('academic_year_id');
            $table->foreign('academic_year_id')->references('academic_year_id')->on('academic_years')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('program_id')->default(0)
                ->nullable();
            
            
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('course_id')->on('courses')
                    ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('room_id')->on('rooms')
                    ->onDelete('cascade')->onUpdate('cascade');

            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            $table->integer('faculty_id')->default(0);

            $table->tinyInteger('mon')->default(0);
            $table->tinyInteger('tue')->default(0);
            $table->tinyInteger('wed')->default(0);
            $table->tinyInteger('thu')->default(0);
            $table->tinyInteger('fri')->default(0);
            $table->tinyInteger('sat')->default(0);
            $table->tinyInteger('sun')->default(0);

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
        Schema::dropIfExists('schedules');
    }
}
