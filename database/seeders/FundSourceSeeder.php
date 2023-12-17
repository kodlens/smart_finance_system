<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FundSourceSeeder extends Seeder
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
                'fund_source' => 'CURRENT FINANCIAL YEAR',
            ],
            [
                'fund_source' => 'SUPPLEMENTAL BUDGET',
            ], 
            [
                'fund_source' => 'CONTINUING CAPITAL OUTLAY',
            ],
            [
                'fund_source' => 'ACCOUNT PAYABLE',
            ],
            [
                'fund_source' => 'TES TRUST FUND',
            ],
            [
                'fund_source' => 'OTHERS',
            ],
           
           
           
           
       

        ];

        \App\Models\FundSource::insertOrIgnore($data);
    }
}
