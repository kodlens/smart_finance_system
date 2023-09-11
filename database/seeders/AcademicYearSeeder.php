<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
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
                'academic_year_code' => '231',
                'academic_year_desc' => '1ST SEMESTER ACADEMIC YEAR 2023-2024',
                'active' => 1
            ],
            
            [
                'academic_year_code' => '232',
                'academic_year_desc' => '2ND SEMESTER ACADEMIC YEAR 2023-2024',
                'active' => 0
            ],
       

        ];

        \App\Models\AcademicYear::insertOrIgnore($data);
    }
}
