<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'username' => 'admin',
                'lname' => 'LADA',
                'fname' => 'CHERRY MAE',
                'mname' => '',
                'suffix' => '',
                'sex' => 'FEMALE',
                'role' => 'ADMINISTRATOR',
                'password' => Hash::make('a')
            ],

            // [
            //     'username' => 'ics',
            //     'ref_id' => 'DEAN',
            //     'lname' => 'CABATINGAN',
            //     'fname' => 'CARIN',
            //     'mname' => '',
            //     'suffix' => '',
            //     'sex' => 'MALE',
            //     'civil_status' => 'MARRIED',
            //     'office_id' => 1,
            //     'contact_no' => '09655138165',
            //     'program_id' => 0,
            //     'role' => 'DEAN',
            //     'password' => Hash::make('a')
            // ],

            // [
            //     'username' => 'ibfs',
            //     'ref_id' => 'DEAN',
            //     'lname' => 'TIA',
            //     'fname' => 'JENNIEFFER',
            //     'mname' => '',
            //     'suffix' => '',
            //     'sex' => 'FEMALE',
            //     'civil_status' => 'MARRIED',
            //     'office_id' => 2,
            //     'contact_no' => '09655138165',
            //     'program_id' => 0,
            //     'role' => 'DEAN',
            //     'password' => Hash::make('a')
            // ],

            // [
            //     'username' => 'janjan',
            //     'ref_id' => '201234',
            //     'lname' => 'CAGADAS',
            //     'fname' => 'JOHN MICHAEL',
            //     'mname' => '',
            //     'suffix' => '',
            //     'sex' => 'FEMALE',
            //     'civil_status' => 'SINGLE',
            //     'office_id' => 2,
            //     'contact_no' => '09655138165',
            //     'program_id' => 1,
            //     'role' => 'STUDENT',
            //     'password' => Hash::make('a')
            // ],
            // [
            //     'username' => 'leda',
            //     'ref_id' => 'FACULTY',
            //     'lname' => 'ABELLA',
            //     'fname' => 'LEDA GRACE',
            //     'mname' => '',
            //     'suffix' => '',
            //     'sex' => 'FEMALE',
            //     'civil_status' => 'SINGLE',
            //     'office_id' => 2,
            //     'contact_no' => '09655138165',
            //     'program_id' => 0,
            //     'role' => 'FACULTY',
            //     'password' => Hash::make('a')
            // ],
            // [
            //     'username' => 'junrey',
            //     'ref_id' => 'FACULTY',
            //     'lname' => 'SANTARITA',
            //     'fname' => 'JUNREY',
            //     'mname' => '',
            //     'suffix' => '',
            //     'sex' => 'MALE',
            //     'civil_status' => 'SINGLE',
            //     'office_id' => 2,
            //     'contact_no' => '09655138165',
            //     'program_id' => 0,
            //     'role' => 'FACULTY',
            //     'password' => Hash::make('a')
            // ],
            // [
            //     'username' => 'etet',
            //     'ref_id' => 'FACULTY',
            //     'lname' => 'AMPARADO',
            //     'fname' => 'ETIENNE WAYNE',
            //     'mname' => '',
            //     'suffix' => '',
            //     'sex' => 'MALE',
            //     'civil_status' => 'SINGLE',
            //     'office_id' => 2,
            //     'contact_no' => '09655138165',
            //     'program_id' => 0,
            //     'role' => 'FACULTY',
            //     'password' => Hash::make('a')
            // ],
            // [
            //     'username' => 'makmak',
            //     'ref_id' => '201122',
            //     'lname' => 'BASAYA',
            //     'fname' => 'MC GYVER',
            //     'mname' => '',
            //     'suffix' => '',
            //     'sex' => 'MALE',
            //     'civil_status' => 'SINGLE',
            //     'office_id' => 2,
            //     'contact_no' => '09655138165',
            //     'program_id' => 0,
            //     'role' => 'FACULTY',
            //     'password' => Hash::make('a')
            // ],


            // [
            //     'username' => 'nimchie',
            //     'ref_id' => '201223',
            //     'lname' => 'HIBAYA',
            //     'fname' => 'NIMCHIE',
            //     'mname' => '',
            //     'suffix' => '',
            //     'sex' => 'FEMALE',
            //     'civil_status' => 'SINGLE',
            //     'office_id' => 0,
            //     'contact_no' => '09655138165',
            //     'program_id' => 1,
            //     'role' => 'STUDENT',
            //     'password' => Hash::make('a')
            // ],
            // [
            //     'username' => 'itching',
            //     'ref_id' => '201213',
            //     'lname' => 'MAGLANGIT',
            //     'fname' => 'RICHIE',
            //     'mname' => '',
            //     'suffix' => '',
            //     'sex' => 'MALE',
            //     'civil_status' => 'SINGLE',
            //     'office_id' => 0,
            //     'contact_no' => '09655138165',
            //     'program_id' => 2,
            //     'role' => 'STUDENT',
            //     'password' => Hash::make('a')
            // ],
            // [
            //     'username' => 'haziel',
            //     'ref_id' => '201113',
            //     'lname' => 'ALGADIPE',
            //     'fname' => 'HAZIEL',
            //     'mname' => '',
            //     'suffix' => '',
            //     'sex' => 'FEMALE',
            //     'civil_status' => 'SINGLE',
            //     'office_id' => 0,
            //     'contact_no' => '09655138165',
            //     'program_id' => 1,
            //     'role' => 'STUDENT',
            //     'password' => Hash::make('a')
            // ],
            // [
            //     'username' => 'jesa',
            //     'ref_id' => '202113',
            //     'lname' => 'BECHAYDA',
            //     'fname' => 'JESA',
            //     'mname' => '',
            //     'suffix' => '',
            //     'sex' => 'FEMALE',
            //     'civil_status' => 'SINGLE',
            //     'office_id' => 0,
            //     'contact_no' => '09655138165',
            //     'program_id' => 1,
            //     'role' => 'STUDENT',
            //     'password' => Hash::make('a')
            // ],
            // [
            //     'username' => 'marjhon',
            //     'ref_id' => '202213',
            //     'lname' => 'PUCOT',
            //     'fname' => 'MARJHON',
            //     'mname' => '',
            //     'suffix' => '',
            //     'sex' => 'MALE',
            //     'civil_status' => 'SINGLE',
            //     'office_id' => 0,
            //     'contact_no' => '09655138165',
            //     'program_id' => 2,
            //     'role' => 'STUDENT',
            //     'password' => Hash::make('a')
            // ],
            // [
            //     'username' => 'roger',
            //     'ref_id' => '205513',
            //     'lname' => 'LACAPAG',
            //     'fname' => 'ROGER',
            //     'mname' => '',
            //     'suffix' => '',
            //     'sex' => 'MALE',
            //     'civil_status' => 'SINGLE',
            //     'office_id' => 0,
            //     'contact_no' => '09655138165',
            //     'program_id' => 3,
            //     'role' => 'STUDENT',
            //     'password' => Hash::make('a')
            // ],
            // [
            //     'username' => 'charles',
            //     'ref_id' => '201223',
            //     'lname' => 'VARGAS',
            //     'fname' => 'charles',
            //     'mname' => '',
            //     'suffix' => '',
            //     'sex' => 'MALE',
            //     'civil_status' => 'SINGLE',
            //     'office_id' => 0,
            //     'contact_no' => '09655138165',
            //     'program_id' => 4,
            //     'role' => 'STUDENT',
            //     'password' => Hash::make('a')
            // ],


        ];

        \App\Models\User::insertOrIgnore($data);
    }
}
