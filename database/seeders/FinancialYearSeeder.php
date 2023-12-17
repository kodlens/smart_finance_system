<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FinancialYearSeeder extends Seeder
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
                'financial_year_code' => '231',
                'financial_year_desc' => '1ST SEMESTER ACADEMIC YEAR 2023-2024',
                'active' => 1
            ],
            
            [
                'financial_year_code' => '232',
                'financial_year_desc' => '2ND SEMESTER ACADEMIC YEAR 2023-2024',
                'active' => 0
            ],
       

        ];

        \App\Models\FinancialYear::insertOrIgnore($data);
    }
}
