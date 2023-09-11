<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
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
                'course_code' => 'CIC 122 (LEC)',
                'course_desc' => 'DATA STRUCTURES AND ALGORITHM',
                'course_type' => 'LEC',
                'course_unit' => 1,
            ],
            [
                'course_code' => 'CIC 122 (LAB)',
                'course_desc' => 'DATA STRUCTURES AND ALGORITHM',
                'course_type' => 'LAB',
                'course_unit' => 2,
            ],
            [
                'course_code' => 'NSTP 1',
                'course_desc' => 'NATIONAL SERVICE AND TRAINING 11',
                'course_type' => 'LEC',
                'course_unit' => 3,
            ],
            [
                'course_code' => 'NSTP 2',
                'course_desc' => 'NATIONAL SERVICE AND TRAINING 2',
                'course_type' => 'LEC',
                'course_unit' => 3,
            ],
            [
                'course_code' => 'ALWAY 1',
                'course_desc' => 'HISTORY OF TANGUB AND GADTC, CORE VALUES',
                'course_type' => 'LEC',
                'course_unit' => 2,
            ],
            [
                'course_code' => 'ALWAY 2',
                'course_desc' => 'EMPOWERING THE ALFONSOS',
                'course_type' => 'LEC',
                'course_unit' => 2,
            ],
            [
                'course_code' => 'PATH-FIT 2',
                'course_desc' => 'FITNESS TRAINING',
                'course_type' => 'LEC',
                'course_unit' => 2,
            ],
            [
                'course_code' => 'MSC 122',
                'course_desc' => 'CALCULUS 1 WITH ANALYTIC GEOMETRY',
                'course_type' => 'LEC',
                'course_unit' => 3,
            ],
            [
                'course_code' => 'CIC 121 (LAB)',
                'course_desc' => 'COMPUTER PROGRAMMING 2',
                'course_type' => 'LAB',
                'course_unit' => 1,
            ],
            [
                'course_code' => 'GE KOMFIL',
                'course_desc' => 'KONTEKSWALISADONG KOMUNIKASYON FILIPINO',
                'course_type' => 'LEC',
                'course_unit' => 3,
            ],
            [
                'course_code' => 'GE CONWOR',
                'course_desc' => 'THE CONTEMPORARY WORLD',
                'course_type' => 'LEC',
                'course_unit' => 3,
            ],
            [
                'course_code' => 'PSC 225 (LEC)',
                'course_desc' => 'OBJECT-ORIENTED PROGRAMMING (LEC)',
                'course_type' => 'LEC',
                'course_unit' => 1,
            ],
            [
                'course_code' => 'PSC 225 (LAB)',
                'course_desc' => 'OBJECT-ORIENTED PROGRAMMING (LAB)',
                'course_type' => 'LAB',
                'course_unit' => 2,
            ],
            [
                'course_code' => 'JRIZ',
                'course_desc' => "RIZAL'S LIFE AND WORKS",
                'course_type' => 'LAB',
                'course_unit' => 3,
            ],
            [
                'course_code' => 'ESC 323 (LEC)',
                'course_desc' => "MODELING AND SIMULATION (LEC)",
                'course_type' => 'LEC',
                'course_unit' => 2,
            ],
            [
                'course_code' => 'ESC 323 (LAB)',
                'course_desc' => "MODELING AND SIMULATION (LAB)",
                'course_type' => 'LAB',
                'course_unit' => 1,
            ],
            [
                'course_code' => 'PSC 321 (LAB)',
                'course_desc' => "SOFTWARE ENGINEERING 2 (LAB)",
                'course_type' => 'LAB',
                'course_unit' => 1,
            ],
            [
                'course_code' => 'PSC 321 (LEC)',
                'course_desc' => "SOFTWARE ENGINEERING 2 (LEC)",
                'course_type' => 'LEC',
                'course_unit' => 2,
            ],
        ];

        \App\Models\Course::insertOrIgnore($data);
    }
}
