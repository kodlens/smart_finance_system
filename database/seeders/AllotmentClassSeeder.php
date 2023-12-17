<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AllotmentClassSeeder extends Seeder
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
                'allotment_class' => 'PERSONAL SERVICES',
            ],
            [
                'allotment_class' => 'MAINTENANCE AND OTHER OPERATING',
            ],
            [
                'allotment_class' => 'CAPITAL OUTLAY',
            ],

            [
                'allotment_class' => 'OTHERS',
            ],
          
        ];

        \App\Models\AllotmentClass::insertOrIgnore($data);

    }
}
