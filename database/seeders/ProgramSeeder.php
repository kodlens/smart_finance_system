<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
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
                'program_code' => 'BSCS',
                'program_desc' => 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE',
                'active' => 1
            ],
            [
                'program_code' => 'BS CRIM',
                'program_desc' => 'BACHELOR OF SCIENCE IN CRIMINOLOGY',
                'active' => 1
            ],
            [
                'program_code' => 'BS ISM',
                'program_desc' => 'BACHELOR OF SCIENCE IN INDUSTRIAL SECURITY MANAGEMENT',
                'active' => 1
            ],
            [
                'program_code' => 'GEN MID',
                'program_desc' => 'GENERAL MIDWIFERY',
                'active' => 1
            ],
            [
                'program_code' => 'BS-HRM',
                'program_desc' => 'BACHELOR OF SCIENCE IN HUMAN RESOURCE MANAGEMENT',
                'active' => 1
            ],
            [
                'program_code' => 'BS-MM',
                'program_desc' => 'BACHELOR OF SCIENCE IN MARKETING MANAGEMENT',
                'active' => 1
            ],
        ];

        \App\Models\Program::insertOrIgnore($data);
        
    }
}
