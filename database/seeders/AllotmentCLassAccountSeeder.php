<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AllotmentCLassAccountSeeder extends Seeder
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
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-01-010',
                'allotment_class_account' => 'SALARY AND WAGES FOR REGULAR',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-01-020',
                'allotment_class_account' => 'SALARY AND WAGES FOR CASUAL',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-04-990',
                'allotment_class_account' => 'SUBSTITUTION PAY',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-02-010',
                'allotment_class_account' => 'PERA',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-02-020',
                'allotment_class_account' => 'RA',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-02-030',
                'allotment_class_account' => 'TA',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-02-040',
                'allotment_class_account' => 'CLOTHING ALLOWANCE',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-02-080',
                'allotment_class_account' => 'PRODUCTIVITY',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-02-110',
                'allotment_class_account' => 'HAZARD PREMIUM',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-02-150',
                'allotment_class_account' => 'CASH GIFT',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-02-140',
                'allotment_class_account' => 'YEAR-END BONUS',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-01-990',
                'allotment_class_account' => 'OTHER BONUSES',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-03-010',
                'allotment_class_account' => 'LIFE AND RETIREMENT',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-03-020',
                'allotment_class_account' => 'PAG-IBIG PREMIUM',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-03-030',
                'allotment_class_account' => 'PHILHEALTH CONTRIBUTIONS',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-03-040',
                'allotment_class_account' => 'STATE INSURANCE/ECC',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-04-020',
                'allotment_class_account' => 'RETIREMENT GRATUITY',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-04-030',
                'allotment_class_account' => 'TERMINAL LEAVE BENEFITS',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 1,
                'allotment_class_account_code' => '5-01-04-990',
                'allotment_class_account' => 'OTHER PERSONAL BENEFITS',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],







            //maintenance and operating
            [
                'allotment_class_id' => 2,
                'allotment_class_account_code' => '5-02-01-010',
                'allotment_class_account' => 'TRAVELING EXPENSES (LOCAL)',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 2,
                'allotment_class_account_code' => '5-02-01-020',
                'allotment_class_account' => 'TRAVELING EXPENSES (FOREIGN)',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 2,
                'allotment_class_account_code' => '5-02-02-010',
                'allotment_class_account' => 'TRAINING EXPENSES/HUMAN RESOURCES DEVELOPMENT',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 2,
                'allotment_class_account_code' => '5-02-12-990',
                'allotment_class_account' => 'GENERAL SERVICES',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],
            [
                'allotment_class_id' => 2,
                'allotment_class_account_code' => '5-02-12-990',
                'allotment_class_account' => 'SCHOLARSHIP GRANTS/EXPENSES',
                'allotment_class_account_budget' => 10000000,
                'allotment_class_account_balance' => 10000000
            ],










            //capital outlay
            [
                'allotment_class_id' => 3,
                'allotment_class_account_code' => '1-07-07-010',
                'allotment_class_account' => 'FURNITURE AND FIXTURES',
                'allotment_class_account_budget' => 1000,
                'allotment_class_account_balance' => 1000
            ],
            [
                'allotment_class_id' => 3,
                'allotment_class_account_code' => '1-07-05-020',
                'allotment_class_account' => 'OFFICE EQUIPMENT',
                'allotment_class_account_budget' => 1000,
                'allotment_class_account_balance' => 1000
            ],
            [
                'allotment_class_id' => 3,
                'allotment_class_account_code' => '1-07-05-990',
                'allotment_class_account' => 'MACHINERY EQUIPMENT',
                'allotment_class_account_budget' => 1000,
                'allotment_class_account_balance' => 1000
            ],
            [
                'allotment_class_id' => 3,
                'allotment_class_account_code' => '1-07-06-010',
                'allotment_class_account' => 'MOTOR VEHICLES / TRANSPORTATION EQUIPMENT',
                'allotment_class_account_budget' => 1000,
                'allotment_class_account_balance' => 1000
            ],


        ];

        \App\Models\AllotmentClassAccount::insertOrIgnore($data);

    }
}
