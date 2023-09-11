<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FacultyLoadSeeder extends Seeder
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
                'user_id' => 5,
                'academic_year_id' => 1,
                'schedule_id' => 1
            ],
            [
                'user_id' => 5,
                'academic_year_id' => 1,
                'schedule_id' => 2
            ],
            [
                'user_id' => 5,
                'academic_year_id' => 1,
                'schedule_id' => 3
            ],
            [
                'user_id' => 5,
                'academic_year_id' => 1,
                'schedule_id' => 4
            ],
            
            

        ];

        \App\Models\FacultyLoad::insertOrIgnore($data);

    }
}
