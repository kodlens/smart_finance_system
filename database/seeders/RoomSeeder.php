<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
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
                'room' => 'MB 201',
                'room_desc' => 'LECTURE ROOM',
                'max' => 40,
            ],
            [
                'room' => 'MB 202',
                'room_desc' => 'LECTURE ROOM',
                'max' => 40,
            ],
            [
                'room' => 'CLAB 101',
                'room_desc' => 'COMPUTER LABORATORY 1',
                'max' => 40,
            ],
            [
                'room' => 'CLAB 102',
                'room_desc' => 'COMPUTER LABORATORY 2',
                'max' => 40,
            ],

            [
                'room' => 'MB 303',
                'room_desc' => 'LECTURE ROOM',
                'max' => 40,
            ],
            [
                'room' => 'MB 209',
                'room_desc' => 'LECTURE ROOM',
                'max' => 40,
            ],
            [
                'room' => 'MB 210',
                'room_desc' => 'LECTURE ROOM',
                'max' => 40,
            ],
            [
                'room' => 'MB 304',
                'room_desc' => 'LECTURE ROOM',
                'max' => 40,
            ],
            [
                'room' => 'MB 301',
                'room_desc' => 'LECTURE ROOM',
                'max' => 40,
            ],
            [
                'room' => 'MB 104',
                'room_desc' => 'LECTURE ROOM',
                'max' => 40,
            ],
            [
                'room' => 'MB 204',
                'room_desc' => 'LECTURE ROOM',
                'max' => 40,
            ],
            [
                'room' => 'MB 105',
                'room_desc' => 'LECTURE ROOM',
                'max' => 40,
            ],
            [
                'room' => 'MB 211',
                'room_desc' => 'LECTURE ROOM',
                'max' => 40,
            ],
            [
                'room' => 'MB 214',
                'room_desc' => 'LECTURE ROOM',
                'max' => 40,
            ],
            [
                'room' => 'MB 206',
                'room_desc' => 'LECTURE ROOM',
                'max' => 40,
            ],


        ];

        \App\Models\Room::insertOrIgnore($data);
    }
}
