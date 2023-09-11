<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $data = [
            [
                'academic_year_id' => 1,
                'program_id' => 0,
                'course_id' => 1,
                'room_id' => 1,
                'start_time' => '08:30:00',
                'end_time' => '10:00:00',
                'faculty_id' => 1,
                'mon' => 1,
                'tue' => 0,
                'wed' => 0,
                'thu' => 1,
                'fri' => 0,
                'sat' => 0,
                'sun' => 0,
            ], 
            [
                'academic_year_id' => 1,
                'program_id' => 0,
                'course_id' => 1,
                'room_id' => 3,
                'start_time' => '08:30:00',
                'end_time' => '10:00:00',
                'faculty_id' => 1,
                'mon' => 0,
                'tue' => 1,
                'wed' => 0,
                'thu' => 0,
                'fri' => 1,
                'sat' => 0,
                'sun' => 0,
            ], 
            [
                'academic_year_id' => 1,
                'program_id' => 1,
                'course_id' => 5,
                'room_id' => 2,
                'start_time' => '11:00:00',
                'end_time' => '12:00:00',
                'faculty_id' => 8,
                'mon' => 1,
                'tue' => 0,
                'wed' => 1,
                'thu' => 0,
                'fri' => 1,
                'sat' => 0,
                'sun' => 0,
            ],


            [
                'academic_year_id' => 1,
                'program_id' => 1,
                'course_id' => 1,
                'room_id' => 1,
                'start_time' => '08:30:00',
                'end_time' => '10:00:00',
                'faculty_id' => 0,
                'mon' => 1,
                'tue' => 0,
                'wed' => 0,
                'thu' => 1,
                'fri' => 0,
                'sat' => 0,
                'sun' => 0,
            ], 
            [
                'academic_year_id' => 1,
                'program_id' => 1,
                'course_id' => 1,
                'room_id' => 3,
                'start_time' => '08:30:00',
                'end_time' => '10:00:00',
                'faculty_id' => 0,
                'mon' => 0,
                'tue' => 1,
                'wed' => 0,
                'thu' => 0,
                'fri' => 1,
                'sat' => 0,
                'sun' => 0,
            ], 
            [
                'academic_year_id' => 1,
                'program_id' => 1,
                'course_id' => 5,
                'room_id' => 3,
                'start_time' => '11:00:00',
                'end_time' => '12:00:00',
                'faculty_id' => 0,
                'mon' => 0,
                'tue' => 1,
                'wed' => 0,
                'thu' => 0,
                'fri' => 1,
                'sat' => 0,
                'sun' => 0,
            ],

        ];

        \App\Models\Schedule::insertOrIgnore($data);
    }
}
