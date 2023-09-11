<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudentListSeeder extends Seeder
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
                'schedule_id' => 1,
                'faculty_id' => 5,
                'student_id' => 15

            ],
            
            [
                'academic_year_id' => 1,
                'schedule_id' => 1,
                'faculty_id' => 5,
                'student_id' => 14

            ],
            [
                'academic_year_id' => 1,
                'schedule_id' => 1,
                'faculty_id' => 5,
                'student_id' => 11

            ],
            [
                'academic_year_id' => 1,
                'schedule_id' => 1,
                'faculty_id' => 5,
                'student_id' => 12

            ],
       

        ];

        \App\Models\StudentList::insertOrIgnore($data);

    }
}
